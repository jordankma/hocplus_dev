<?php

namespace Hocplus\Rating\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Hocplus\Rating\App\Repositories\DemoRepository;
use Hocplus\Rating\App\Models\Rating;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;
use Hocplus\Coursegroup\App\Models\Course;
class RatingController extends Controller
{
    public function index($course_id) {
        $course = Course::findOrfail($course_id);
        $rate = 0;
        $rating = new Rating;
        $rate_result = $rating->where('course_id', '=',$course_id)->get();
        $stars = array();
        $total = count($rate_result);
        $dem = 0;
        for ($i= 1; $i<=5; $i++) {
            $stars[$i] = 0;
            foreach ($rate_result as $item) {
                if ($item->rate == $i) {
                    $stars[$i]++;
                    $dem++;
                    $rate = $rate + $i;
                }
            }
            
            if ($total >0) {
                $stars[$i] = round(100*$stars[$i]/$total);
            }
            
        }
        if ($dem>0) {
            $rate = round($rate/$dem,1); 
        }
        else {
            $rate = 0;
        }
        $member = $this->user;
        if ($member) {
            $member_id = $member->member_id;
        }
        else {
            $member_id = 0;
        }
        return view('HOCPLUS-RATING::modules.rating.index', compact('rate', 'stars','course_id','member_id'));
    }
    
    public function submit(Request $request) {
        $rating = new Rating;
        
        if ($request->member_id>0) {
            $rating_exist = Rating::where('member_id','=',$request->member_id)->where('course_id',$request->course_id)->get();
            if (count($rating_exist)>0) {
                $result = array('result' => 0, 'rate' => $request->rate);
                return json_encode($result);
            }
            else {
                $rating->course_id = $request->course_id;
                $rating->member_id = $request->member_id;
                $rating->rate = $request->rate;
                $rating->save();
                $result = array('result' => 1, 'rate' => $request->rate);
                return json_encode($result);
            }
        }
        else {
            $result = array('result' => 2, 'rate' => $request->rate);
            return json_encode($result);
        }
    }
}
