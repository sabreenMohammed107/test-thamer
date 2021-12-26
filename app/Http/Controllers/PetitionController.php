<?php

namespace App\Http\Controllers;


use App\Models\Cases;
use App\Models\Case_members_task;
use App\Models\Petition;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetitionController extends Controller
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
    } /**
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
                'petition_date' => Carbon::parse($request->get('petition_date')),
                'text' => $request->get('text'),
                'notes' => $request->get('notes'),

            ];
            // dd($request->get('regulation_end_date'));
            Petition::create($data);
            $tasks = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'task_description' => 'التماس اعاده النظر',
                'task_type_id' => 4,
                'task_date' => Carbon::parse($request->get('petition_date')),
                'task_status_id' => 2,
                'end_date' => Carbon::parse($request->get('petition_end_date')),

            ];
            Case_members_task::create($tasks);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();
            // return (new CasesController($case))->show($request->get('case_id'));
            // return redirect()->route($this->routeName . 'create')->with('flash_success', $this->message);
            return redirect()->back()->with('flash_success', $this->message);

        } catch (\Throwable $e) {
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
        //
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
                'text' => $request->get('text'),
                'notes' => $request->get('notes'),

            ];
            if ($request->get('petition_date')) {
                $data['petition_date'] = Carbon::parse($request->get('petition_date'));
            }

            // dd($request->get('regulation_end_date'));
            Petition::findOrFail($id)->update($data);

            $tasks = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'task_description' => 'التماس اعاده النظر',
                'task_type_id' => 4,
                'task_status_id' => 2];

            $tasks['task_date'] = Carbon::parse(Petition::findOrFail($id)->petition_date);

            if (!empty($request->get('petition_end_date'))) {
                $tasks['end_date'] = Carbon::parse($request->get('petition_end_date'));
            }

            $task = Case_members_task::where([['task_type_id', 3], ['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['task_date', '=',Petition::findOrFail($id)->petition_date]])
                ->first();
            if ($task) {
                $task->update($tasks);
            } else {
                Case_members_task::create($tasks);
            }
            // $task->save($tasks);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();
            // return (new CasesController($case))->show($request->get('case_id'));
            // return redirect()->route($this->routeName . 'create')->with('flash_success', $this->message);
            return redirect()->back()->with('flash_success', $this->message);

        } catch (\Throwable $e) {
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
        $row = Petition::where('id', $id)->first();
        // Delete File ..

        try {
//use soft delete and edit migration

            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }

    }

    public function done(Request $request){

        $petition=Petition::where('id', $request->get('petition'))->first();
        $task=Case_members_task::where([['task_type_id',4],['case_id', '=', $request->case_id],['task_date','=',$petition->petition_date]])->first();
        $tasks = [

            'task_status_id' => 1
        ];
        if ($task) {
            $task->update($tasks);
        }
        return redirect()->back()->with('flash_success', $this->message);
    }
}
