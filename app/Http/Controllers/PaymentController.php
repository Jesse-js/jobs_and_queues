<?php

namespace App\Http\Controllers;

use App\Jobs\PaymentJob;
use App\Jobs\TestJob;
use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(): void
    {
        // Mail::to(Auth::user()->email, Auth::user()->name)->send(new PaymentMail(Auth::user()));
        PaymentJob::dispatch(Auth::user())
            ->delay(now()->addSeconds(5))
            ->onQueue('payments');
        TestJob::dispatch();
        echo 'Enviado';
    }
}
