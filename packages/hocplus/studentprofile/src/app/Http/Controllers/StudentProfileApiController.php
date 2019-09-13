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
class StudentProfileApiController extends Controller
{ 
    public function index(Request $request) {       
        $member_id = $request->input('member_id');
        if ($member_id != 0) {
            $member = Member::find($member_id);
            if ($member) { 
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
                /***/
                $member->birthday = $year.'-'.$month.'-'.$day;
                $member->name = $name;
                $member->address = $address;
                $member->phone = $phone;
                $member->school = $school;
		$member->status = 2;   
                /*   
                $file = $request->file('image');
             
                if ($file) {
                    //$destinationPath = '/images';
                    $fileName = $this->showUploadFile($request,$member_id);
                    if ($fileName != '') {
                        $member->avatar = $fileName; 
                    }
                }*/
                $success = $member->save();  
                if ($success) {
                    $result = array("success" => true,"message" => "ok!");
                    return $result;
                }
                else {
                    $result = array("success" => false,"message" => "fail!");
                    return $result;
                }
            } 
            else {
                $result = array("success" => false,"message" => "fail!");
                return $result;
            }			
        }
        else {
            $result = array("success" => false,"message" => "fail!");
            return $result;
        }
    }
    /* update avatar */
    public function avatar(Request $request) {
                $file = $request->file('image');
                $member_id = $request->input('member_id');
                $member = Member::find($member_id);
                if ($file) {
                    //$destinationPath = '/images';
                    $fileName = $this->showUploadFile($request,$member_id);
                    if ($fileName != '') {
                        $member->avatar = $fileName; 
                        $success = $member->save();  
                        if ($success) {
                            $result = array("success" => true,"message" => "ok!");
                            return $result;
                        }
                        else {
                            $result = array("success" => false,"message" => "fail!");
                            return $result;
                        }                       
                        
                    }
                }        
    }
    /** get the member info */
	public function getinfo(Request $request) {
		$member_id = intval($request->input('member_id'));
		$member = Member::find($member_id);
		$member->avatar = 'http://static.hocplus.vn'.$member->avatar;
		if ($member) {
			$result = array(
				'data' => $member,
				'success' => true,
				'message' => 'ok'
			);
		}
		else {
			$result = array(
				'success' => false,
				'message' => 'fail'
			);			
		}
		return $result;
	}
        /**upload avatar*/
        public function showUploadFile(Request $request,$member_id) {
           $file = $request->file('image')->store('hocplus/student/'.$member_id. '/avatars','static');
           return '/files/' .$file;
        }    
}