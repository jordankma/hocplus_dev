<?php

namespace Vne\Pay\App\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Vne\Pay\App\Models\Course;
use Vne\Pay\App\Models\Voucher;
use Vne\Pay\App\Models\PayMethod;
use Vne\Pay\App\Models\Order;
use Vne\Pay\App\Models\Thanhpho;
use Vne\Pay\App\Models\Quanhuyen;
use Vne\Pay\App\Models\Xaphuong;
use Vne\Pay\App\Models\Cod;
use Validator;

class PayController extends Controller
{
    
    const TAO_DON_HANG = 0; // KHOI TAO DON HANG
    const CHUYEN_CONG_TT = 1; // DA CHUYEN CONG THANH TOAN
    const LOI_TT = 2; // CONG THANH TOAN TRA VE LOI
    const TT_THANH_CONG = 4; // CONG THANH TOAN TRA VE THANH CONG    
    const CLIENT_DA_NHAN = 8; // CLIENT DA NHAN
    public function __construct()
    {
        parent::__construct();        
    }
    
    public function buyCourse(Request $request){
        
        if(empty($request->course_id)){
            return response()->json([
                'status' => false,
                'msg' => 'Tham số không hợp lệ'
            ]);
        }
        
        $course = Course::findOrFail($request->course_id);
        
        $data = [
            'name' => $course->name,
            'avartar' => $course->avartar,
            'teacher_name' => $course->isTeacher->name,
            'teacher_avatar' => $course->isTeacher->avatar_index,
            'price_discount' => $this->_buildCourseDiscount($course->price, $course->discount, $course->discount_exp), // so tien giam gia dua theo % khuyen mai khoa hoc
            'discount' => $course->discount, // so % giam gia
            'price_before' => $course->price,
            'price' => $course->price - $this->_buildCourseDiscount($course->price, $course->discount, $course->discount_exp),
            'course_id' => $course->course_id,            
        ];

        $data['secret_key'] = $this->_buildSecretKeyByCourse($data['course_id'], $data['price']);
        
        return view('VNE-PAY::modules.pay.buy_course', compact('data'));
    }

