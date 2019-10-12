<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Application\Cms\Controllers\MController as Controller;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @param String $resetToken
     */
    public function sendOtpSms($phone = '0343035491', $content = 'hello world')
    {
        $APIKey = env('API_KEY_SMS');
        $SecretKey = env('SECRET_KEY_SMS');
        $YourPhone = $phone;
        $Content = $content;
        
        $SendContent = urlencode($Content);
        $data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&Smstype=2&brandname=HOCPLUS.VN";
        //De dang ky brandname rieng vui long lien he hotline 0902435340 hoac nhan vien kinh Doanh cua ban
        $curl = curl_init($data); 
        curl_setopt($curl, CURLOPT_FAILONERROR, true); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($curl); 
            
        $obj = json_decode($result,true); 
        return $obj;
    }
}
