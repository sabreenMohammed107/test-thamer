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
use App\Models\User;
use App\Models\Users_branch;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $object;
    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;
    public function __construct(Cases $object)
    {
        $this->middleware('permission:cases-list|cases-create|cases-edit|cases-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:cases-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cases-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cases-delete', ['only' => ['destroy']]);

        $this->object = $object;
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

        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $data = Cases::orderBy('id', 'DESC')->paginate(200);

        } else {
            $data = Cases::where('current_resposible_id', $user->id)->orderBy('id', 'DESC')->paginate(200);

        }

        $branches = $user->branches->all();
        session()->forget('case_id');
        return view($this->viewName . 'index', compact('data', 'branches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $courts = Court::all();
        $branches = Branch::all();
        $caseTypes = Case_type::all();
        $clients = Person::where('preson_type', 0)->get();
        $oppenonts = Person::where('preson_type', 1)->get();
        $nationalities = Nationality::all();
        $cities = City::all();
        $client = new Person();
        $opponent = new Person();
        return view($this->viewName . 'create', compact('opponent', 'client', 'courts', 'branches', 'caseTypes', 'clients', 'oppenonts', 'nationalities', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'current_resposible_id' => 'required',
            'branch_id' => 'required',

        ], [

            'name.required' => 'حقل الاسم مطلوب',
            'current_resposible_id.required' => 'حقل الزميل مطلوب',
            'branch_id.required' => 'حقل الفرع مطلوب',

        ]);

        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'start_date']);
            $input['start_date'] = Carbon::parse($request->get('start_date'));
            $case = $this->object::create($input);
            $case_id = $case->id;
            \Session::put('case_id', $case_id);

            //save case member totaly=1 ,partly =2
            if ($request->get('current_resposible_id')) {
                $data = [
                    'case_id' => $case_id,
                    'member_id' => $request->get('current_resposible_id'),
                    'incharge_type' => 1,
                    'incharge_date' => Carbon::parse($request->get('start_date')),
                    'active' => 1,
                    'controlled_by' => Auth::user()->id,
                ];
                Case_members::create($data);
            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'edit', $case->id)->with('flash_success', $this->message);
            // return redirect()->back()->with(['flash_success'=> $this->message,'case_id'=>$case->id]);

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

        // $member_regulation=Interceptions_regulation::where([['general_account','=',$request->get('general_account')],['help_account','=',$request->get('help_account')]]);
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
        return view($this->viewName . 'show', compact('case', 'opponent', 'client', 'courts', 'branches', 'caseTypes', 'clients', 'oppenonts', 'nationalities', 'cities'
            , 'members', 'users',
            'regulations', 'letters', 'diaries', 'petitions', 'sessions', 'attachments', 'fees', 'presdures'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Cases::where('id', $id)->first();
        $courts = Court::all();
        $branches = Branch::all();
        $caseTypes = Case_type::all();
        $clients = Person::where('preson_type', 0)->get();
        $oppenonts = Person::where('preson_type', 1)->get();
        $nationalities = Nationality::all();
        $cities = City::all();
        $client = new Person();
        $opponent = new Person();
        return view($this->viewName . 'edit', compact('row', 'opponent', 'client', 'courts', 'branches', 'caseTypes', 'clients', 'oppenonts', 'nationalities', 'cities'));

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
        $this->validate($request, [

            'name' => 'required',
            'current_resposible_id' => 'required',
            'branch_id' => 'required',

        ], [

            'name.required' => 'حقل الاسم مطلوب',
            'current_resposible_id.required' => 'حقل الزميل مطلوب',
            'branch_id.required' => 'حقل الفرع مطلوب',

        ]);

        // DB::beginTransaction();
        // try
        // {
        //     // Disable foreign key checks!
        //     DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'start_date']);
            if (!empty($request->get('start_date'))) {
                $input['start_date'] = Carbon::parse($request->get('start_date'));
            }

            $this->object::findOrFail($id)->update($input);

            \Session::put('case_id', $id);

            //save case member totaly=1 ,partly =2
            if ($request->get('current_resposible_id')) {
                $caseMember = Case_members::where('case_id', $id)->first();
                $data = [

                    'member_id' => $request->get('current_resposible_id'),
                    'incharge_type' => 1,
                    'active' => 1,
                    'controlled_by' => Auth::user()->id,
                ];
                if (!empty($request->get('start_date'))) {
                    $data['incharge_date'] = Carbon::parse($request->get('start_date'));
                }
                $caseMember->update($data);
            }
            // DB::commit();
            // // Enable foreign key checks!
            // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'edit', $id)->with('flash_success', $this->message);
            // return redirect()->back()->with(['flash_success'=> $this->message,'case_id'=>$case->id]);

        // } catch (\Throwable $e) {
        //     // throw $th;
        //     DB::rollback();
        //     // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

        //     return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Cases::where('id', $id)->first();
        // Delete File ..

        try {
            $members = Case_members::where('case_id', $id)->get();

            if ($members) {
                foreach ($members as $member) {
                    $member->delete();
                }
            }

            $row->member()->delete();
            $row->delete();
            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }
    }

    /**
     * dependace Users
     */
    public function fetchUsers(Request $request)
    {
        $admin = User::where('id', 1)->first();
        $users = Users_branch::orderBy('id', 'DESC');

        if (!empty($request->get('value'))) {
            $users->where('branch_id', '=', $request->get('value'));
        }

        $data = $users->get();

        $output = '<option value="">إختر الزميل</option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->user->id . '">' . $row->user->name . '</option>';
        }

        echo $output;
    }

    public function search(Request $request)
    {

        $user = Auth::user();
        $cases = Cases::orderBy('id', 'DESC');
        if (empty($request->get("all"))) {
            if (!empty($request->get("user")) && !empty($request->get("branch"))) {
                if (!empty($request->get("user"))) {
                    $cases->where('current_resposible_id', '=', $request->get("user"));
                }
                if (!empty($request->get("branch"))) {
                    $cases->where('branch_id', '=', $request->get("branch"));
                }
            } else {
                $cases->where('current_resposible_id', '=', $user->id);
            }

        }
        $data = $cases->paginate(200);
        return view($this->viewName . 'preIndex', compact('data'))->render();
    }
    public function saveClient(Request $request)
    {
        $this->validate($request, [
            'identity_no' => 'required',
            'name' => 'required',
        ], [
            'name.required' => 'حقل الاسم مطلوب',

            'identity_no.required' => 'حقل رقم الهوية مطلوب',
        ]);

        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $input = $request->except(['_token' . 'birth_date', 'case_id']);
            $input['preson_type'] = 0;
            $input['birth_date'] = Carbon::parse($request->get('birth_date'));
            $oppontonent = Person::create($input);
// dd($request->get('case_id'));
            $case = Cases::where('id', $request->get('case_id'))->first();

            if ($case) {
                $case->client_id = $oppontonent->id;
                $case->update();
            }

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->back()->with('flash_success', $this->message);

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }

    public function saveOppontent(Request $request)
    {
        $this->validate($request, [
            'identity_no' => 'required',
            'name' => 'required',
        ], [
            'name.required' => 'حقل الاسم مطلوب',

            'identity_no.required' => 'حقل رقم الهوية مطلوب',
        ]);
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $input = $request->except(['_token' . 'birth_date', 'case_id']);
            $input['preson_type'] = 1;
            $input['birth_date'] = Carbon::parse($request->get('birth_date'));
            $oppontonent = Person::create($input);

            $case = Cases::where('id', $request->get('case_id'))->first();
            $case->opponent_id = $oppontonent->id;
            $case->update();
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->back()->with('flash_success', $this->message);

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }

    public function attachClient(Request $request)
    {
        try
        {
            $case = Cases::where('id', $request->get('case_id'))->first();
            $case->client_id = $request->get('client_id');
            $case->update();
            return redirect()->route($this->routeName . 'edit', $case->id)->with('flash_success', $this->message);

        } catch (\Exception $e) {
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }

    public function attachOppontent(Request $request)
    {
        try
        {
            $case = Cases::where('id', $request->get('case_id'))->first();
            $case->opponent_id = $request->get('opponent_id');
            $case->update();
            return redirect()->route($this->routeName . 'edit', $case->id)->with('flash_success', $this->message);

        } catch (\Exception $e) {
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }
    public function editClient(Request $request)
    {
        $client = Person::where('id', $request->get('client'))->first();
        $nationalities = Nationality::all();
        $cities = City::all();
        return view($this->viewName . 'preClient', compact('client', 'nationalities', 'cities'))->render();

    }
    public function editOpponent(Request $request)
    {
        $opponent = Person::where('id', $request->get('opponent'))->first();
        $nationalities = Nationality::all();
        $cities = City::all();
        return view($this->viewName . 'preOppon', compact('opponent', 'cities', 'nationalities'))->render();
    }

    // case members cruds
    public function archiveCase(Request $request)
    {
        $case = Cases::where('id', $request->get('case_id'))->first();
        $case->update(['case_status_id' => 2]);
        return redirect()->back()->withInput()->with('flash_success', 'تم أرشفة القضية');

    }
}
