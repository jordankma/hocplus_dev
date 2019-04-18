<?php

namespace Vne\Payment\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Vne\Payment\App\Models\Payment;
use Spatie\Activitylog\Models\Activity;
use Validator;

class PaymentController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct()
    {
        parent::__construct();        
    }

    public function create(){
        return view('VNE-PAYMENT::modules.payment.create');
    }
    
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'code' => 'required',
            'img' => 'required',
            'notifi' => 'required'
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Vui lòng kiểm tra lại dữ liệu']);
        } else {
            
            $payment = Payment::create([
                'name' => $request->name,
                'code' => $request->code,
                'img' => $request->img,
                'img_hover' => $request->img_hover,
                'type' => $request->type,
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key,
                'status' => $request->status,
                'ordinal' => $request->ordinal,
                'notifi' => $request->notifi
            ]);
            if($payment->payment_id){
                activity('hocplus_payments')->performedOn($payment)->withProperties($request->all())->log('Thêm phương thức thanh toán - payment_id: '.$payment->payment_id); 
                return redirect()->back()->with(['success' => 'Thêm phương thức thanh toán thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thêm phương thức thanh toán không thành công']);
            }
        }
    }
    
    public function update(Request $request){
        if(empty($request->payment_id)){
            return redirect()->back()->with(['error' => 'Không tìm thấy phương thức thanh toán']);
        }
        $payment = Payment::findOrFail($request->payment_id);
        return view('VNE-PAYMENT::modules.payment.edit', compact('payment'));
    }
    
    public function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'code' => 'required',
            'img' => 'required',
            'payment_id' => 'required',
            'notifi' => 'required'
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Vui lòng kiểm tra lại dữ liệu']);
        } else {
            $payment = Payment::findOrFail($request->payment_id);
            $payment->name = $request->name;
            $payment->type = $request->type;
            $payment->code = $request->code;
            $payment->img = $request->img;
            $payment->img_hover = $request->img_hover;
            $payment->status = $request->status;
            $payment->client_id = $request->client_id;
            $payment->secret_key = $request->secret_key;
            $payment->ordinal = $request->ordinal;
            $payment->notifi = $request->notifi;
            $payment->save();
            activity('hocplus_payments')->performedOn($payment)->withProperties($request->all())->log('Cập nhật phương thức thanh toán - payment_id: '.$payment->payment_id); 
            return redirect()->route('vne.payment.manage')->with(['success' => 'Cập nhật Phương thức thanh toán thành công']);
        }
    }
    
    public function manage(){
        $payments = Payment::customSearch([]);
        return view('VNE-PAYMENT::modules.payment.manage', compact('payments'));
    }
    
    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Xóa phương thức không thành công']);  
        } else {
            $payment = Payment::findOrFail($request->payment_id);
            $payment->deleted_at = date('Y-m-d H:i:s');
            $payment->save();
            activity('hocplus_payments')
                ->performedOn($payment)
                ->withProperties($request->all())
                ->log('Xóa phương thức - payment_id: '.$request->payment_id);
            return redirect()->back()->with(['success' => 'Xóa  phương thức thành công']);
        }
    }

    public function createDetail(Request $request){
        if(empty($request->payment_id)){
            return redirect()->back()->with(['error' => 'Không tìm thấy thông tin phương thức thanh toán']);
        }

        $payment = Payment::findOrFail($request->payment_id);
        if($payment->type == 'cod'){
            return redirect()->back()->with(['error' => 'COD không được thêm thông tin chi tiết']);
        }
        return view('VNE-PAYMENT::modules.payment.create_detail', compact('payment'));
    }

    public function addDetail(Request $request){               
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required',
            'payment_type' => 'required'           
        ], $this->messages);
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Không tìm thấy phương thức thanh toán']);  
        } else {
            $payment = Payment::findOrFail($request->payment_id);
            if($payment->type != $request->payment_type){
                return redirect()->back()->with(['error' => 'Không tìm thấy phương thức thanh toán']);
            }

            if($payment->type == 'transfer'){
                if(!empty($request->name) && !empty($request->account) && !empty($request->img)){
                    foreach($request->name as $i => $name){
                        $dataInfo[] = [
                            'name' => $name,
                            'account' => $request->account[$i],
                            'img' => $request->img[$i]
                        ];
                    }                   
                }
                $detail = [
                    'type' => $payment->type,
                    'content' => !empty($request->transfer_content) ?  $request->transfer_content : 'Nội dung mặc định',
                    'info' => !empty($dataInfo) ? $dataInfo : []
                ];
                
            }

            if($payment->type == 'ebanking'){
                $detail = [
                    'type' => $payment->type,
                    'content' => !empty($request->ebanking_content) ? $request->ebanking_content : 'Nội dung mặc định'                    
                ];
            }

            if($payment->type == 'card'){
                if(!empty($request->card_type) && !empty($request->img)){
                    foreach($request->card_type as $i => $type){
                        $dataInfo[] = [
                            'card_type' => $type,
                            'img' => isset($request->img[$i]) ? $request->img[$i] : '',
                        ]; 
                    }
                    
                }
                $detail = [
                    'type' => $payment->type,
                    'content' => !empty($request->ebanking_content) ? $request->ebanking_content : 'Nội dung mặc định',
                    'info' => !empty($dataInfo) ? $dataInfo : []                   
                ];
            }
            //dd($detail);
            $payment->detail = json_encode($detail);
            $payment->save();
            return redirect()->route('vne.payment.manage')->with(['success' => 'Thêm thông tin chi tiết phương thức thanh toán thành công']);
        }
    }
    
    public function log(Request $request)
    {
        $model = 'hocplus_payments';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'payment_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $logs = Activity::where([
                    ['log_name', $model],
                    ['subject_id', $request->input('payment_id')]
                ])->get();
                return view('includes.modal_table', compact('error', 'model', 'confirm_route', 'logs'));
            } catch (GroupNotFoundException $e) {
                return view('includes.modal_table', compact('error', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }
}
