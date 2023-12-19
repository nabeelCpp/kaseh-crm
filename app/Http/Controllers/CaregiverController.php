<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Caregiver;
use App\Models\Customer;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;

class CaregiverController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:caregiver-list|caregiver-create|caregiver-edit|caregiver-delete', ['only' => ['index','show']]);
         $this->middleware('permission:caregiver-create', ['only' => ['create','store']]);
         $this->middleware('permission:caregiver-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:caregiver-delete', ['only' => ['destroy']]);
    }

    public function index() : View
    {
        $title = 'Caregivers Management';
        $dataTable = true;
        $data = Caregiver::all();
        return view('caregivers.index',compact('data','title', 'dataTable'));
    }

    public function create() : View {
        $title = 'Create New Caregiver';
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
        $nationality = [
            "" => "Select Nationality",
            "indian" => "indian",
            "chinese" => "chinese",
            "Pakistani" => "Pakistani",
            "Malaysian" => "Malaysian",
            "Arabic" => "Arabic",
            "British" => "British"

        ];
        $status = [
            "" => "Select Status",
            "active" => "Active",
            "in-active" => "In-Active"
        ];
        return view('caregivers.create',compact('title', 'sex','marital','status','nationality'));
    }

    public function edit(string $id) : View
    {
        $caregivers = Caregiver::find($id);
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
        $nationality = [
            "" => "Select Nationality",
            "indian" => "indian",
            "chinese" => "chinese",
            "Pakistani" => "Pakistani",
            "Malaysian" => "Malaysian",
            "Arabic" => "Arabic",
            "British" => "British"

        ];
        $status = [
            "" => "Select Status",
            "active" => "Active",
            "in-active" => "In-Active"
        ];
        $title = "Edit Customer [{$caregivers->first_name} {$caregivers->last_name}]";
        return view('caregivers.edit',compact('caregivers', 'status','title', 'sex','marital','nationality'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $input = $request->all();

        $user = Caregiver::find($id);
        $user->update($input);
        return redirect()->route('caregivers.index')
                        ->with('success','Caregiver updated successfully');
    }

    public function show(string $id)
    {
        $customer = Caregiver::find($id);
        $title = "Show Caregiver({$customer->first_name})";
        return view('caregivers.show',compact('customer', 'title'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $input = $request->all();
            Caregiver::create($input);
            DB::commit();
            return redirect()->route('caregivers.index')
                            ->with('success','Caregivers created successfully');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Caregiver::find($id)->delete();
        return redirect()->route('caregivers.index')
                        ->with('success','Caregivers deleted successfully');
    }
}
