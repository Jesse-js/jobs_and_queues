<?php

namespace App\Jobs;

use App\Mail\PaymentMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->attempts() >= 3) {
            $this->release(1);
        }
        Mail::to($this->user->email, $this->user->name)->send(new PaymentMail($this->user));
    }

    public function failed(): void
    {
        Log::error('Payment failed for user: ' . $this->user->name);
    }
}
