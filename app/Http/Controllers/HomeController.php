<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;
use App\Models\Case_members_task;
use App\Models\Session;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Alkoumi\LaravelHijriDate\Hijri;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cases=Cases::all()->count();
        $unfinsh=Case_members_task::where('task_status_id','=',2)->get()->count();
        $finsh=Case_members_task::where('task_status_id','=',1)->get()->count();
        // $commingSessions=Session::whereDate('session_date','>',Carbon::today()->toDateString())->get()->count();
        $user = Auth::user();
        $date = Carbon::now()->addMonth();
        Hijri::Date('l ، j F ، Y', $date);
        $nowHijri=Hijri::Date('Y/m/d');
        if ($user->hasRole('Admin')) {
                         $commingSessions=Session::whereDate('session_date','>=',$nowHijri)->get()->count();


        } else {
                         $commingSessions=Session::whereDate('session_date','>=',$nowHijri)->where('member_id',$user->id)->get()->count();

        }
        // $oldSessions=Session::whereDate('session_date','<',Carbon::today()->toDateString())->get()->count();
        $user = Auth::user();
        $ss=Session::where('id',9)->first();
        // $r= Carbon::createFromFormat('Y-m-d', $ss->session_date)->format('d-m-Y');
        $date = Carbon::now()->addMonth();
        Hijri::Date('l ، j F ، Y', $date);
        $nowHijri=Hijri::Date('Y/m/d');
// dd($nowHijri);
        if ($user->hasRole('Admin')) {

            $oldSessions=Session::whereDate( 'session_date','<',$nowHijri)->get()->count();

        } else {
            $oldSessions=Session::whereDate( 'session_date','<',$nowHijri)->where('member_id',$user->id)->get()->count();
        }
        $clients=Person::where('preson_type','=',0)->get()->count();
        $oppont=Person::where('preson_type','=',1)->get()->count();
$users=User::all()->count();
$usersNow=User::all();
$Notifications=Auth::user()->notification;
        return view('home', compact('cases','unfinsh','finsh','commingSessions','oldSessions',
        'clients','oppont','users','usersNow','Notifications'));
    }
}
