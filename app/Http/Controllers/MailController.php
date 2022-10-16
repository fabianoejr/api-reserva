<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail() {

       // $name = 'Fabiano';
       // $email = '123123';
       // $url = 'www.google.com.br';
       // Mail::to('fabianoeliasjunior@hotmail.com')->send(new SignUp($name,$email,$url));

        return view('SignUpView');
    }
}
