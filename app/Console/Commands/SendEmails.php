<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command example. We are sending an email to the specified user.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user_id = $this->argument('user');
        $user = User::find($user_id);

        $email = $user->email;
        Log::info("Email enviado a $email");
    }
}
