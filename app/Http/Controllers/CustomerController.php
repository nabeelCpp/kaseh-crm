<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
         $this->middleware('permission:customer-create', ['only' => ['create','store']]);
         $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $title = 'Customers Management';
        $dataTable = true;
        return view('customers.index',compact('title', 'dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create() : View
    // {
    //     $title = 'Create New Customer';
    //     $blood_groups = [
    //         "" => "Select Blood Group",
    //         "A+" => "A+",
    //         "A-" => "A-",
    //         "AB+" => "AB+",
    //         "AB-" => "AB-",
    //         "B+" => "B+",
    //         "B-" => "B-",
    //         "O+" => "O+",
    //         "O-" => "O-"
    //     ];

    //     $relations = [
    //         "" => "Select Relation with customer",
    //         "mother" => "Mother",
    //         "dad" => "Dad",
    //         "son" => "Son",
    //         "daughter" => "Daughter",
    //         "brother" => "Brother",
    //         "sister" => "Sister",
    //         "other" => "Other",
    //     ];

    //     foreach (auth()->user()->roles as $key => $role) {
    //         if($role->name == 'Customer'){
    //             return view('customers.create',compact('title', 'blood_groups', 'relations'));
    //         }
    //     }
    //     $role = Role::where(['name' => 'customer'])->first();
    //     $customers = [];
    //     foreach ($role->users as $key => $user) {
    //         if(count($customers) == 0) {
    //             $customers[''] = "Select Customer";
    //         }
    //         $customers[$user->id] = $user->name;
    //     }
    //     return view('customers.create',compact('title', 'customers', 'blood_groups', 'relations'));
    // }

    public function create() : View {
        $title = 'Create New Customer';
        $sex = [
            "" => "Select Gender",
            "male" => "Male",
            "female" => "Female"
        ];
        $marital = [
            "" => "Select Gender",
            "single" => "Single",
            "married" => "Married",
            "divorced" => "Divorced",
            "widow" => "Widow",
            "widower" => "Widower"

        ];
        return view('customers.create',compact('title', 'sex','marital'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request) : RedirectResponse
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'blood_group' => 'required',
    //         'disease' => 'required',
    //         'age' => 'required|integer',
    //         'user_id' => 'required',
    //         'relation' => 'required'
    //     ]);

    //     try {
    //         DB::beginTransaction();
    //         $input = $request->all();
    //         Patient::create($input);

    //         DB::commit();

    //         return redirect()->route('patients.index')
    //                         ->with('success','Patient created successfully');

    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         DB::rollBack();
    //         return redirect()->back()->withInput()->with('error', $th->getMessage());
    //     }


    // }

    public function store(Request $request) {
        // do store code here.
        dd($request);
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
