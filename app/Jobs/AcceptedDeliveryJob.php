<?php

namespace App\Jobs;

use App\Mail\AcceptedDeliverymail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class AcceptedDeliveryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $delivery;

    /**
     * Create a new job instance.
     */
    public function __construct($delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->delivery->order->artisan->email)->send(
            new AcceptedDeliverymail($this->delivery)
        );
    }
}
