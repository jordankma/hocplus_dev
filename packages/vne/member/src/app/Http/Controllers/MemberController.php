<?php

namespace Vne\Member\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;

use Vne\Member\App\Repositories\MemberRepository;

use Vne\Member\App\Models\Member;
use Vne\Teacher\App\Models\Teacher;

use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator,DateTime;

class MemberController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct(MemberRepository $memberRepository)
    {
        parent::__construct();
        $this->member = $memberRepository;
    }

    public function manage()
    {
        return view('VNE-MEMBER::modules.member.member.manage');
    }
    public function manageStudent()
    {
        return view('VNE-MEMBER::modules.member.member.manage_student');
    }
    public function manageParent()
    {
        return view('VNE-MEMBER::modules.member.member.manage_parent');
    }

    public function manageFullVip()
    {
        return view('VNE-MEMBER::modules.member.member.manage_fullip');
    }

    public function create()
    {
        return view('VNE-MEMBER::modules.member.member.create');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:50',
            'user_name' => 'required|min:3|max:50',
            'password' => 'required|min:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$"',
            'conf_password' => 'required|min:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$"',
            'email' => 'required',
            'phone' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            if(isset($request->birthday) && $request->input('birthday') != ''){
                $date = new DateTime($request->input('birthday'));
                $birthday = $date->format('Y-m-d H:i:s');
            }
            $members = new Member();
            $members->name = $request->input('name');
            $members->gender = $request->input('gender');
            $members->user_name = $request->input('user_name');
            $members->password = bcrypt($request->input('password'));
            $members->phone = $request->input('phone');
            $members->email = $request->input('email');
            $members->type = $request->input('type');
            $members->avatar = $request->input('avatar');
            $members->facebook = $request->input('facebook');
            $members->intro = $request->input('intro');
            $members->birthday = $birthday;
            $members->address = $request->input('address');
            $members->created_at = new DateTime();
            $members->updated_at = new DateTime();
            if ($members->save()) {
                activity('member')
                    ->performedOn($members)
                    ->withProperties($request->all())
                    ->log('User: :causer.email - Add member - name: :properties.name, member_id: ' . $members->member_id);

                return redirect()->route('vne.member.member.manage')->with('success', trans('vne-member::language.messages.success.create'));
            } else {
                return redirect()->route('vne.member.member.manage')->with('error', trans('vne-member::language.messages.error.create'));
            }
        } else{
            return $validator->messages();
        }
    }
    public function createMemberFullVip()
    {
        return view('VNE-MEMBER::modules.member.member.create_fullvip');
    }

    public function addMemberFullVip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'password' => 'required|min:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$"',
            // 'conf_password' => 'required|min:8|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[#$^+=!*()@%&]).{8,}$"',
            'password' => 'required',
            'conf_password' => 'required',
            'email' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $members = new Member();
            $members->password = bcrypt($request->input('password'));
            $members->email = $request->input('email');
            $members->type = 'student';
            $members->full_vip = 1;
            $members->created_at = new DateTime();
            $members->updated_at = new DateTime();
            if ($members->save()) {
                activity('member')
                    ->performedOn($members)
                    ->withProperties($request->all())
                    ->log('User: :causer.email - Add member fullvip- name: :properties.name, member_id: ' . $members->member_id);

                return redirect()->route('vne.member.member.manage.fullvip')->with('success', trans('vne-member::language.messages.success.create'));
            } else {
                return redirect()->route('vne.member.member.manage.fullvip')->with('error', trans('vne-member::language.messages.error.create'));
            }
        } else{
            return $validator->messages();
        }
    }

    public function show(Request $request)
    {
        $member_id = $request->input('member_id');
        $member = $this->member->find($member_id);
        $data = [
            'member' => $member
        ];

        return view('VNE-MEMBER::modules.member.member.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:50',
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->input('member_id');
            $member = $this->member->find($member_id);
            if(isset($request->birthday) && $request->input('birthday') != ''){
                $date = new DateTime($request->input('birthday'));
                $birthday = $date->format('Y-m-d H:i:s');
            }
            $member->name = $request->input('name');
            $member->gender = $request->input('gender');
            if($request->has('password') && $request->input('password') != '' ){
                $member->password = bcrypt($request->input('password'));
            }
            $member->type = $request->input('type');
            $member->avatar = $request->input('avatar');
            $member->facebook = $request->input('facebook');
            $member->intro = $request->input('intro');
            $member->birthday = $birthday;
            $member->address = $request->input('address');
            $member->updated_at = new DateTime();

            if ($member->save()) {
                activity('member')
                    ->performedOn($member)
                    ->withProperties($request->all())
                    ->log('User: :causer.email - Update member - member_id: :properties.member_id, name: :properties.name');

                return redirect()->route('vne.member.member.manage')->with('success', trans('vne-member::language.messages.success.update'));
            } else {
                return redirect()->route('vne.member.member.show', ['member_id' => $request->input('member_id')])->with('error', trans('vne-member::language.messages.error.update'));
            }
        } else{
            return $validator->messages();
        }
    }

    public function getModalDelete(Request $request)
    {
        $model = 'member';
        $type = 'delete';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $confirm_route = route('vne.member.member.delete', ['member_id' => $request->input('member_id')]);
                return view('VNE-MEMBER::modules.member.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            } catch (GroupNotFoundException $e) {
                return view('VNE-MEMBER::modules.member.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    public function delete(Request $request)
    {
        $member_id = $request->input('member_id');
        $member = $this->member->find($member_id);

        if (null != $member) {
            $this->member->delete($member_id);

            activity('member')
                ->performedOn($member)
                ->withProperties($request->all())
                ->log('User: :causer.email - Delete member - member_id: :properties.member_id, name: ' . $member->name);

            return redirect()->route('vne.member.member.manage')->with('success', trans('vne-member::language.messages.success.delete'));
        } else {
            return redirect()->route('vne.member.member.manage')->with('error', trans('vne-member::language.messages.error.delete'));
        }
    }
    public function getModalDeleteFullVip(Request $request)
    {
        $model = 'member';
        $type = 'delete-fullvip';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $confirm_route = route('vne.member.member.delete-add-fullvip', ['member_id' => $request->input('member_id')]);
                return view('VNE-MEMBER::modules.member.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            } catch (GroupNotFoundException $e) {
                return view('VNE-MEMBER::modules.member.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    public function deleteFullVip(Request $request)
    {
        $member_id = $request->input('member_id');
        $member = $this->member->find($member_id);

        if (null != $member) {
            $member->full_vip = 0;
            $member->save();
            activity('member')
                ->performedOn($member)
                ->withProperties($request->all())
                ->log('User: :causer.email - Delete member full vip - member_id: :properties.member_id, name: ' . $member->name);

            return redirect()->route('vne.member.member.manage.fullvip')->with('success', trans('vne-member::language.messages.success.delete'));
        } else {
            return redirect()->route('vne.member.member.manage.fullvip')->with('error', trans('vne-member::language.messages.error.delete'));
        }
    }

    public function getModalAddFullVip(Request $request)
    {
        $model = 'member';
        $type = 'add-fullvip';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $confirm_route = route('vne.member.member.add-fullvip', ['member_id' => $request->input('member_id')]);
                return view('VNE-MEMBER::modules.member.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            } catch (GroupNotFoundException $e) {
                return view('VNE-MEMBER::modules.member.modal.modal_confirmation', compact('error', 'type', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    public function addFullVip(Request $request)
    {
        $member_id = $request->input('member_id');
        $member = $this->member->find($member_id);

        if (null != $member) {
            $member->full_vip = 1;
            $member->save();
            activity('member')
                ->performedOn($member)
                ->withProperties($request->all())
                ->log('User: :causer.email - Add member full vip - member_id: :properties.member_id, name: ' . $member->name);

            return redirect()->route('vne.member.member.manage.fullvip')->with('success', trans('vne-member::language.messages.success.delete'));
        } else {
            return redirect()->route('vne.member.member.manage.fullvip')->with('error', trans('vne-member::language.messages.error.delete'));
        }
    }

    public function log(Request $request)
    {
        $model = 'member';
        $confirm_route = $error = null;
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'id' => 'required|numeric',
        ], $this->messages);
        if (!$validator->fails()) {
            try {
                $logs = Activity::where([
                    ['log_name', $model],
                    ['subject_id', $request->input('id')]
                ])->get();
                return view('VNE-MEMBER::modules.member.modal.modal_table', compact('error', 'model', 'confirm_route', 'logs'));
            } catch (GroupNotFoundException $e) {
                return view('VNE-MEMBER::modules.member.modal.modal_table', compact('error', 'model', 'confirm_route'));
            }
        } else {
            return $validator->messages();
        }
    }

    //Table Data to index page
    public function data()
    {
        $members = $this->member->findAll();
        return Datatables::of($members)
            ->addColumn('actions', function ($members) {
                $actions = '';
                if ($this->user->canAccess('vne.member.member.log')) {
                    $actions .= '<a href=' . route('vne.member.member.log', ['type' => 'member', 'id' => $members->member_id]) . ' data-toggle="modal" data-target="#log"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#F99928" data-hc="#F99928" title="log member"></i></a>';
                }
                if ($this->user->canAccess('vne.member.member.show')) {
                    $actions .= '<a href=' . route('vne.member.member.show', ['member_id' => $members->member_id]) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update member"></i></a>';
                }
                // if ($this->user->canAccess('vne.member.member.confirm-add-fullvip') && $members->full_vip == 0) {
                //     $actions .= '<a href=' . route('vne.member.member.confirm-add-fullvip', ['member_id' => $members->member_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="plus" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Thêm tài khoản này fullvip"></i></a>';
                // }
                if ($this->user->canAccess('vne.member.member.confirm-delete')) {
                    $actions .= '<a href=' . route('vne.member.member.confirm-delete', ['member_id' => $members->member_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="trash" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete demo"></i></a>';
                }
                return $actions;
            })
            ->addColumn('name', function ($members) {
                $name = ''; 
                if( isset($members->name) && $members->name != ''){
                	$name .= "Tên: " . $members->name ;	
                }
                if( isset($members->phone) && $members->phone != ''){
                	$name .= " -" . "Sdt: " . $members->phone ;	
                }
                if( isset($members->email) && $members->email != ''){
                	$name .= " -" . "Email: " . $members->email ;	
                }
                return $name;   
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'name'])
            ->rawColumns(['actions'])
            ->make();
    }
    public function dataStudent()
    {
        $type = 'student';
        $members = $this->member->findAll($type);
        return Datatables::of($members)
            ->addColumn('actions', function ($members) {
                $actions = '';
                if ($this->user->canAccess('vne.member.member.log')) {
                    $actions .= '<a href=' . route('vne.member.member.log', ['type' => 'member', 'id' => $members->member_id]) . ' data-toggle="modal" data-target="#log"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#F99928" data-hc="#F99928" title="log member"></i></a>';
                }
                if ($this->user->canAccess('vne.member.member.show')) {
                    $actions .= '<a href=' . route('vne.member.member.show', ['member_id' => $members->member_id]) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update member"></i></a>';
                }
                if ($this->user->canAccess('vne.member.member.confirm-delete')) {
                    $actions .= '<a href=' . route('vne.member.member.confirm-delete', ['member_id' => $members->member_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="trash" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete demo"></i></a>';
                }
                return $actions;
            })
            ->addColumn('name', function ($members) {
                $name = ''; 
                if( isset($members->name) && $members->name != ''){
                	$name .= "Tên: " . $members->name ;	
                }
                if( isset($members->phone) && $members->phone != ''){
                	$name .= " -" . "Sdt: " . $members->phone ;	
                }
                if( isset($members->email) && $members->email != ''){
                	$name .= " -" . "Email: " . $members->email ;	
                }
                return $name;   
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'name'])
            ->make();
    }
    public function dataParent()
    {
        $type = 'parent';
        $members = $this->member->findAll($type);
        return Datatables::of($members)
            ->addColumn('actions', function ($members) {
                $actions = '';
                if ($this->user->canAccess('vne.member.member.log')) {
                    $actions .= '<a href=' . route('vne.member.member.log', ['type' => 'member', 'id' => $members->member_id]) . ' data-toggle="modal" data-target="#log"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#F99928" data-hc="#F99928" title="log member"></i></a>';
                }
                if ($this->user->canAccess('vne.member.member.show')) {
                    $actions .= '<a href=' . route('vne.member.member.show', ['member_id' => $members->member_id]) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update member"></i></a>';
                }
                if ($this->user->canAccess('vne.member.member.confirm-delete')) {
                    $actions .= '<a href=' . route('vne.member.member.confirm-delete', ['member_id' => $members->member_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="trash" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete demo"></i></a>';
                }
                return $actions;
            })
            ->addColumn('name', function ($members) {
                $name = ''; 
                if( isset($members->name) && $members->name != ''){
                	$name .= "Tên: " . $members->name ;	
                }
                if( isset($members->phone) && $members->phone != ''){
                	$name .= " -" . "Sdt: " . $members->phone ;	
                }
                if( isset($members->email) && $members->email != ''){
                	$name .= " -" . "Email: " . $members->email ;	
                }
                return $name;   
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'name'])
            ->make();
    }

    public function dataFullVip()
    {
        $type = 'fullvip';
        $members = $this->member->findAll($type);
        return Datatables::of($members)
            ->addColumn('actions', function ($members) {
                $actions = '';
                if ($this->user->canAccess('vne.member.member.confirm-delete-add-fullvip')) {
                    $actions .= '<a href=' . route('vne.member.member.confirm-delete-add-fullvip', ['member_id' => $members->member_id]) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="trash" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Xóa tài khoản fullvip"></i></a>';
                }
                return $actions;
            })
            ->addColumn('name', function ($members) {
                $name = ''; 
                if( isset($members->name) && $members->name != ''){
                	$name .= "Tên: " . $members->name ;	
                }
                if( isset($members->phone) && $members->phone != ''){
                	$name .= " -" . "Sdt: " . $members->phone ;	
                }
                if( isset($members->email) && $members->email != ''){
                	$name .= " -" . "Email: " . $members->email ;	
                }
                return $name;   
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'name'])
            ->make();
    }

    public function checkUserNameExist(Request $request){
        $data['valid'] = true;
        if ($request->ajax()) {
            $member =  Member::where(['user_name' => $request->user_name])->first();
            if ($member) {
                $data['valid'] = false; // true là có user
            }
        }
        echo json_encode($data);
    }

    public function checkEmailExist(Request $request){
        $data['valid'] = true;
        if ($request->ajax()) {
            $member =  Member::where(['email' => $request->email])->first();
            if ($member) {
                $data['valid'] = false; // true là có user
            }
        }
        echo json_encode($data);
    }

    public function checkPhoneExist(Request $request){
        $data['valid'] = true;
        if ($request->ajax()) {
            $member =  Member::where(['phone' => $request->phone])->first();
            if ($member) {
                $data['valid'] = false; // true là có user
            }
        }
        echo json_encode($data);
    }
}
