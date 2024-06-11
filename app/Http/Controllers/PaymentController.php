<?php

namespace App\Http\Controllers;

use App\Jobs\PaymentJob;
use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(): void
    {
        PaymentJob::dispatch(Auth::user());
    }
}
