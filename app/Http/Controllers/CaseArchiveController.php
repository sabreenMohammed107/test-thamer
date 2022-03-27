<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Case_members;
use App\Models\Case_type;
use App\Models\Cases;
use App\Models\City;
use App\Models\Court;
use App\Models\Nationality;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseArchiveController extends Controller
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
    { $this->middleware('permission:cases-list|cases-create|cases-edit|cases-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:cases-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cases-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cases-delete', ['only' => ['destroy']]);

        $this->object = $object;
        $this->viewName = 'archive.';
        $this->routeName = 'archive.';
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
            $data = Cases::where('case_status_id','=',2)->orderBy('id', 'DESC')->paginate(200);

      // $data = Cases::where('current_resposible_id', $user->id)->orderBy('id', 'DESC')->paginate(200);



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
        $row=Cases::where('id',$id)->first();
        $member=Case_members::where('case_id',$id)->where('active',1)->first();
        $courts = Court::all();
        $branches = Branch::all();
        $caseTypes = Case_type::all();
        $clients = Person::where('preson_type', 0)->get();
        $oppenonts = Person::where('preson_type', 1)->get();
        $nationalities = Nationality::all();
        $cities = City::all();
        $client = new Person();
        $opponent = new Person();
        return view('archive.show',compact('row','member','courts','branches','caseTypes'
        ,'clients','oppenonts','nationalities','cities','client','opponent'));

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
        //
    }
}
