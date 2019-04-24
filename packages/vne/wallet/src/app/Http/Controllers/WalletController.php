<?php

namespace Vne\Wallet\App\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Vne\Pay\App\Models\Course;
use Vne\Pay\App\Models\Voucher;
use Vne\Pay\App\Models\PayMethod;
use Vne\Pay\App\Models\Order;
use Vne\Pay\App\Models\MemberDeposit;
use Vne\Pay\App\Models\Transaction;
use Vne\Pay\App\Models\Cod;
use Vne\Pay\App\Models\MemberHasCourse;
use App\Libary\VNPay\VNPayPayment;
use GuzzleHttp\Client;
use Curl\Curl;
use Validator;

class WalletController extends Controller
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
    
    /**
     * @function danh sách lịch sử giao dịch
     * @param $request
     * @return view
     */
    public function manage(Request $request){
        $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $deposit = MemberDeposit::where(['member_id' => $memberId])->first();
        
        if(!$deposit){
            $deposit = MemberDeposit::create([
                'member_id' => $memberId,
                'deposit' => 0,
                'deposit_hash' => $this->_hashDeposit($memberId, 0),
                'deposit_rechange' => 0,
                'deposit_status' => 1
            ]);
        }

        if($deposit->deposit_status == 2){
            return response()->json([
                'status' => false,
                'msg' => 'Ví của bạn đang bị khóa vui lòng liên hệ BQT để được giúp đỡ!'
            ]);
        }
        
        $params = [
            'member_id' => $memberId,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'order' => 'desc',
            'limit' => 10,
            'start' => $request->start,
            'end' => $request->end
        ];
        $transactions = Transaction::customSearch($params);
        
        return view('VNE-WALLET::modules.wallet.index', compact('deposit', 'transactions'));
    }

    /**
     * @function view nap tien
     * @param request
     * @return view
    */
    public function recharge(Request $request){
        //kiem tra tai khoan nay da co vi?
        $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
        $deposit = MemberDeposit::where(['member_id' => $memberId])->first();
        if(!$deposit){
            MemberDeposit::create([
                'member_id' => $memberId,
                'deposit' => 0,
                'deposit_hash' => $this->_hashDeposit($memberId, 0),
                'deposit_rechange' => 0,
                'deposit_status' => 1
            ]);
        }

        if($deposit->deposit_status == 2){
            return response()->json([
                'status' => false,
                'msg' => 'Ví của bạn đang bị khóa vui lòng liên hệ BQT để được giúp đỡ!'
            ]);
        }
        
        $payMethods = PayMethod::where('type', '<>', 'cod')->orderBy('ordinal', 'asc')->get()->toArray();
        return view('VNE-WALLET::modules.wallet.recharge', compact('payMethods'));
    }

    public function rechargeVnpay(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'money_payment' => 'required|integer|min:10000'
            ]);

            if($validator->fails()){
                throw new \Exception('Dữ liệu không hợp lệ');
            }

            $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;

            $order = $this->_createOrderIn($memberId, $request->money_payment, 'ebanking');

            $uri_callback = route('vne.wallet.rechargeVnpayCallback', [
                'order_id' => $order->order_code,                    
            ]);

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
            
            if(isset($response['code']) && isset($response['redirect_url'])){
                if($response['code'] == '00' && !empty($response['redirect_url'])){
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

        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '.$e->getMessage()
            ]);
        }
    }

    public function rechargeVnpayCallback(Request $request){        
        try{
            $vnpay = new VNPayPayment();
            $response = $vnpay->verifyData();
            
            if($response){
                $order = Order::where('order_code', $request->order_id)->first();
                if(!$order){
                    $money_payment = 0;
                }                      
                $money_payment = $order->money_payment;          
                return view('VNE-WALLET::modules.wallet.checkin', ['order_code' => $request->order_id, 'method' => 'ebanking', 'money_payment' => $money_payment]);               
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

    /**
     * @function nap tin thu the hocplus
     * @param request
     * @return response
    */

    public function card(Request $request){
        try{
            $validator = Validator::make($request->all(), [                
                'captcha' => 'required|captcha',
                'card_code' => 'required',
                'card_seri' => 'required',                
            ], ['captcha.captcha' => 'Mã xác nhận không chính xác', 'captcha.required' => 'Bạn chưa nhập mã xác nhận']);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'errors' => $validator->messages(),
                    'msg' => 'Dữ liệu không hợp lệ',
                    'captcha'=> captcha_img()
                ]);
            }

            //tao don hang nap tien
            $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
            //kieu nap bang the so tien thanh toan o hoa don se = -1, sau khi nap the thanh cong thi update lai so tien thanh toan
            $order = $this->_createOrderIn($memberId, -1, 'card');

            $data = "code=" . $request->card_code . "&serial=" . $request->card_seri . "&user_id=" . $memberId . '&product_id='.$this->_productId.'&environment='.$this->_environment;

            $data_encrypt = $this->_encrypt($data);

            $curl = new Curl();

            $response = $curl->post('http://card.hocplus.vn/admin/api/card/wallet_charge?data='.$data_encrypt);

            $curl->close();

            //update trang thai don hang
            $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT;
            $order->card_seri = $request->card_seri;
            $order->card_code = $request->card_code;            
            $order->save();
            if($response->status){
                
                $res = $response->data;
                $deposit = $this->_getInfoDeposit($memberId); // lay thong tin vi

                //cap nhat don hang
                $order->total_money = $res->card_value;
                $order->money_payment = $res->card_value;
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::TT_THANH_CONG;
                $order->save();


                $logTransaction = [
                    'order_code' => $order->order_code,
                    'member_id' => $memberId,                   
                    'type' => 'in',
                    'money_payment' => $res->card_value,
                    'method' => 'card',
                    'money_before' => $deposit->deposit,
                    'money_after' => (int)$deposit->deposit + (int)$res->card_value,
                    'seri' => $request->card_seri,
                    'code' => $request->card_code,
                    'card_type' => 'hocplus',
                    'message' => 'Nạp tiền vào ví từ thẻ hocplus thành công'
                ];
                $transactionIn = $this->_createTransaction($logTransaction);
                if($transactionIn->transaction_id){
                    //Cộng tiền
                    $money_change = $deposit->deposit + $res->card_value;
                    $deposit->deposit = $money_change;
                    $deposit->deposit_hash = $this->_hashDeposit($deposit->member_id, $money_change);
                    $deposit->deposit_rechange = $deposit->deposit_rechange + $res->card_value;
                    $deposit->save();
                    
                    return response()->json([
                        'status' => true,
                        'msg' => 'Nạp tiền vào ví thành công',
                        'link' => route('vne.wallet.checkIn', ['order_code' => $order->order_code, 'method' => 'card', 'money_payment' => $res->card_value])
                    ]);
                } else {
                    throw new \Exception('Giao dịch thực hiện không thành công');
                }

            } else {
                //cap nhat don hang
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::LOI_TT;
                $order->save();
                throw new \Exception($response->messages);
            }

        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
    }

    public function checkIn(Request $request){
        $method = !empty($request->method) ? $request->method : '';
        $order_code = !empty($request->order_code) ? $request->order_code : 'Không tìm thấy mã hóa đơn';
        $money_payment = !empty($request->money_payment) ? $request->money_payment : 0;

        return view('VNE-WALLET::modules.wallet.checkin', ['order_code' => $order_code, 'method' => $method, 'money_payment' => $money_payment]);
    }

    public function transfer(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'money_payment' => 'required|integer|min:10000'
            ]);
            
            if($validator->fails()){
                throw new \Exception($validator->messages());
            }

            //tao don hang nap tien
            $memberId = isset(Auth::guard('member')->user()->member_id) ? Auth::guard('member')->user()->member_id : 1;
           
            $order = $this->_createOrderIn($memberId, $request->money_payment, 'transfer');

            $tranfer = Cod::create([
                'order_code' => $order->order_code,
                'name' => isset(Auth::guard('member')->user()->name) ? Auth::guard('member')->user()->name : 'daochien',
                'phone' => isset(Auth::guard('member')->user()->phone) ? Auth::guard('member')->user()->phone : '0335300793',
                'address' => isset(Auth::guard('member')->user()->address) ? Auth::guard('member')->user()->address : 'Ha Noi',               
                'type' => 'transfer'
            ]);

            if($tranfer->cod_id){
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT;
                $order->save();
                return response()->json([
                    'status' => true,
                    'msg' => 'successfully',
                    'redirect' => route('vne.wallet.checkIn', ['order_code' => $order->order_code, 'method' => 'transfer', 'money_payment' => $request->money_payment])
                ]);
            } else {
                $order->status = self::TAO_DON_HANG | self::CHUYEN_CONG_TT | self::LOI_TT;
                $order->save();
                throw new \Exception('Giao dịch không thành công');
            }

        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'Lỗi: '. $e->getMessage()
            ]);
        }
    }

    public function _getInfoDeposit($memberId){        
        $deposit = MemberDeposit::where(['member_id' => $memberId])->first();
        return $deposit;
    }
    /**
     * @function tao hoa don nap tien vao vi
     * @param 
     * @return order
     */
    public function _createOrderIn($memberId, $money_payment, $method = ''){
        $order = Order::create([
            'order_code' => 'hp_'.$this->_generateRandomString(6).'_'.time(),
            'user_id' => $memberId,            
            'total_money' => $money_payment,
            'total_discount' => 0,
            'money_payment' => $money_payment,
            'status' => 0,
            'type' => 'in',
            'method' => $method
        ]);
        return $order;
    }

    public function _createTransaction($data){
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

    public function _generateRandomString($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function _hashDeposit($memberId, $deposit){
        $key = 'hocplus@deposit';
        return md5($memberId.$deposit.md5($key));
    }

    //refesh captcha
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function _encrypt( $string) {
        $this->string = $string;
        $key = substr( hash( 'sha256',  $this->secret_key ), 0 ,32);
        $iv = substr( hash( 'sha256',  $this->secret_iv ), 0, 16 );
        $output = base64_encode( openssl_encrypt( $this->string, $this->encrypt_method, $key, 0, $iv ) );
        return $output;
    }

}

