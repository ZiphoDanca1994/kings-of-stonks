<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email to all the users with stock price updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $mail_to = $user->email;

            dispatch(new SendEmailJob($mail_to));
        }
    }
}
