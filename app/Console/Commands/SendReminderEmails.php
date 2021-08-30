<?php

namespace App\Console\Commands;

use App\User;
use App\Property;
use Carbon\Carbon;
use App\Mail\ReminderEmail;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Mail;


class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Notifications to users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get all records which will expire in 8 days
        $properties = Property::with(['user'])->where('expiry_date', '=', Carbon::now()->addDays(8)->toDateString())->get();
        
        // group users
        $data = [];

        foreach ($properties as $property) {
            $data[$property->user_id][] = $property->toArray();
        }
        // dd($data);

        foreach ($data as $user_id => $properties) {
            $this->sendEmailToUser($user_id, $properties);
        }

    }

    public function schedule(Schedule $schedule){
        
    }

    private function sendEmailToUser($user_id, $properties){
        $user = User::find($user_id);
        Mail::to($user)->send(new ReminderEmail($properties));
            
    }
}
