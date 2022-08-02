<?php

namespace App\Http\Controllers;
use App\Models\Attachment;
use App\Models\Branch;
use App\Models\Cases;
use App\Models\Case_members;
use App\Models\Case_members_task;
use App\Models\Case_type;
use App\Models\City;
use App\Models\Court;
use App\Models\Diary;
use App\Models\Fees_installment;
use App\Models\Interceptions_regulation;
use App\Models\Letter;
use App\Models\Nationality;
use App\Models\Person;
use App\Models\Petition;
use App\Models\Session;
use App\Models\task_type;
use App\Models\User;
use App\Models\Users_branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Notification;
use App\Notifications\MyFirstNotification;
use Illuminate\Database\QueryException;
class PresdureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Case_members_task::where('id', $id)->first();
        switch ($task->task_type_id) {
            case 1:
                $regulation = Interceptions_regulation::where('id', $task->regulation_id)->first();
                return view('presdure.viewRegulation', compact('regulation'));
                break;

            case 2:
                $diary = Diary::where('id', $task->diary_id)->first();
                return view('presdure.viewDiary', compact('diary'));

                break;

            case 3:
                $letter = Letter::where('id', $task->letter_id)->first();
                return view('presdure.viewLetter', compact('letter'));
                break;

            case 4:
                $petition = Petition::where('id', $task->petition_id)->first();
                return view('presdure.viewPetition', compact('petition'));

                break;

            case 5:
                $session = Session::where('id', $task->session_id)->first();
                $users=User::all();
                return view('presdure.viewSession', compact('session','users'));
                break;

            case 7:
                $transfer = User::where('id', $task->transfer_case_id)->first();
                $prosed=Case_members_task::where('id', $id)->first();
                $users=User::all();

                return view('presdure.viewTransfer', compact('transfer','prosed','users'));

                break;

            default:
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Case_members_task::where('id', $id)->first();
        switch ($task->task_type_id) {
            case 1:
                $regulation = Interceptions_regulation::where('id', $task->regulation_id)->first();
                return view('presdure.editRegulation', compact('regulation'));
                break;

            case 2:
                $diary = Diary::where('id', $task->diary_id)->first();
                return view('presdure.editDiary', compact('diary'));

                break;

            case 3:
                $letter = Letter::where('id', $task->letter_id)->first();
                return view('presdure.editLetter', compact('letter'));
                break;

            case 4:
                $petition = Petition::where('id', $task->petition_id)->first();
                return view('presdure.editPetition', compact('petition'));

                break;

            case 5:
                $session = Session::where('id', $task->session_id)->first();
                $users=User::all();
                return view('presdure.editSession', compact('session','users'));
                break;

            case 7:
                $transfer = User::where('id', $task->transfer_case_id)->first();
                $prosed=Case_members_task::where('id', $id)->first();
                $users=User::all();

                return view('presdure.editTransfer', compact('transfer','prosed','users'));

                break;

            default:
            return redirect()->back();
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Case_members_task::where('id', $id)->first();
        // Delete File ..

        try {


            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

        }
    }

    public function createReferral($id){
        $case = Cases::where('id', $id)->first();
        $courts = Court::all();
        $branches = Branch::all();
        $caseTypes = Case_type::all();
        $clients = Person::where('preson_type', 0)->get();
        $oppenonts = Person::where('preson_type', 1)->get();
        $nationalities = Nationality::all();
        $cities = City::all();
        $client = new Person();
        $opponent = new Person();
        //team member
        $members = Case_members::where('case_id', $id)->get();
        $users = User::all();
        $membersIds = Case_members::where('case_id', $id)->pluck('member_id');
        $memTeam = User::whereNotIn('id', $membersIds)->get();
        // regulation
        $regulations = Interceptions_regulation::where('case_id', $id)->get();
        //letters
        $letters = Letter::where('case_id', $id)->get();
        //diaries
        $diaries = Diary::where('case_id', $id)->get();
        //petition
        $petitions = Petition::where('case_id', $id)->get();
        //sessions
        $sessions = Session::where('case_id', $id)->get();
        //attach
        $attachments = Attachment::where('case_id', $id)->get();
        //fees
        $fees = Fees_installment::where('case_id', $id)->get();
//presdure
        $presdures = Case_members_task::where('case_id', $id)->get();
        return view('presdure.addTransfer', compact('case', 'opponent', 'client', 'courts', 'branches', 'caseTypes', 'clients', 'oppenonts', 'nationalities', 'cities'
            , 'members', 'users', 'memTeam',
            'regulations', 'letters', 'diaries', 'petitions', 'sessions', 'attachments', 'fees', 'presdures'));
    }
    public function memberReferral(Request $request){
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            //save case member totaly=1 ,partly =2
            $input = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'incharge_type' => 1,
                'incharge_date' => Carbon::parse($request->get('incharge_date')),
                'active' => 1,
                'referral' => $request->get('referral'),
                'reason' => $request->get('reason'),
                'controlled_by' => Auth::user()->id,

            ];
            Case_members::create($input);

  //save in case tasks
  $type = task_type::where('id', 7)->first();
  $tasks = [
      'case_id' => $request->get('case_id'),
      'transfer_case_id' => $request->get('member_id'),
      'task_description' => $type->type,
      'task_type_id' => 7,
      'task_date' => Carbon::parse($request->get('incharge_date')),
      'task_status_id' => 1,
    //   'end_date' => Carbon::parse($request->get('start_date')),
      'control_by_id' => Auth::user()->id,
  ];

  Case_members_task::create($tasks);
  //new update in 1-8-2022

  Cases::findOrFail($request->get('case_id'))->update(['current_resposible_id'=>$request->get('member_id')]);
$type=task_type::where('id',7)->first();
  $user = User::where('id',$request->get('member_id'))->first();
$from=Auth::user();
  $details = [

      'name' =>  $from->name,

      'reson'=> $type->type,
  ];
//   $details = [

//     'product_name' => $product->ar_name,
//     'ar_comment' => $request->comment,
// ];
  Notification::send($user, new MyFirstNotification($details));



            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');


            return redirect()->back()->with('flash_success', "تم الحفظ بنجاح");

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }


    public function done(Request $request)
    {

        $task = Case_members_task::where('id',$request->get('case_task'))->first();

        $tasks = [

            'task_status_id' => 1,
        ];
        if ($task) {
            $task->update($tasks);
        }
        return redirect()->back()->with('flash_success', "تم الحفظ بنجاح");
    }


}
