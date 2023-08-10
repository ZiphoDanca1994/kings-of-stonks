<?php

namespace App\Jobs;

use App\Models\StockTicker;
use Carbon\Carbon;
use Mail;
use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_to;

    /**
     * Create a new job instance.
     */
    public function __construct($mail_to)
    {
        $this->mail_to = $mail_to;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $stockTickers = StockTicker::whereDate('date', Carbon::now())->get();

        Mail::to($this->mail_to)->send(new SendEmail($stockTickers));
    }
}
