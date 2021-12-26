<?php

namespace App\Http\Controllers;

use App\Models\Case_members;
use Illuminate\Http\Request;
use App\Models\Case_members_task;
use App\Models\Cases;
use App\Models\Session;
use App\Models\Person;
use Carbon\Carbon;
use Auth;
class ShowSettingsController extends Controller
{

    public function unfinish(){
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $unfinsh=Case_members_task::where('task_status_id','=',2)->orderBy('id', 'DESC')->get();

        } else {
            $unfinsh=Case_members_task::where('task_status_id','=',2)->where('member_id',$user->id)->orderBy('id', 'DESC')->get();

        }

        // $unfinsh=Case_members_task::where('task_status_id','=',2)->get();
        return view('unfinish.index',compact('unfinsh'));
    }
    public function finish(){
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $finsh=Case_members_task::where('task_status_id','=',1)->orderBy('id', 'DESC')->get();

        } else {
            $finsh=Case_members_task::where('task_status_id','=',1)->where('member_id',$user->id)->orderBy('id', 'DESC')->get();

        }
        // $finsh=Case_members_task::where('task_status_id','=',1)->get();
        return view('finish.index',compact('finsh'));
    }

    public function courtComming(){
$commingSessions=Session::whereDate('session_date','>',Carbon::today()->toDateString())->get();
return view('court-comming.index',compact('commingSessions'));

    }
//exec_dision_no
    public function courtOld(){
        $oldSessions=Session::whereDate('session_date','<',Carbon::today()->toDateString())->get();
        return view('court-old.index',compact('oldSessions'));

            }

            public function dision(){
                $data=Cases::whereNotNull('exec_dision_no')->get();
                return view('dision.index',compact('data'));

                    }
                    //showDision
                    public function showDision($id){
                        $row=Cases::where('id',$id)->first();
                        $member=Case_members::where('case_id',$id)->where('active',1)->first();
                        return view('dision.show',compact('row','member'));

                            }


                            public function clients(){
                                $data=Person::where('preson_type','=',0)->get();
                                return view('client.index',compact('data'));

                                    }
                                    //showDision
                                    public function showClient($id){
                                        $row=Person::where('id',$id)->first();
                                        return view('client.show',compact('row'));

                                            }


                                            public function Oppenonts(){
                                                $data=Person::where('preson_type','=',1)->get();
                                                return view('oppenont.index',compact('data'));

                                                    }
                                                    //showopp
                                                    public function showoppenont($id){
                                                        $row=Person::where('id',$id)->first();
                                                        return view('oppenont.show',compact('row'));

                                                            }
}