    public function useVoucher(Request $request){
        try{
            if(empty($request->voucherCode) ){
                throw new \Exception('Bạn chưa nhập mã giảm giá');
            }

            if(empty($request->secretKey) || empty($request->courseId) || empty($request->price)){
                throw new \Exception('Tham số không hợp lệ');
            }

            //check seretKey
            $currentKey = $this->_buildSecretKeyByCourse($request->courseId, $request->price);
            if($currentKey != $request->secretKey){
                throw new \Exception('Cảnh báo! Bạn đang cố tình thay đổi giá trị đơn hàng!');
            }

            $voucher = Voucher::where(['code' => $request->voucherCode, 'active' => 'not_used'])->first();

            if(!$voucher){
                throw new \Exception('Mã giảm giá không tồn tại hoặc đã được sử dụng');
            }
            $discount = 0;
            // if(strtotime(date("Y-m-d H:i:s")) > $voucher->exp){
            //     throw new \Exception('Mã giảm giá đã hêt hạn sử dụng');
            // }
            $course = Course::findOrFail($request->courseId);    
            if($voucher->type == 0){ // kieu giam gia %
                $discount = (($course->price * $voucher->discount) / 100); 
            } 
            if($voucher->type == 1){ // kieu giam gia %
                $discount = $voucher->discount; 
            }            
                    
            $price = ($course->price - $this->_buildCourseDiscount($course->price, $course->discount, $course->discount_exp)) - $discount;
            $newSecretKey = $this->_buildSecretKeyByCourse($request->courseId, $price);

            // $voucher->active = 'pending';
            // $voucher->save();

            return response()->json([
                'status' => true,
                'msg' => 'Áp dụng mã voucher thành công',
                'data' => [
                    'price' => $price,
                    'secretKey' => $newSecretKey,
                    'discountVoucher' => $discount,
                    'labelDiscountVoucher' => number_format($discount, 0, ',', '.'),
                    'labelPrice' => number_format($price, 0, ',', '.'),
                ]
            ]);

        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
        
    }

    public function createOrder(Request $request){
        try{
            if(empty($request->secretKey) || empty($request->courseId) || empty($request->price)){
                throw new \Exception('Tham số không hợp lệ');
            }
            //check key
            $currentKey = $this->_buildSecretKeyByCourse($request->courseId, $request->price);
            if($currentKey != $request->secretKey){
                throw new \Exception('Cảnh báo! Bạn đang cố tình thay đổi giá trị đơn hàng!');
            }

            $voucherId = 0;
            if(!empty($request->voucherCode)){
                $voucher = Voucher::where(['code' => $request->voucherCode])->first();
                if($voucher){
                    $voucherId = $voucher->voucher_id;
                }
            }

            $course = Course::findOrFail($request->courseId);
            
            $order = Order::create([
                'course_id' => $course->course_id,
                'order_code' => $this->_generateRandomString(6).time(),
                'user_id' => !empty(Auth::guard('member')) ? Auth::guard('member')->user()->member_id : 1,
                'voucher_id' => $voucherId,
                'total_money' => $course->price,
                'total_discount' => $request->discountCourse + $request->discountVoucher,
                'money_payment' => $request->price,
                'status' => 0
            ]);

            if($order->order_id){
                $secretKey = $this->_buildSecretKeyOrder($order->order_code);
                //update voucher
                if(isset($voucher)){
                    if($voucher){
                        $voucher->active = 'used';
                        $voucher->save();
                    }
                }
                return response()->json([
                    'status' => true,
                    'msg' => 'create order successfully',
                    'redirect' => route('vne.pay.payCourse', ['order_code' => $order->order_code, 'secret_key' => $secretKey])
                ]);
            } else {
                throw new \Exception('Khởi tạo đơn hàng không thành công');
            }
            
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
        
    }

    public function payCourse(Request $request){
        if(empty($request->secret_key) || empty($request->order_code)) {
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: Tham số không hợp lệ'
            ]);
        }
        //check key
        $currentKey = $this->_buildSecretKeyOrder($request->order_code);
        if($currentKey != $request->secret_key){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: secret key không chính xác'
            ]);
        }
        
        $payMethods = PayMethod::orderBy('ordinal', 'asc')->get()->toArray(); 
        
        // check status order
        $checkOrder = $this->_checkStatusOrder($request->order_code);
        if(empty($checkOrder)){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: không tìm thấy thông tin đơn hàng'
            ]);
        }
        if($checkOrder['error'] == true){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '.$checkOrder['msg']
            ]);
        }

        $order = $checkOrder['order'];       
        
        $city = Thanhpho::getAllData();       

        return view('VNE-PAY::modules.pay.pay_course', compact('payMethods', 'order', 'city'));
    }

    public function payCod(Request $request){
        if(empty($request->order_code) || empty($request->secret_key) || empty($request->name) || empty($request->phone) || empty($request->address)){
            return response()->json([
                'status' => false,
                'msg' => 'Vui lòng nhập đầy đủ thông tin'
            ]);
        }

        // check secretKey
        $currentKey = $this->_buildSecretKeyOrder($request->order_code);
        if($request->secret_key != $currentKey){
            return response()->json([
                'status' => false,
                'msg' => 'secret key không chính xác'
            ]);
        }

        // check status order
        $checkOrder = $this->_checkStatusOrder($request->order_code);
        if(empty($checkOrder)){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: không tìm thấy thông tin đơn hàng'
            ]);
        }
        if($checkOrder['error'] == true){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '.$checkOrder['msg']
            ]);
        }

        $order = $checkOrder['order'];

        $cod = Cod::create([
            'order_code' => $request->order_code,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'wards' => $request->wards
        ]);
        if($cod->cod_id){
            $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT;
            $order->save();
            return response()->json([
                'status' => true,
                'msg' => 'successfully',
                'redirect' => route('vne.pay.checkOut', ['order_code' => $request->order_code, 'method' => 'cod'])
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: không xác nhận được đơn hàng thanh toán'
            ]);
        }
    }

    public function checkOut(Request $request){
        if(empty($request->order_code) || empty($request->method)){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: Không tìm thấy thông tin đơn hàng'
            ]);
        }
        $method = PayMethod::where(['type' => $request->method])->first();
        if(empty($method)){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: Không tìm thấy phương thức thanh toán'
            ]);
        }
        return view('VNE-PAY::modules.pay.check_out', ['order_code' => $request->order_code, 'method' => $method]);
    }

    public function _buildCourseDiscount($price, $discount, $exp){
        $today = date("Y-m-d H:i:s");
        $priceDiscount = 0;
        if(!empty($exp)){
            if (strtotime($today) > $exp) {
                $priceDiscount = 0;
            } else {
                $priceDiscount = !empty($discount) ? ($price * $discount) / 100 : 0; 
            } 
        }
        return $priceDiscount;
    }

    public function _buildSecretKeyByCourse($courseId, $price){
        $memberId = !empty(Auth::guard('member')) ? Auth::guard('member')->user()->member_id : 1;
        $key = "@Hocplus123";
        return md5($memberId.$courseId.$price.md5($key));
    }

    public function _generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function _buildSecretKeyOrder($orderCode){
        $memberId = !empty(Auth::guard('member')) ? Auth::guard('member')->user()->member_id : 1;
        $key = "@hocplus#order";
        return md5($memberId.$orderCode.md5($key));
    }

    public function _checkStatusOrder($orderCode){

        $order = Order::where(['order_code' => $orderCode])->first();               
        if(!$order){
            return ['error' => true, 'msg' => 'Không tìm thấy đơn hàng'];
        }

        if ($order->status & self::TT_THANH_CONG)
        {
            return ['error' => true, 'msg' => 'Đơn hàng đã thanh toán thành công từ trước đó'];            
        }
        
        if ($order->status & self::CHUYEN_CONG_TT)
        {            
            return ['error' => true, 'msg' => 'Đơn hàng đã chuyển sang cổng thanh toán'];            
        }

        if ($order->status & self::LOI_TT)
        {
            return  ['error' => true, 'msg' => 'Đơn hàng thanh toán lỗi'];            
        }        

        return ['error' => false, 'msg' => 'success', 'order' => $order];        
    }

    public function loadDistrict(Request $request){

        if(empty($request->matp)){
            return response()->json([
                'status' => false,
                'msg' => 'Bạn chưa chọn tỉnh thành phố'
            ]);
        } 
        $quanHuyen = Quanhuyen::getAllData($request->matp);
        if(empty($quanHuyen)){
            return response()->json([
                'status' => false,
                'msg' => 'Không tìm thấy quận huyện tương ứng với tỉnh thành bạn chọn'
            ]);
        } 
        $html = view('VNE-PAY::modules.pay._item_district', compact('quanHuyen'));
        return response()->json([
            'status' => true,
            'msg' => 'successfully',
            'html' => $html->render()
        ]);
    }

    public function loadWards(Request $request){

        if(empty($request->maqh)){
            return response()->json([
                'status' => false,
                'msg' => 'Bạn chưa chọn quận huyện'
            ]);
        } 
        $xaPhuong = Xaphuong::getAllData($request->maqh);
        if(empty($xaPhuong)){
            return response()->json([
                'status' => false,
                'msg' => 'Không tìm thấy xã phường tương ứng với quận huyện bạn chọn'
            ]);
        } 
        $html = view('VNE-PAY::modules.pay._item_wards', compact('xaPhuong'));
        return response()->json([
            'status' => true,
            'msg' => 'successfully',
            'html' => $html->render()
        ]);
    }
}

