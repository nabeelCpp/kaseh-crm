<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;

class PatientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:patient-list|patient-create|patient-edit|patient-delete', ['only' => ['index','show']]);
         $this->middleware('permission:patient-create', ['only' => ['create','store']]);
         $this->middleware('permission:patient-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:patient-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        // foreach (auth()->user()->roles as $key => $role) {
        //     if($role->name == 'Customer'){
        //         $patients = Patient::where(['user_id' => auth()->user()->id]);
        //     }
        // }
        $patients = Patient::all();
        $title = 'Patients Management';
        $dataTable = true;
        return view('patients.index',compact('patients', 'title', 'dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $title = 'Create New Patient';
        $blood_groups = [
            "" => "Select Blood Group",
            "A+" => "A+",
            "A-" => "A-",
            "AB+" => "AB+",
            "AB-" => "AB-",
            "B+" => "B+",
            "B-" => "B-",
            "O+" => "O+",
            "O-" => "O-"
        ];

        $relations = [
            "" => "Select Relation with customer",
            "mother" => "Mother",
            "dad" => "Dad",
            "son" => "Son",
            "daughter" => "Daughter",
            "brother" => "Brother",
            "sister" => "Sister",
            "other" => "Other",
        ];

        foreach (auth()->user()->roles as $key => $role) {
            if($role->name == 'Customer'){
                return view('patients.create',compact('title', 'blood_groups', 'relations'));
            }
        }
        $role = Role::where(['name' => 'customer'])->first();
        $customers = [];
        foreach ($role->users as $key => $user) {
            if(count($customers) == 0) {
                $customers[''] = "Select Customer";
            }
            $customers[$user->id] = $user->name;
        }
        return view('patients.create',compact('title', 'customers', 'blood_groups', 'relations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'blood_group' => 'required',
            'disease' => 'required',
            'age' => 'required|integer',
            'user_id' => 'required',
            'relation' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $input = $request->all();
            Patient::create($input);

            DB::commit();

            return redirect()->route('patients.index')
                            ->with('success','Patient created successfully');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
