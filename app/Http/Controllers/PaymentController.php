<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(): void 
    {
        //dd(Auth::user()->email);
        // dd(new PaymentMail(Auth::user()));
        Mail::to(Auth::user()->email, Auth::user()->name)->send(new PaymentMail(Auth::user()));
    }
}
