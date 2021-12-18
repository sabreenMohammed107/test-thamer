<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Fees_installment;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
class FeesController extends Controller
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
                'controlled_by' => Auth::user()->id,
                'installment_date' => Carbon::parse($request->get('installment_date')),
                'pay_amount' => $request->get('pay_amount'),
                'notes' => $request->get('notes'),

            ];
            if ($request->get('paid')) {
                $data['paid'] = 1;
            }else{
                $data['paid'] = 0;
            }
            // dd($request->get('regulation_end_date'));
            Fees_installment::create($data);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $case = Cases::where('id', $request->get('case_id'))->first();

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
                'controlled_by' => Auth::user()->id,
                'pay_amount' => $request->get('pay_amount'),
                'notes' => $request->get('notes'),

            ];
            if ($request->get('paid')) {
                $data['paid'] = 1;
            }else{
                $data['paid'] = 0;
            }

            if ($request->get('installment_date')) {
                $data['installment_date'] = Carbon::parse($request->get('installment_date'));
            }

            // dd($request->get('regulation_end_date'));
            Fees_installment::findOrFail($id)->update($data);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
        $row = Fees_installment::where('id', $id)->first();
        // Delete File ..

        try {


            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }
    }
}
