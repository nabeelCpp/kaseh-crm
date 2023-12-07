<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
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
        $data = Customer::all();
        return view('customers.index',compact('data','title', 'dataTable'));
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
        $natureCare = [
            "" => "Select Gender",
            "TLC(Elderly Care)" => "TLC(Elderly Care)",
            "TLC(Recovery Care)" => "TLC(Recovery Care)",
            "Babbysitting" => "Babbysitting",
            "confinement" => "confinement",
            "Cancer stage 1" => "Care Stage 1",
            "Cancer stage 2" => "Care Stage 2",
            "care stage 3"  => "Care Stage 3",
            "TLC(Post_op Care)" => "TLC(Post_op Care)",
            "pilliative Care" => "pilliative Care",
            "ALzehimer/Parkinson" => "ALzehimer/Parkinson",
        ];
        return view('customers.create',compact('title', 'sex','marital','natureCare'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $userId = auth()->id();
            $input = $request->all();
            $input['user_id'] = $userId;
            Customer::create($input);
            DB::commit();
            return redirect()->route('customers.index')
                            ->with('success','Customer created successfully');

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
        $customer = Customer::find($id);
        $title = "Show Customer({$customer->first_name})";
        return view('customers.show',compact('customer', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $customer = Customer::find($id);
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
        $natureCare = [
            "" => "Select Gender",
            "TLC(Elderly Care)" => "TLC(Elderly Care)",
            "TLC(Recovery Care)" => "TLC(Recovery Care)",
            "Babbysitting" => "Babbysitting",
            "confinement" => "confinement",
            "Cancer stage 1" => "Care Stage 1",
            "Cancer stage 2" => "Care Stage 2",
            "care stage 3"  => "Care Stage 3",
            "TLC(Post_op Care)" => "TLC(Post_op Care)",
            "pilliative Care" => "pilliative Care",
            "ALzehimer/Parkinson" => "ALzehimer/Parkinson",
        ];
        $title = "Edit Customer [{$customer->first_name} {$customer->last_name}]";
        return view('customers.edit',compact('customer', 'title', 'sex','marital','natureCare'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $input = $request->all();

        $user = Customer::find($id);

        // if user image is updated
        // if ($request->hasFile('image')) {
        //     // Delete the old file
        //     if($user->image) {
        //         Storage::delete($user->image);
        //     }
        //     // Store the new file
        //     $path = $request->file('image')->store('uploads/users');


        //     // Update the file_path in the database
        //     $input['image'] = $path;
        // }

        $user->update($input);
        return redirect()->route('customers.index')
                        ->with('success','Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::find($id)->delete();
        return redirect()->route('customers.index')
                        ->with('success','Customer deleted successfully');
    }
}
