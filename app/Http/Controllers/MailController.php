<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Auth;
use Session;

class MailController extends Controller{

    public function getTestPage(){
        return view('test.test');
    }
    
    public function getContactUs() {
        return view('real-estates.contact-us')->with('message');
    }        

    public function postContactUs(Request $request) {

        // $this->validate($request, [
        //     'title' => 't|required|unique:users',
        //     'password' => 'password|min:4',
        //     'image' => 'mimes:jpg,jpeg,png,PNG|max:4096'
        // ]);

        $from = $request->input('email');
        $subject = $request->input('subject');
        $firstName = $request->input('first-name');
        $lastName = $request->input('last-name');
        $messageContact = $request->input('message');  
        // $attachment = $request->attachment;  

        $data = array('from' => $from, 'subject' => $subject); //,'attachment' => $attachment       

        Mail::send('email-templates.email', array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'messageContact' => $messageContact,
            'from' => $from,
            'subject' => $subject), function($message) use ($data) {            
            $message->to('real.estates.project.2020@gmail.com')
            ->subject($data['subject'])
            // ->attach($data['attachment']->getRealPath(), array(
            //     'as' => $data['attachment']->getClientOriginalName(),
            //     'mime' => $data['attachment']->getMimeType()))
            ->from($data['from']);
        });
            
        return view('real-estates.contact-us')->with('message','Successfully Sent');
            
      }
}
