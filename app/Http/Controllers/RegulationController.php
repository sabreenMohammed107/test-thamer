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
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class RegulationController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;
    public function __construct()
    {
        $this->middleware('permission:cases-list|cases-create|cases-edit|cases-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:cases-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cases-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cases-delete', ['only' => ['destroy']]);

        // $this->object = $object;
        $this->viewName = 'cases.';
        $this->routeName = 'cases.';
        $this->message = 'تم حفظ البيانات';
        $this->errormessage = 'راجع البيانات هناك خطأ';
    }/**
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
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $data = [

                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'facts' => $request->get('facts'),
                'defenses' => $request->get('defenses'),
                'requirements' => $request->get('requirements'),
                'text' => $request->get('text'),
                'notes' => $request->get('notes'),

            ];
            if ($request->get('regulation_date')) {
                $data['regulation_date'] = Carbon::parse($request->get('regulation_date'));
            } else {
                $data['regulation_date'] = Carbon::now();
            }
            // dd($request->get('regulation_end_date'));
            $regulation = Interceptions_regulation::create($data);

            $type = task_type::where('id', 1)->first();
            $tasks = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'regulation_id' => $regulation->id,
                'task_description' => $type->type,
                'task_type_id' => 1,
                'task_status_id' => 2,
                'control_by_id' => Auth::user()->id,
                'end_date' => Carbon::parse($request->get('regulation_end_date')),

            ];
            if ($request->get('regulation_date')) {
                $tasks['task_date'] = Carbon::parse($request->get('regulation_date'));
            } else {
                $tasks['task_date'] = Carbon::now();
            }
            Case_members_task::create($tasks);
            //save case member totaly=1 ,partly =2
            $members = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'incharge_type' => 2,
                'incharge_date' => Carbon::now(),
                'active' => 1,
                'controlled_by' => Auth::user()->id,

            ];
            Case_members::create($members);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();

            return redirect()->back()->with('flash_success', $this->message);

        } catch (\Throwable$e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        return view('presdure.addRegulation', compact('case', 'opponent', 'client', 'courts', 'branches', 'caseTypes', 'clients', 'oppenonts', 'nationalities', 'cities'
            , 'members', 'users', 'memTeam',
            'regulations', 'letters', 'diaries', 'petitions', 'sessions', 'attachments', 'fees', 'presdures'));
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
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $data = [

                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                // 'regulation_date' => $request->get('regulation_date'),
                'facts' => $request->get('facts'),
                'defenses' => $request->get('defenses'),
                'requirements' => $request->get('requirements'),
                'text' => $request->get('text'),
                'notes' => $request->get('notes'),

            ];
            if ($request->get('regulation_date')) {
                $data['regulation_date'] = Carbon::parse($request->get('regulation_date'));
            }

            // dd($request->get('regulation_end_date'));
            Interceptions_regulation::findOrFail($id)->update($data);

            $tasks = [

                'member_id' => $request->get('member_id'),

                'task_status_id' => 2,
                'control_by_id' => Auth::user()->id,
                'end_date' => Carbon::parse($request->get('regulation_end_date')),

            ];
            if ($request->get('regulation_date')) {
                $tasks['task_date'] = Carbon::parse($request->get('regulation_date'));
            }
            Case_members_task::where('regulation_id', $id)->update($tasks);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();

            return redirect()->back()->with('flash_success', $this->message);

        } catch (\Throwable$e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Interceptions_regulation::where('id', $id)->first();
        // Delete File ..

        try {
//use soft delete and edit migration

            $row->task()->delete();
            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }

    }

    public function done(Request $request)
    {

        $regulation = Interceptions_regulation::where('id', $request->get('regulation'))->first();
        $task = Case_members_task::where('regulation_id', $request->get('regulation'))->first();

        $tasks = [

            'task_status_id' => 1,
        ];
        if ($task) {
            $task->update($tasks);
        }
        return redirect()->back()->with('flash_success', $this->message);
    }

    public function report($id)
    {
        $regulation = Interceptions_regulation::where('id', $id)->first();
        $data = [
            'regulation' => $regulation,
            'Title' => 'لايحة إعتراضية',
        ];
        $title = 'لايحة إعتراضية';
        $pdf = PDF::loadView('cases.pdfRegulation', $data, [], [

        ]);

        $pdf->allow_charset_conversion = false;
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->default_font='dejavusans';

        return $pdf->stream('medium.pdf');

    }
}
