<?php

namespace App\Console\Commands;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\SessionNotification;

class CourtCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'court:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // return 0;
        $user = Auth::user();
        $date = Carbon::now()->addMonth();
        Hijri::Date('l ، j F ، Y', $date);
        $nowHijri=Hijri::Date('Y/m/d');



      $users=User::all();

      $commingSessions=Session::whereDate('session_date','>',$nowHijri)->get();
      foreach($commingSessions as $commingSession){
        foreach($users as $user){
            if ( $user->hasRole('Admin')) {
                $remaining_days = Carbon::parse($nowHijri)->diffInDays(Carbon::parse($commingSession->session_date));
                \Log::info($remaining_days);
                if($remaining_days == 1){
                    \Log::info("Admin! + " .$user->id .''.$commingSession->session_date);
                    $user->notify(new SessionNotification($commingSession));
                }


            }
            else {
                if($user->id == $commingSession->member_id ){
                    \Log::info("User !" .$commingSession->session_date);
                }
            }
      }
        \Log::info("Cron is working fine!");
    }
}
}
