<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Studentprofile\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Studentprofile\App\Repositories\DemoRepository;
use Hocplus\Studentprofile\App\Models\Demo;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;
use Vne\Member\App\Models\Member;
use Hocplus\Studentprofile\App\Models\Course;
use Hocplus\Studentprofile\App\Models\MemberDeposit;
use Hocplus\Teacher\App\Models\Subject;
use Hocplus\Studentprofile\App\Models\Comments;
use Hash;
class StudentProfileController extends Controller
{ 
    public function index(Request $request) {
        $member_id = $request->input('member_id');
        //echo $member_id; die();
        if ($member_id != 0) {
            $member = Member::find($member_id);
            if ($member) {
                $validatedData = $request->validate([
                    'name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'gender' => 'required',
                    'school' => 'required',
                ]);                
                $name = $request->input('name');
                $address = $request->input('address');
                $phone = $request->input('phone');
                $school = $request->input('school');
                if ($request->input('gender')) {
                    $member->gender = $request->input('gender');
                }
                $day = ($request->input('day')>0)?$request->input('day'):1;
                $month = ($request->input('month')>0)?$request->input('month'):1;
                $year = ($request->input('year')>1970)?$request->input('year'):1970;
                /*echo $day; die();*/
                $member->birthday = $year.'-'.$month.'-'.$day;
                $member->name = $name;
                $member->address = $address;
                $member->phone = $phone;
                $member->school = $school;
				$member->status = 2;
                $file = $request->file('image');
             
                if ($file) {
                    //$destinationPath = '/images';
                    $fileName = $this->showUploadFile($request,$member_id);
                    if ($fileName != '') {
                        $member->avatar = $fileName; 
                    }
                }
                $member->save();
                return redirect()->back()->with('updateSuccess', 'Cập nhật Tài khoản thành công.'); 
            }
        }
        $USER_LOGGED = $this->user;
        $arr_birth = array(
            '1',
            '1',
            '1970'
        );
        if(isset($USER_LOGGED)) {
            $member_id = $USER_LOGGED->member_id;
            $birthday = $USER_LOGGED->birthday; 
            if ($birthday) {
                $arr_birth = explode('-',$birthday);
            }
            //var_dump($arr_birth); die();
        }       
        return view('HOCPLUS-STUDENTPROFILE::modules.studentprofile.index', compact('arr_birth'));
    }
    /**upload avatar*/
    public function showUploadFile(Request $request,$member_id) {
       $file = $request->file('image')->store('hocplus/student/'.$member_id. '/avatars','static');
       return '/files/' .$file;
    }    
    
    /* change password*/
    public function changePassword(Request $request) {
        $user = $this->user;
        if (!(Hash::check($request->get('current-password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu hiện tại chưa đúng.");
        }
        if(strcmp($request->get('new-password'), $request->get('retype-new-password')) != 0){
            //Current password and new password are not correct
            return redirect()->back()->with("error","Nhập lại mật khẩu chưa đúng.");
        }        
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới phải khác mật khẩu cũ.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required',
            'retype-new-password' => 'required',
        ]);
        //Change Password
        $model = new Member();
        $member = $model->find($user->member_id);
        if ($member) {
            $member->password = bcrypt($request->get('new-password'));
            $member->save();
            return redirect()->back()->with("success","Đổi mật khẩu thành công!");
        }
   }
   /* khoa hoc yeu thich */
   public function wishlist() {
       $user = $this->user;
       $member_id = $user->member_id;
       $model = new Course();
       $course = $model->getWishList($member_id);
       $subjectList = array();
       foreach ($course as $item) {
           $currentCourse = $model->find($item->course_id);
           $subject = $currentCourse->getSubject();
           $subjectList[$item->course_id] = $subject;
       }
       //print_r($subjectList); die();
       return view('HOCPLUS-STUDENTPROFILE::modules.studentprofile.wishlist', compact('course','subjectList'));
   }
   /* khoa hoc cua toi */
   public function myCourse(Request $request) {
       $subject = Subject::all();
       $user = $this->user;
       $member_id = $user->member_id;
       $model = new Course();
       $subject_id = $request->input('subject_id');
       $params = array();
       $params['subject_id'] = $subject_id;
       $params['keyword'] = $request->input('keyword');
       $params['date_from'] = $request->input('date_from');
       $params['date_to'] = $request->input('date_to');
       $params['status'] = $request->input('status');
       if ($params) {
            $course = $model->filter($member_id, $params); 
       }
       else {
            $course = $model->getWishList($member_id);
       }     
       $deposit = MemberDeposit::where('member_id',$member_id)->get()->first();
       $course_arr = array();
       //$model = new Course();
       foreach ($course as $item) {
           $model = $model->find($item->course_id);
           $course_arr[$item->course_id] = $model->getLesson()->get();
       }
       return view('HOCPLUS-STUDENTPROFILE::modules.studentprofile.mycourse', compact('subject','course','course_arr','params','deposit'));
   }
   /**
    * quan ly binh luan
    */
   public function myComment() {
       $user = $this->user;
       $member_id = $user->member_id;
       $comment = Comments::where('status',1)->where('user_id',$member_id)->where('course_id','!=',NULL)->paginate(5);
       return view('HOCPLUS-STUDENTPROFILE::modules.studentprofile.mycomment',compact('comment'));
   }
}