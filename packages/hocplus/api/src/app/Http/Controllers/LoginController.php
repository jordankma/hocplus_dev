<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Application\Cms\Controllers\AController as Controller;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{

    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    
}