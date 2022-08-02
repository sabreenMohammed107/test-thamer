<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Contract;
use App\Models\Contract_type;
use App\Models\Nationality;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ContractController extends Controller
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
    public function __construct(Contract $object)
    {

        $this->object = $object;
        $this->viewName = 'contract.';
        $this->routeName = 'contract.';
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

        $data = Contract::orderBy('id', 'DESC')->paginate(200);

        return view($this->viewName . 'index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalities = Nationality::all();
        $cities = City::all();
        $types = Contract_type::all();
        return view($this->viewName . 'add', compact('nationalities', 'cities', 'types'));
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

            $firstSide = [
                'name' => $request->get('first_name'),
                'preson_type' => 2,
                'identity_type_id' => $request->get('first_identity_type_id'),
                'identity_no' => $request->get('first_identity_no'),
                'nationality_id' => $request->get('first_nationality_id'),
                'birth_date' => Carbon::parse($request->get('first_contract_date')),
                'city_id' => $request->get('first_city_id'),
                'mobile' => $request->get('first_mobile'),
                'phone' => $request->get('first_phone'),
                'email' => $request->get('first_email'),
                'fax' => $request->get('first_fax'),
                'job' => $request->get('first_job'),
                'address' => $request->get('first_address'),

            ];
            $firstPer = Person::create($firstSide);
            $secondSide = [
                'name' => $request->get('second_name'),
                'preson_type' => 2,
                'identity_type_id' => $request->get('second_identity_type_id'),
                'identity_no' => $request->get('second_identity_no'),
                'nationality_id' => $request->get('second_nationality_id'),
                'birth_date' => Carbon::parse($request->get('second_contract_date')),
                'city_id' => $request->get('second_city_id'),
                'mobile' => $request->get('second_mobile'),
                'phone' => $request->get('second_phone'),
                'email' => $request->get('second_email'),
                'fax' => $request->get('second_fax'),
                'job' => $request->get('second_job'),
                'address' => $request->get('second_address'),
            ];
            $secondPer = Person::create($secondSide);
            $input = [
                'contract_date' => Carbon::parse($request->get('contract_date')),
                'type_id' => $request->get('type_id'),
                'first_side_id' => $firstPer->id,
                'second_side_id' => $secondPer->id,
                'intro' => $request->get('intro'),
                'contract_items' => $request->get('contract_items'),
                'notes' => $request->get('notes'),
            ];
            if ($request->hasFile('attatchment')) {
                $attach_image = $request->file('attatchment');

                $data['attatchment'] = $this->UplaodImage($attach_image);

            }
            Contract::create($input);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', $this->message);
            // return redirect()->back()->with(['flash_success'=> $this->message,'case_id'=>$case->id]);

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
        $row = Contract::where('id', $id)->first();
        $data = [
            'row' => $row,
            'Title' => 'عقد',
        ];
        $title = 'عقد';
        $pdf = PDF::loadView('contract.print', $data);
        $pdf->allow_charset_conversion = false;
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;

        return $pdf->stream('medium.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Contract::where('id', $id)->first();
        $nationalities = Nationality::all();
        $cities = City::all();
        $types = Contract_type::all();
        return view($this->viewName . 'edit', compact('row','nationalities', 'cities', 'types'));
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
        $row = Contract::where('id', $id)->first();
        $firstObj=Person::where('id',$row->first_side_id)->first();
        $secondObj=Person::where('id',$row->second_side_id)->first();
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $firstSide = [
                'name' => $request->get('first_name'),
                'preson_type' => 2,
                'identity_type_id' => $request->get('first_identity_type_id'),
                'identity_no' => $request->get('first_identity_no'),
                'nationality_id' => $request->get('first_nationality_id'),
                'birth_date' => Carbon::parse($request->get('first_contract_date')),
                'city_id' => $request->get('first_city_id'),
                'mobile' => $request->get('first_mobile'),
                'phone' => $request->get('first_phone'),
                'email' => $request->get('first_email'),
                'fax' => $request->get('first_fax'),
                'job' => $request->get('first_job'),
                'address' => $request->get('first_address'),

            ];
            if($firstObj){
                $firstObj->update($firstSide);
            }
            $secondSide = [
                'name' => $request->get('second_name'),
                'preson_type' => 2,
                'identity_type_id' => $request->get('second_identity_type_id'),
                'identity_no' => $request->get('second_identity_no'),
                'nationality_id' => $request->get('second_nationality_id'),
                'birth_date' => Carbon::parse($request->get('second_contract_date')),
                'city_id' => $request->get('second_city_id'),
                'mobile' => $request->get('second_mobile'),
                'phone' => $request->get('second_phone'),
                'email' => $request->get('second_email'),
                'fax' => $request->get('second_fax'),
                'job' => $request->get('second_job'),
                'address' => $request->get('second_address'),
            ];
            if($secondObj){
                $secondObj->update($secondSide);
            }
            $input = [
                'contract_date' => Carbon::parse($request->get('contract_date')),
                'type_id' => $request->get('type_id'),
                // 'first_side_id' => $firstPer->id,
                // 'second_side_id' => $secondPer->id,
                'intro' => $request->get('intro'),
                'contract_items' => $request->get('contract_items'),
                'notes' => $request->get('notes'),
            ];
            if ($request->hasFile('attatchment')) {
                $attach_image = $request->file('attatchment');

                $data['attatchment'] = $this->UplaodImage($attach_image);

            }
            if($row){
                $row->update($input);
            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', $this->message);
            // return redirect()->back()->with(['flash_success'=> $this->message,'case_id'=>$case->id]);

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
        //
    }

    /* uplaud image
     */
    public function UplaodImage($file_request)
    {
        //  This is Image Info..
        $file = $file_request;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->getRealPath();
        $mime = $file->getMimeType();

        // Rename The Image ..
        $imageName = $name;
        $uploadPath = public_path('uploads/contract');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }
}
