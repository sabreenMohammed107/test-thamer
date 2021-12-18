<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;
use App\Models\Case_members_task;
use App\Models\Session;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
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
        $commingSessions=Session::whereDate('session_date','>',Carbon::today()->toDateString())->get()->count();
        $oldSessions=Session::whereDate('session_date','<',Carbon::today()->toDateString())->get()->count();
        $clients=Person::where('preson_type','=',0)->get()->count();
        $oppont=Person::where('preson_type','=',1)->get()->count();
$users=User::all()->count();
        return view('home', compact('cases','unfinsh','finsh','commingSessions','oldSessions','clients','oppont','users'));
    }
}
