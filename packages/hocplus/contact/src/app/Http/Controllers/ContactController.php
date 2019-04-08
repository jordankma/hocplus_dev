<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Hocplus\Contact\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Hocplus\Contact\App\Repositories\DemoRepository;
use Hocplus\Contact\App\Models\Demo;
use Hocplus\Contact\App\Models\Contact;
use Hocplus\Teacher\App\Models\Subject;
use Hocplus\Teacher\App\Models\TblClass;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;

class ContactController extends Controller
{
    public function index(Request $request) {
        $subjects = Subject::all();
        $classes = TblClass::all();        
        return view('HOCPLUS-CONTACT::modules.contact.advice', compact('subjects', 'classes'));
    }
    /**
     * submit contact
     * @param Request $request
     */
    public function submit(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = '';
        $contact->content = '';
        $contact->class = isset($request->class)?$request->class:"";
        $contact->subject = isset($request->subject)?$request->subject:"";
        $contact->link_facebook = isset($request->link_facebook)?$request->link_facebook:"";
        $contact->save();   
        return redirect('/');
    }
}