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
use Vne\Pay\App\Models\MemberDeposit;
use Vne\Pay\App\Models\Transaction;
use Vne\Pay\App\Models\Cod;
use Vne\Pay\App\Models\MemberHasCourse;
use Vne\Pay\App\Models\LogApi;
use App\Libary\VNPay\VNPayPayment;
use GuzzleHttp\Client;
use Curl\Curl;
use Validator;
class PayController extends Controller
{
    
    const TAO_DON_HANG = 0; // KHOI TAO DON HANG
    const CHUYEN_CONG_TT = 1; // DA CHUYEN CONG THANH TOAN
    const LOI_TT = 2; // CONG THANH TOAN TRA VE LOI
    const TT_THANH_CONG = 4; // CONG THANH TOAN TRA VE THANH CONG    
    const CLIENT_DA_NHAN = 8; // CLIENT DA NHAN
    //config thanh toan the hocplus
    protected $secret_key = '1G%Ai>-kx*3Mf7^v';
    protected $secret_iv = 'MP@tx3<9&nJKQ*W(';
    protected $encrypt_method = "AES-256-CBC";
    protected $_productId = 11;
    protected $_environment = 'real';   
    public function __construct()
    {
        parent::__construct();        
    }
    
    //mua khóa học
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
        $memberId = $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $checkExits = false;
        $checkExitsCourse = MemberHasCourse::where(['member_id' => $memberId, 'course_id' => $request->course_id])->first();
        if($checkExitsCourse){
            $checkExits = true;
        }
        
