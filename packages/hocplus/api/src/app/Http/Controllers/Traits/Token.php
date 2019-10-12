<?php

namespace Hocplus\Api\App\Http\Controllers\Traits;

use Hocplus\Api\App\Models\Teacher;
use Hocplus\Api\App\Models\Member;
use Hocplus\Api\App\Models\Course;
use Hocplus\Api\App\Models\Lesson;
use Hocplus\Api\App\Models\Token as TokenModel;
use Validator;
use Cache;

trait Token
{
    public function getToken($request)
    {
        $data = '{
                    "status" : false,
                    "message" : "Something error!"
                }';

        $teacher_id = $request->input('teacher_id', 0);
        $member_id = $request->input('member_id', 0);
        $course_id = $request->input('course_id');
        $lesson_id = $request->input('lesson_id');
        $type = $request->input('type');
        $timeNow = time();
        if (is_numeric($member_id) && is_numeric($teacher_id) && is_numeric($course_id) && is_numeric($lesson_id)) {

            $courseDetail = Course::find($course_id);
            if ($courseDetail) {
                $timeStart = $courseDetail->date_start;
                $timeEnd = $courseDetail->date_end;

                if ($timeNow < $timeEnd && $timeStart < $timeNow) {
                    $lessonDetail = Lesson::find($lesson_id);
                    if ($lessonDetail) {

                        $timeStartLesson = $lessonDetail->date_start;
                        $timeEndLesson = $lessonDetail->date_start + $lessonDetail->time_line * 60;
                        if ($timeNow < $timeEndLesson && $timeStartLesson < $timeNow) {
                            
                            if ($type == 'teacher' && $courseDetail->teacher_id == $teacher_id) {
                                //for teacher
                                $memberToken = TokenModel::where('member_id', $teacher_id)
                                    ->where('course_id', $course_id)
                                    ->where('lesson_id', $lesson_id)
                                    ->where('type', $type)
                                    ->first();

                                if ($memberToken) {
                                    $token = $memberToken->token;
                                } else {
                                    //create token access
                                    $token = str_random('60');
                                    $fp = new TokenModel([
                                        'member_id' => $teacher_id,
                                        'course_id' => $course_id,
                                        'lesson_id' => $lesson_id,
                                        'type' => $type,
                                        'token' => $token,
                                        'expired_at' => $lessonDetail->date_start + $lessonDetail->time_line * 60 + 3600
                                    ]);
                                    $fp->save();
                                }

                                $data = '{
                                        "status" : true,
                                        "data" : {
                                            "token": "' . $token . '"
                                        }
                                    }';
                            } else {
                                //for student and parent
                                $memberDetail = Member::where('full_vip', 1)
                                    ->orWhereHas('course', function ($query) use ($course_id) {
                                        $query->where('hocplus_member_has_course.course_id', $course_id);
                                    })->find($member_id);

                                if ($memberDetail) {

                                    $memberToken = TokenModel::where('member_id', $member_id)
                                        ->where('course_id', $course_id)
                                        ->where('lesson_id', $lesson_id)
                                        ->where('type', $type)
                                        ->first();

                                    if ($memberToken) {
                                        $token = $memberToken->token;
                                        if ($memberToken->expired_at < $timeNow) {
                                            $token = '';
                                            $data = '{
                                                "status" : false,
                                                "message" : "Token expired!"
                                            }';
                                        }
                                    } else {
                                        //create token access
                                        $token = str_random('60');
                                        $fp = new TokenModel([
                                            'member_id' => $member_id,
                                            'course_id' => $course_id,
                                            'lesson_id' => $lesson_id,
                                            'type' => $type,
                                            'token' => $token,
                                            'expired_at' => time() + $lessonDetail->time_line * 60 + 3600
                                        ]);
                                        $fp->save();
                                    }

                                    if ($token != '') {
                                        $data = '{
                                            "status" : true,
                                            "data" : {
                                                "token": "' . $token . '"
                                            }
                                        }';
                                    }

                                }
                            }

                        }
                    }
                }
            }

        }

        $data = str_replace('null', '""', $data);
        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function verifyToken($request)
    {
        // dd('1');
        $data = '{
                    "status" : false,
                    "message" : "Something error!"
                }';

        $token = $request->input('token');
        $timeNow = time();

        $type = '';
        $member_id = '';
        $course_id = '';
        $lesson_id = '';

        $tokenDetail = TokenModel::where('token', $token)->orderBy('id', 'desc')->first();
        if ($tokenDetail) {
            $expired_at = $tokenDetail->expired_at;
            if ($expired_at > $timeNow) {
                $type = $tokenDetail->type;
                $member_id = $tokenDetail->member_id;
                $course_id = $tokenDetail->course_id;
                $lesson_id = $tokenDetail->lesson_id;
            }
        }

        if (is_numeric($member_id) && is_numeric($course_id) && is_numeric($lesson_id)) {

            $courseDetail = Course::find($course_id);
            if ($courseDetail) {
                $lessonDetail = Lesson::find($lesson_id);
                if ($lessonDetail) {

                    if ($type == 'teacher' && $courseDetail->teacher_id == $member_id) {
                        $memberDetail = Teacher::find($member_id);
                        if ($memberDetail) {
                            $avatar = ($memberDetail->avatar != '' || file_exists(substr($memberDetail->avatar, 1))) ? config('site.url_static') . $memberDetail->avatar :  config('site.url_static') . '/vendor/vnedutech-cms/default/hocplus/frontend/images/user.png';
                            $userName = ($memberDetail->phone != '') ? $memberDetail->phone : $memberDetail->email;
                            $data = '{
                                "status" : true,
                                "data" : {
                                    "typeOfUser": "' . $tokenDetail->type . '",
                                    "userName": "' . $userName . '",
                                    "userID": "' . $member_id . '",
                                    "avatar": "' . $avatar . '",
                                    "lessonID": "' . $lesson_id . '",
                                    "courseName": "' . $courseDetail->name . '",
                                    "lessonName": "' . $lessonDetail->name . '",
                                    "duration": ' . $lessonDetail->time_line . '
                                }
                            }';
                        }
                    } else {
                        //for student or parent
                        // dd($member_id);
                        // $memberDetail = Member::where('full_vip', 1)
                        //     ->orWhereHas('course', function ($query) use ($course_id) {
                        //         $query->where('hocplus_member_has_course.course_id', $course_id);
                        //     })->where('member_id',$member_id)->first();
                        $memberDetail = Member::where('member_id',$member_id)
                        ->where(function($queryA) use ($course_id){
                            $queryA->where('full_vip', 1)
                            ->orWhereHas('course', function ($query) use ($course_id) {
                                $query->where('hocplus_member_has_course.course_id', $course_id);
                            });
                        })->first();
                            // dd($memberDetail);
                        if ($memberDetail) {
                            $avatar = ($memberDetail->avatar != '' || file_exists(substr($memberDetail->avatar, 1))) ? config('site.url_static') . $memberDetail->avatar :  config('site.url_static') . '/vendor/vnedutech-cms/default/hocplus/frontend/images/user.png';
                            $userName = ($memberDetail->phone != '') ? $memberDetail->phone : $memberDetail->email;
                            $data = '{
                                "status" : true,
                                "data" : {
                                    "typeOfUser": "' . $tokenDetail->type . '",
                                    "userName": "' . $userName . '",
                                    "userID": "' . $member_id . '",
                                    "avatar": "' . $avatar . '",
                                    "lessonID": "' . $lesson_id . '",
                                    "courseName": "' . $courseDetail->name . '",
                                    "lessonName": "' . $lessonDetail->name . '",
                                    "duration": ' . $lessonDetail->time_line . '
                                }
                            }';
                        }
                    }

                }
            }

        }

        $data = str_replace('null', '""', $data);
        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function recordLesson($request)
    {
        $data = '{
                    "status" : false,
                    "message" : "Something error!"
                }';

        $data = str_replace('null', '""', $data);
        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }
}