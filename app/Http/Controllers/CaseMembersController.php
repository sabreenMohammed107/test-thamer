<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CasesController;
use App\Models\Cases;
use App\Models\Case_members;
use App\Models\Case_members_task;
use App\Models\Diary;
use App\Models\Interceptions_regulation;
use App\Models\Letter;
use App\Models\Petition;
use App\Models\task_type;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CaseMembersController extends Controller
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $case = Cases::where('id', 19)->first();
        return (new CasesController($case))->show(19);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

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
            //save case member totaly=1 ,partly =2
            $input = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'incharge_type' => 2,
                'incharge_date' => Carbon::parse($request->get('incharge_date')),
                'active' => 1,
                'controlled_by' => Auth::user()->id,

            ];
            Case_members::create($input);

            if ($request->has('regulations')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'regulation_date' => Carbon::now(),

                ];
                // dd($request->get('regulation_end_date'));
                $regulation=Interceptions_regulation::create($data);
                $type = task_type::where('id', 1)->first();
            $tasks = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'regulation_id' => $regulation->id,
                'task_description' => $type->type,
                'task_type_id' => 1,
                'task_status_id' => 1,
                'control_by_id' => Auth::user()->id,
                'end_date' => Carbon::parse($request->get('regulation_end_date')),

            ];

               $tasks['task_date'] = Carbon::now();

            Case_members_task::create($tasks);
        }
            // Diary

            if ($request->has('diary')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'diary_date' => Carbon::now(),

                ];
                $diary=Diary::create($data);
            $type = task_type::where('id', 2)->first();
            $tasks = [
                'case_id' => $request->get('case_id'),
                'member_id' => $request->get('member_id'),
                'diary_id' => $diary->id,
                'task_description' => $type->type,
                'task_type_id' => 2,
                'task_status_id' => 1,
                'control_by_id' => Auth::user()->id,
                'end_date' => Carbon::parse($request->get('diary_end_date')),

            ];

                $tasks['task_date'] = Carbon::now();

            Case_members_task::create($tasks);

            }
            if ($request->has('letter')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'letter_date' => Carbon::now(),

                ];
                $letter= Letter::create($data);
                //member task
                $type = task_type::where('id', 3)->first();
                $tasks = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'letter_id' => $letter->id,
                    'task_description' => $type->type,
                    'task_type_id' => 3,
                    'task_status_id' => 1,
                    'control_by_id' => Auth::user()->id,
                    'end_date' => Carbon::parse($request->get('letter_end_date')),

                ];

                   $tasks['task_date'] = Carbon::now();

                Case_members_task::create($tasks);
            }
            if ($request->has('petition')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'petition_date' => Carbon::now(),

                ];
                $petition= Petition::create($data);

                $type = task_type::where('id', 4)->first();
                $tasks = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'petition_id' => $petition->id,
                    'task_description' => $type->type,
                    'task_type_id' => 4,
                    'task_status_id' => 1,
                    'control_by_id' => Auth::user()->id,
                    'end_date' => Carbon::parse($request->get('petition_end_date')),

                ];

                   $tasks['task_date'] = Carbon::now();

                Case_members_task::create($tasks);
            }

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();
            // return (new CasesController($case))->show($request->get('case_id'));
            // return redirect()->route($this->routeName . 'create')->with('flash_success', $this->message);
            return redirect()->route($this->routeName . 'show',$request->get('case_id'))->with('flash_success', $this->message);

            // return redirect()->back()->with('flash_success', $this->message);

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
            //save case member totaly=1 ,partly =2
            $input = [
                'member_id' => $request->get('member_id'),
                'incharge_type' => 1,
                // 'incharge_date' => Carbon::parse($request->get('incharge_date')),
                'active' => 1,
                'controlled_by' => Auth::user()->id,

            ];



            if(!empty($request->get('incharge_date'))){
                $input['incharge_date']=Carbon::parse($request->get('incharge_date'));
                                           }
            Case_members::findOrFail($id)->update($input);

            if ($request->has('regulations')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'regulation_date' => Carbon::now(),

                ];
                // Interceptions_regulation::create($data);

                $tasks = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'task_date' => Carbon::now(),
                    // 'end_date' => Carbon::parse($request->get('regulation_end_date')),

                ];
                if(!empty($request->get('regulation_end_date'))){
            $tasks['end_date']=Carbon::parse($request->get('regulation_end_date'));
                }
                $regulation = Interceptions_regulation::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['regulation_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($regulation) {
                    $task =Case_members_task::where('regulation_id',$regulation->id)->first();
                    $regulation->update($data);

                    $task->update($tasks);
                }else{
                    Interceptions_regulation::create($data);

                    Case_members_task::create($tasks);

                }
            }
            else {

                $regulation = Interceptions_regulation::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['regulation_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($regulation) {
                    $task =Case_members_task::where('regulation_id',$regulation->id)->first();
                    if ($task) {
                        $task->delete();
                    }
                    $regulation->delete();
                }


            }

            if ($request->has('diary')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'diary_date' => Carbon::now(),

                ];
                // Diary::create($data);
                $tasks = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'task_description' => ' مذكرة',
                    'task_type_id' => 2,
                    'task_date' => Carbon::now(),
                    'task_status_id' => 2,
                    // 'end_date' => Carbon::parse($request->get('diary_end_date')),

                ];
                if(!empty($request->get('diary_end_date'))){
                    $tasks['end_date']=Carbon::parse($request->get('diary_end_date'));
                                               }
                // Case_members_task::create($tasks);
                $diary = Diary::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['diary_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($diary) {
                    $task =Case_members_task::where('diary_id',$diary->id)->first();
                    $diary->update($data);

                    $task->update($tasks);
                }else{
                    Diary::create($data);

                    Case_members_task::create($tasks);

                }
            } else {
                $diary = Diary::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['diary_date', '=', Case_members::findOrFail($id)->created_at]])->first();


                if ($diary) {
                    $task =Case_members_task::where('diary_id',$diary->id)->first();
                    if ($task) {
                        $task->delete();
                    }
                    $diary->delete();
                }

            }
            if ($request->has('letter')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'letter_date' => Carbon::now(),

                ];

                // Letter::create($data);
                //member task
                $tasks = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'task_description' => 'خطاب ',
                    'task_type_id' => 3,
                    'task_date' => Carbon::now(),
                    'task_status_id' => 2,
                    // 'end_date' => Carbon::parse($request->get('letter_end_date')),

                ];
                if(!empty($request->get('letter_end_date'))){
                    $tasks['end_date']=Carbon::parse($request->get('letter_end_date'));
                                    }
                // Case_members_task::create($tasks);
                $letter = Letter::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['letter_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($letter) {
                    $task =Case_members_task::where('letter_id',$letter->id)->first();
                    $letter->update($data);

                    $task->update($tasks);
                }else{
                    Letter::create($data);

                    Case_members_task::create($tasks);

                }
            } else {
                $letter = Letter::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['letter_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($letter) {
                    $task =Case_members_task::where('letter_id',$letter->id)->first();
                    if ($task) {
                        $task->delete();
                    }
                    $letter->delete();
                }

            }
            if ($request->has('petition')) {
                $data = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'petition_date' => Carbon::now(),

                ];
                // Petition::create($data);
                //member task
                $tasks = [
                    'case_id' => $request->get('case_id'),
                    'member_id' => $request->get('member_id'),
                    'task_description' => ' التماس اعادة النظر',
                    'task_type_id' => 4,
                    'task_date' => Carbon::now(),
                    'task_status_id' => 2,
                    // 'end_date' => Carbon::parse($request->get('petition_end_date')),

                ];
                if(!empty($request->get('petition_end_date'))){
                    $tasks['end_date']=Carbon::parse($request->get('petition_end_date'));
                                                }
                // Case_members_task::create($tasks);
                $petition = Petition::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['petition_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($petition) {
                    $task =Case_members_task::where('petition_id',$petition->id)->first();
                    $petition->update($data);

                    $task->update($tasks);
                }else{
                    Petition::create($data);

                    Case_members_task::create($tasks);

                }
            } else {
                $petition = Petition::where([['case_id', '=', $request->get('case_id')], ['member_id', '=', $request->get('member_id')], ['petition_date', '=', Case_members::findOrFail($id)->created_at]])->first();
                if ($petition) {
                    $task =Case_members_task::where('petition_id',$petition->id)->first();
                    if ($task) {
                        $task->delete();
                    }
                    $petition->delete();
                }

            }

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();
            // return (new CasesController($case))->show($request->get('case_id'));
            // return redirect()->route($this->routeName . 'create')->with('flash_success', $this->message);
            return redirect()->route($this->routeName . 'show',$request->get('case_id'))->with('flash_success', $this->message);

            // return redirect()->back()->with('flash_success', $this->message);

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

        $row = Case_members::where('id', $id)->first();
        // Delete File ..

        try {
//use soft delete and edit migration

            $row->diary()->delete();
            $row->regulation()->delete();
            $row->letter()->delete();
            $row->petition()->delete();
            $row->task()->delete();
            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }

    }
}