        return view('VNE-PAY::modules.pay.buy_course', compact('data', 'checkExits'));
    }

    //sử dụng voucher
    public function useVoucher(Request $request){
        try{
            $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
            
            if(empty($request->voucherCode) ){
                throw new \Exception('Bạn chưa nhập mã giảm giá');
            }
            if(empty($request->secretKey) || empty($request->courseId) || empty($request->price)){
                throw new \Exception('Tham số không hợp lệ');
            }
            $checkExitsCourse = MemberHasCourse::where(['member_id' => $memberId, 'course_id' => $request->courseId])->first();
            if($checkExitsCourse){
                throw new \Exception('Bạn đã mua khóa học này!');
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

    // tạo hóa đơn
    public function createOrder(Request $request)
    {
        try{
            if(empty($request->secretKey) || empty($request->courseId) || empty($request->price)){
                throw new \Exception('Tham số không hợp lệ');
            }
            
            $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
            $checkExitsCourse = MemberHasCourse::where(['member_id' => $memberId, 'course_id' => $request->courseId])->first();
           
            if($checkExitsCourse){
                throw new \Exception('Bạn đã mua khóa học này!');
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
                'order_code' => 'hp_'.$this->_generateRandomString(6).'_'.time(),
                'user_id' => isset( Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1,
                'voucher_id' => $voucherId,
                'total_money' => $course->price,
                'total_discount' => $request->discountCourse + $request->discountVoucher,
                'money_payment' => $request->price,
                'status' => 0,
                'type' => 'out'
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
    
    // view thanh toán khóa học
    public function payCourse(Request $request)
    {
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
        
        //lay thong tin vi
        $memberId = isset( Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $deposit = $this->_createMemberDeposit($memberId);
        return view('VNE-PAY::modules.pay.pay_course', compact('payMethods', 'order', 'city', 'deposit'));
    }

    //thanh toán khóa học bằng cod
    public function payCod(Request $request)
    {
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
            'wards' => $request->wards,
            'type' => 'cod'
        ]);
        if($cod->cod_id){
            $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT;
            $order->method = 'cod';
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

    //thanh toán khóa học bằng card
    public function payCard(Request $request)
    {
        try {            
            $validator = Validator::make($request->all(), [
                'captcha' => 'required|captcha',
                'card_code' => 'required',
                'card_seri' => 'required',
                'order_code' => 'required',
                'secret_key' => 'required'                
            ], ['captcha.captcha' => 'Mã xác nhận không chính xác', 'captcha.required' => 'Bạn chưa nhập mã xác nhận']);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'errors' => $validator->messages(),
                    'msg' => 'Dữ liệu không hợp lệ',
                    'captcha'=> captcha_img()
                ]);
            }
            // check secretKey order
            $currentKey = $this->_buildSecretKeyOrder($request->order_code);
            if($request->secret_key != $currentKey){
                throw new \Exception('Secret key không chính xác');
            }
            //check trạng thái đơn hàng
            $checkOrder = $this->_checkStatusOrder($request->order_code);
            if(empty($checkOrder)){
                throw new \Exception('Lỗi: không tìm thấy thông tin đơn hàng');
            }
            if($checkOrder['error'] == true){
                throw new \Exception('Lỗi: '.$checkOrder['msg']);
            }
            $order = $checkOrder['order'];
            $memberId = isset( Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
            //lay thong tin khoa hoc
            $course = Course::findOrFail($order->course_id);
            $data = "code=" . $this->_replaceString($request->card_code) . "&serial=" . $this->_replaceString($request->card_seri) . "&user_id=" . $memberId . '&product_id='.$this->_productId.'&environment='.$this->_environment;
            $data_encrypt = $this->_encrypt($data);
            $curl = new Curl();
            $response = $curl->post('http://card.hocplus.vn/admin/api/card/wallet_charge?data='.$data_encrypt);
            $curl->close();
            $order->method = 'card';
            $order->card_code = $this->_replaceString($request->card_code);
            $order->card_seri = $this->_replaceString($request->card_seri);
            $order->save();
            if($response->status){
                $res = $response->data;
                $deposit = $this->_createMemberDeposit($memberId); // lay thong tin vi
                //cap nhat don hang
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::TT_THANH_CONG;
                $order->save();
                //kiem tra menh gia the co >= hoa don
                if($order->money_payment <= $res->card_value ){
                    $rechange = (int)$res->card_value - (int)$order->money_payment;
                    $logTransaction = [
                        'order_code' => $order->order_code,
                        'member_id' => $memberId,
                        'course_id' => $course->course_id,
                        'class_id' => $course->class_id,
                        'subject_id' => $course->subject_id,
                        'teacher_id' => $course->teacher_id,
                        'type' => 'out',
                        'money_payment' => $order->money_payment,
                        'method' => 'card',
                        'seri' => $this->_replaceString($request->card_seri),
                        'code' => $this->_replaceString($request->card_code),
                        'card_type' => 'hocplus',
                        'message' => 'Đăng ký mua khóa từ thẻ hocplus thành công'
                    ];
                    //Luu thong giao dich transaction
                    $transactionOut = $this->_createTransaction($logTransaction);
                    if($transactionOut->transaction_id){
                        //dang ky khoa hoc
                        $memberHasCourse = MemberHasCourse::create([
                            'member_id' => $memberId,
                            'course_id' => $course->course_id,
                            'exp' => strtotime(date('Y-m-d', strtotime('+1 year')))
                        ]);
                        //dang ky khoa hoc thanh cong
                        if($memberHasCourse->member_has_course_id){
                            // neu con du tien thi cong vao vi
                            if($rechange > 0){
                                $logTransaction = [
                                    'order_code' => $order->order_code,
                                    'member_id' => $memberId,
                                    'course_id' => $course->course_id,
                                    'class_id' => $course->class_id,
                                    'subject_id' => $course->subject_id,
                                    'teacher_id' => $course->teacher_id,
                                    'type' => 'in',
                                    'money_payment' => $rechange,
                                    'method' => 'card',
                                    'money_before' => $deposit->deposit,
                                    'money_after' => (int)$deposit->deposit + (int)$rechange,
                                    'seri' => $this->_replaceString($request->card_seri),
                                    'code' => $this->_replaceString($request->card_code),
                                    'card_type' => 'hocplus',
                                    'message' => 'Nạp tiền còn dư từ đăng ký khóa học bằng thẻ hocplus'
                                ];
                                //Luu thong tin nạp tiền thừa
                                $transactionIn = $this->_createTransaction($logTransaction);
                                if($transactionIn->transaction_id){
                                    //Cộng tiền
                                    $money_change = (int)$deposit->deposit + (int)$rechange;
                                    $deposit->deposit = $money_change;
                                    $deposit->deposit_hash = $this->_hashDeposit($deposit->member_id, $money_change);
                                    $deposit->deposit_rechange = $deposit->deposit_rechange + $rechange;
                                    $deposit->save();
                                    return response()->json([
                                        'status' => true,
                                        'msg' => 'Đăng ký mua khóa học thành công! Số tiền còn dư đã được cộng vào ví',
                                        'redirect' => route('vne.pay.checkOut', ['order_code' => $order->order_code, 'method' => 'card'])
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => true,
                                        'msg' => 'Đăng ký mua khóa học thành công! Số tiền còn dư chưa được cộng vào ví, vui lòng liên hệ với BQT',
                                        'redirect' => route('vne.pay.checkOut', ['order_code' => $order->order_code, 'method' => 'card'])
                                    ]);
                                }
                            }
                            return response()->json([
                                'status' => true,
                                'msg' => 'Đăng ký mua khóa học thành công!',
                                'redirect' => route('vne.pay.checkOut', ['order_code' => $order->order_code, 'method' => 'card'])
                            ]);
                        } else {
                            throw new \Exception('Đơn hàng đã được thanh toán thành công, nhưng chưa đăng ký được khóa học, vui lòng liên hệ BQT!');
                        }
                    } else {
                        throw new \Exception('Lỗi không lưu được thông tin giao dịch');
                    }
                }
                else // menh gia the nho hon so tien hoa don -> cong tien vao vi
                {
                    //1.lưu transaction giao dich thành công
                    $logTransaction = [
                        'order_code' => $order->order_code,
                        'member_id' => $memberId,
                        'course_id' => $course->course_id,
                        'class_id' => $course->class_id,
                        'subject_id' => $course->subject_id,
                        'teacher_id' => $course->teacher_id,
                        'type' => 'in',
                        'money_payment' => $res->card_value,
                        'method' => 'card',
                        'money_before' => $deposit->deposit,
                        'money_after' => (int)$deposit->deposit + (int)$res->card_value,
                        'seri' => $this->_replaceString($request->card_seri),
                        'code' => $this->_replaceString($request->card_code),
                        'card_type' => 'hocplus',
                        'message' => 'Nạp tiền vào ví từ thẻ hocplus thành công'
                    ];
                    $transactionIn = $this->_createTransaction($logTransaction);
                    if($transactionIn->transaction_id){
                        //2.lưu transction thành công, cộng tiền vào ví
                        $moneyChange = $res->card_value + $deposit->deposit;
                        $deposit->deposit =  $moneyChange;
                        $deposit->deposit_hash = $this->_hashDeposit($deposit->member_id, $moneyChange);
                        $deposit->deposit_rechange = $deposit->deposit_rechange + $res->card_value;
                        $deposit->save();
                        return response()->json([
                            'status' => true,
                            'msg' => 'Mệnh giá thẻ không đủ để đăng ký khóa học, số tiền đã được cộng vào ví',
                            'redirect' => route('vne.wallet.manage', ['order_code' => $order->order_code, 'method' => 'card'])
                        ]);
                    } else {
                        throw new \Exception('Không lưu được thông tin giao dịch, vui lòng liên hệ BQT!');
                    }
                }
            } else {
                //cap nhat don hang
                // $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::LOI_TT;
                // $order->save();
                // throw new \Exception($response->messages);
                return response()->json([
                    'status' => false,
                    'msg' => $response->messages,
                    'errors' => [],
                    'captcha'=> captcha_img()
                ]);
            }
       
            } catch(\Exception $e){
                return response()->json([
                    'status' => false,
                    'msg' => 'Lỗi: '.$e->getMessage(),
                    'errors' => [],
                    'captcha'=> captcha_img()
                ]);
            }
        
    }

    public function payVnPay(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [                
                'order_code' => 'required',
                'secret_key' => 'required'                
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,                    
                    'msg' => 'Dữ liệu không hợp lệ',                    
                ]);
            } else {
                // check secretKey order
                $currentKey = $this->_buildSecretKeyOrder($request->order_code);
                if($request->secret_key != $currentKey){
                    throw new \Exception('Secret key không chính xác');
                }
                //check trạng thái đơn hàng           
                $checkOrder = $this->_checkStatusOrder($request->order_code);
                if(empty($checkOrder)){
                    throw new \Exception('Lỗi: không tìm thấy thông tin đơn hàng');              
                }
                if($checkOrder['error'] == true){
                    throw new \Exception('Lỗi: '.$checkOrder['msg']);               
                }
                $order = $checkOrder['order'];
                $uri_callback = route('vne.pay.payVnPayCallback', [
                    'order_id' => $order->order_code,                    
                ]);
                
                if($order->money_payment < 10000){
                    throw new \Exception('Lỗi: số tiền tối thiểu thanh toán là 10.000đ');  
                }
                
                $arrayData = array(
                    'order_desc' => 'Thanh toan vnpay',
                    'order_id' => $order->order_code,
                    'order_type' => 'billpayment',
                    'amount' => $order->money_payment,
                    'language' => 'vn',
                    'bank_code' => '',
                    'vnp_ReturnUrl' => $uri_callback
                );
                 // create link
                $VNPay = new VNPayPayment();
                $response = $VNPay->buildUrlVnPay($arrayData);
                $order->method = 'ebanking';
                $order->save();
                if(isset($response['message']) && isset($response['redirect_url'])){
                    if($response['message'] == 'success' && !empty($response['redirect_url'])){
                        //cap nhat don hang
                        $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT;
                        $order->save();
                        
                        return response()->json([
                            'status' => true,
                            'msg' => 'success',
                            'link' => $response['redirect_url']
                        ]);
                    }
                }
                //cap nhat don hang
                $order->status = self::TAO_DON_HANG | self::LOI_TT;
                $order->save();
                throw new \Exception('Chuyen cong thanh toan that bai');
                
            }
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
    }
    /**
     * action nay thuc hien vien tra ve ket qua thanh toan cho client (nhung chua thuc hien cap nhat thong tin don hang vao db)
     */
    public function payVnPayCallback(Request $request)
    {
        try{
            $vnpay = new VNPayPayment();
            $response = $vnpay->verifyData();
            if($response){
                return redirect()->route('vne.pay.checkOut', ['order_code' => $request->order_id, 'method' => 'ebanking']);               
            } else{
                throw new \Exception('Chữ ký không hợp lệ');
            }
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }        
    }

    public function vnpayIpn(Request $request)
    {
        try{
            //luu log api
            $this->log_api($request->all(), 'current', 'out', $request->vnp_TxnRef, 'Thanh toan tu vnpay');
            
            $vnpay = new VNPayPayment();
            $response = $vnpay->verifyData();
            if(!$response)
            {
                return response()->json([
                    'RspCode' => '97',
                    'Message' => 'Chu ky khong hop le'
                ]);
            }

            //check trạng thái đơn hàng
             $checkOrder = $this->_checkStatusOrder($request->vnp_TxnRef, 'ebanking');
             if(empty($checkOrder)){
                 return response()->json([
                     'RspCode' => '01',
                     'Message' => 'Không tìm thấy đơn hàng (order)'
                 ]);
             }
             if($checkOrder['error'] == true){
                 return response()->json([
                     'RspCode' => '02',
                     'Message' => $checkOrder['msg']
                 ]);
             }
             $order = $checkOrder['order'];
             $memberId = $order->user_id;

            //thanh toan thanh cong
            if($request->vnp_ResponseCode == '00')
            {
                //update trang thai don hang
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::TT_THANH_CONG;
                $order->save();

                //neu type order = in(nap tien)
                if($order->type == 'in'){
                    $deposit = $this->_createMemberDeposit($memberId); // lay thong tin vi
                    //tao transaction nap tien
                    $logTransaction = [
                        'order_code' => $order->order_code,
                        'member_id' => $memberId,
                        'type' => 'in',
                        'money_payment' => $order->money_payment,
                        'method' => 'ebanking',
                        'money_before' => $deposit->deposit,
                        'money_after' => (int)$deposit->deposit + (int)$order->money_payment,
                        'message' => 'Nạp tiền vào ví từ vnpay thành công'
                    ];
                    $transaction = $this->_createTransaction($logTransaction);
                    if($transaction->transaction_id){
                        $moneyChange = $order->money_payment + $deposit->deposit;
                        $deposit->deposit =  $moneyChange;
                        $deposit->deposit_hash = $this->_hashDeposit($deposit->member_id, $moneyChange);
                        $deposit->deposit_rechange = $deposit->deposit_rechange + $order->money_payment;
                        $deposit->save();
                        return response()->json([
                            'RspCode' => '00',
                            'Message' => 'Confirm Success'
                        ]);
                    } else {
                        return response()->json([
                            'RspCode' => '99',
                            'Message' => 'Lỗi không lưu được thông tin thanh toán từ vnpay'
                        ]);
                    }
                }
                else {
                    //lay thong tin khoa hoc
                    $course = Course::findOrFail($order->course_id);
                    //tao transaction thanh toan
                    $logTransaction = [
                        'order_code' => $order->order_code,
                        'member_id' => $memberId,
                        'course_id' => $order->course_id,
                        'class_id' => $course->class_id,
                        'subject_id' => $course->subject_id,
                        'teacher_id' => $course->teacher_id,
                        'type' => 'out',
                        'money_payment' => $order->money_payment,
                        'method' => 'ebanking',
                        'message' => 'Mua khóa học từ vnpay thành công'
                    ];

                    $transaction = $this->_createTransaction($logTransaction);
                    if($transaction->transaction_id){
                        //dang ky khoa hoc
                        $memberHasCourse = MemberHasCourse::create([
                            'member_id' => $memberId,
                            'course_id' => $order->course_id,
                            'exp' => strtotime(date('Y-m-d', strtotime('+1 year')))
                        ]);
                        if($memberHasCourse->member_has_course_id){
                            $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::TT_THANH_CONG;
                            $order->save();
                        }
                        return response()->json([
                            'RspCode' => '00',
                            'Message' => 'Confirm Success'
                        ]);
                    } else {
                        return response()->json([
                            'RspCode' => '99',
                            'Message' => 'Lỗi không lưu được thông tin thanh toán từ vnpay'
                        ]);
                    }
                }
            }
            else
            {
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::LOI_TT;
                $order->save();
                return response()->json([
                    'RspCode' => '91',
                    'Message' => 'Thanh toán từ vnpay không thành công'
                ]);
            }
        } catch(\Exception $e){
            return response()->json([
                'RspCode' => '99',
                'Message' => 'Lỗi Hệ Thống: '.$e->getMessage()
            ]);
        }
    }

    public function payTranfer(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'order_code' => 'required',
                'secret_key' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'msg' => 'Dữ liệu không hợp lệ',
                ]);
            }
            // check secretKey order
            $currentKey = $this->_buildSecretKeyOrder($request->order_code);
            if($request->secret_key != $currentKey){
                throw new \Exception('Secret key không chính xác');
            }
            //check trạng thái đơn hàng           
            $checkOrder = $this->_checkStatusOrder($request->order_code);
            if(empty($checkOrder)){
                throw new \Exception('Lỗi: không tìm thấy thông tin đơn hàng');              
            }
            if($checkOrder['error'] == true){
                throw new \Exception('Lỗi: '.$checkOrder['msg']);               
            }
            $order = $checkOrder['order'];
            $tranfer = Cod::create([
                'order_code' => $request->order_code,
                'name' => Auth::guard('member')->user()->name,
                'phone' => Auth::guard('member')->user()->phone,
                'address' => Auth::guard('member')->user()->address,               
                'type' => 'transfer'
            ]);
            
            $order->method = 'transfer';
            $order->save();
            if($tranfer->cod_id){
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT;
                $order->save();
                return response()->json([
                    'status' => true,
                    'msg' => 'successfully',
                    'redirect' => route('vne.pay.checkOut', ['order_code' => $request->order_code, 'method' => 'transfer'])
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Lỗi: không xác nhận được đơn hàng thanh toán'
                ]);
            }
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
    }

    public function payWallet(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [                
                'order_code' => 'required',
                'secret_key' => 'required'                
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,                    
                    'msg' => 'Dữ liệu không hợp lệ',                    
                ]);
            }
            // check secretKey order
            $currentKey = $this->_buildSecretKeyOrder($request->order_code);
            if($request->secret_key != $currentKey){
                throw new \Exception('Secret key không chính xác');
            }
            //check trạng thái đơn hàng           
            $checkOrder = $this->_checkStatusOrder($request->order_code);
            if(empty($checkOrder)){
                throw new \Exception('Lỗi: không tìm thấy thông tin đơn hàng');              
            }
            if($checkOrder['error'] == true){
                throw new \Exception('Lỗi: '.$checkOrder['msg']);               
            }
            $order = $checkOrder['order'];
            $memberId = isset( Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
            $deposit = $this->_createMemberDeposit($memberId);
            $secretKeyDeposit = $this->_hashDeposit($memberId, $deposit->deposit);
            if($secretKeyDeposit == $deposit->deposit_hash){
                if($deposit->deposit < $order->money_payment){
                    throw new \Exception('Số tiền trong ví không đủ để đăng ký khóa học này');
                } 
                $course = Course::findOrFail($order->course_id);
                //cap nhat don hang
                $order->method = 'wallet';
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::TT_THANH_CONG;
                $order->save();
                
                //tao transaction thanh toan
                $logTransaction = [
                    'order_code' => $order->order_code,
                    'member_id' => $memberId,
                    'course_id' => $order->course_id,
                    'class_id' => $course->class_id,
                    'subject_id' => $course->subject_id,
                    'teacher_id' => $course->teacher_id,
                    'type' => 'out',
                    'money_payment' => $order->money_payment,
                    'method' => 'wallet',
                    'message' => 'Mua khóa học từ ví thành công'
                ];
                $transaction = $this->_createTransaction($logTransaction);
                if($transaction->transaction_id){
                    //tru tien
                    $moneyChange = $deposit->deposit - $order->money_payment;
                    $deposit->deposit = $moneyChange;
                    $deposit->deposit_hash = $this->_hashDeposit($deposit->member_id, $moneyChange);
                    $deposit->save();
                    //dang ky khoa hoc
                    $memberHasCourse = MemberHasCourse::create([
                        'member_id' => $memberId,
                        'course_id' => $order->course_id,
                        'exp' => strtotime(date('Y-m-d', strtotime('+1 year')))
                    ]);
                    if($memberHasCourse->member_has_course_id){
                        $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::TT_THANH_CONG;
                        $order->save();                        
                    }
                    return response()->json([
                        'status' => true,
                        'msg' => 'Mua khóa học thành công',
                        'redirect' => route('vne.pay.checkOut', ['order_code' => $order->order_code, 'method' => 'wallet'])
                    ]);
                    
                }
                throw new \Exception('Giao dịch thất bại!');
            } else {                
                $deposit->deposit_status = 2;
                $deposit->save();
                $order->method = 'wallet';
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::LOI_TT;
                $order->save();
                throw new \Exception('Tài khoản của bạn bị khóa tạm thời, do số dư trong ví thay đổi không phù hợp');
            }
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
    }

    public function checkOut(Request $request)
    {
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

    public function _buildCourseDiscount($price, $discount, $exp)
    {
        $today = date("Y-m-d H:i:s");
        $priceDiscount = 0;
        if(!empty($exp)){
            if (strtotime($today) > $exp) {
                $priceDiscount = 0;
            } else {
                $priceDiscount = !empty($discount) ? ($price * $discount) / 100 : 0; 
            } 
        } else {
            $priceDiscount = !empty($discount) ? ($price * $discount) / 100 : 0; 
        }
        return $priceDiscount;
    }

    public function _buildSecretKeyByCourse($courseId, $price)
    {
        $memberId = isset( Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $key = "@Hocplus123";        
        return hash_hmac('SHA256', $memberId.$courseId.$price, md5($key));
    }

    public function _generateRandomString($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function _buildSecretKeyOrder($orderCode)
    {
        $memberId = isset( Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $key = "@hocplus#order";
        return hash_hmac('SHA256', $memberId.$orderCode, md5($key));
    }

    public function _checkStatusOrder($orderCode, $method = '')
    {
        $order = Order::where(['order_code' => $orderCode])->first();               
        if(!$order){
            return ['error' => true, 'msg' => 'Không tìm thấy đơn hàng'];
        }
        if ($order->status & self::LOI_TT)
        {
            return  ['error' => true, 'msg' => 'Đơn hàng thanh toán lỗi'];            
        }   
        if ($order->status & self::TT_THANH_CONG || $order->status & self::CLIENT_DA_NHAN)
        {
            return ['error' => true, 'msg' => 'Đơn hàng đã thanh toán thành công từ trước đó'];            
        }
        if($method != 'ebanking'){
            if ($order->status & self::CHUYEN_CONG_TT)
            {            
                return ['error' => true, 'msg' => 'Đơn hàng đã chuyển sang cổng thanh toán'];            
            }
        }
        
             
        return ['error' => false, 'msg' => 'success', 'order' => $order];        
    }

    public function _encrypt( $string) 
    {
        $this->string = $string;
        $key = substr( hash( 'sha256',  $this->secret_key ), 0 ,32);
        $iv = substr( hash( 'sha256',  $this->secret_iv ), 0, 16 );
        $output = base64_encode( openssl_encrypt( $this->string, $this->encrypt_method, $key, 0, $iv ) );
        return $output;
    }

    public function _createTransaction($data)
    {
        $transaction = Transaction::create([
            'order_code' => isset($data['order_code']) ? $data['order_code']: '',
            'member_id' => $data['member_id'],
            'course_id' => isset($data['course_id']) ? $data['course_id']: 0,
            'subject_id' => isset($data['subject_id']) ? $data['subject_id']: 0,
            'class_id' => isset($data['class_id']) ? $data['class_id']: 0,
            'teacher_id' => isset($data['teacher_id']) ? $data['teacher_id']: 0,
            'money_payment' => $data['money_payment'],
            'method' => $data['method'],
            'type' => $data['type'],
            'money_before' => isset($data['money_before']) ? $data['money_before']: 0,
            'money_after' => isset($data['money_after']) ? $data['money_after']: 0,
            'seri' => isset($data['seri']) ? $data['seri']: '',
            'code' => isset($data['code']) ? $data['code']: '',
            'card_type' => isset($data['card_type']) ? $data['card_type']: '',
            'message' => isset($data['message']) ? $data['message']: ''
        ]);
        return $transaction;
    }

    public function _createMemberDeposit($idMember)
    {
        $memberId = $idMember;
        $memberDeposit = MemberDeposit::where(['member_id' => $memberId])->first();
        if(!$memberDeposit){
            $memberDeposit = MemberDeposit::create([
                'member_id' => $memberId,
                'deposit' => 0,
                'deposit_hash' => $this->_hashDeposit($memberId, 0),
                'deposit_status' => 1
            ]);
        }
        return $memberDeposit;
    }

    public function _hashDeposit($memberId, $deposit)
    {
        $key = 'hocplus@deposit';
        return md5($memberId.$deposit.md5($key));
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

    //refesh captcha
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function log_api($responseText, $url = 'current', $type = 'in', $orderId = null, $message = '')
    {
        try {
            if ($url == 'current')
            {
                $url = \Illuminate\Support\Facades\Route::getCurrentRoute()->uri();
            }
            return LogApi::insertGetId([
                'url' => $url,
                'type' => $type,
                'message' => $message,
                'method' => strtoupper(request()->method()),
                'params' => json_encode(request()->all()),
                'order_id' => $orderId,
                'response_text' => is_string($responseText) ? $responseText : json_encode($responseText),                
                'action' => \Illuminate\Support\Facades\Route::getCurrentRoute()->getActionName(),                
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function _replaceString($str){
        return preg_replace('/\s+/', '', $str);
    }
}