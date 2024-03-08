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
        $tranier = [
            "" => "Select",
            "yes" => "Yes",
            "no" => "No"
        ];
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
        $professionals = [
            "" => "Select Profession",
            "caregiver Nurse / psyhyo therapist" => "caregiver Nurse / psyhyo therapist",
            "speech therapist" => "speech therapist" ,
            "mid wife" => "mid wife"
        ];
        return view('caregivers.create',compact('title', 'sex','marital','professionals','tranier','status','nationality'));
    }

    public function edit(string $id) : View
    {
        $caregivers = Caregiver::find($id);
        $logo = $caregivers->profile;
        $logo_url = asset($logo);
        $caregivers['caregiver_image'] = $logo_url;
        $sex = [
            "" => "Select Gender",
            "male" => "Male",
            "female" => "Female"
        ];

        $professionals = [
            "" => "Select Profession",
            "caregiver Nurse / psyhyo therapist" => "caregiver Nurse / psyhyo therapist",
            "speech therapist" => "speech therapist" ,
            "mid wife" => "mid wife"
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
        $tranier = [
            "" => "Select",
            "yes" => "Yes",
            "no" => "No"
        ];
        $title = "Edit Customer [{$caregivers->first_name} {$caregivers->last_name}]";
        return view('caregivers.edit',compact('caregivers', 'professionals','status','title', 'sex','marital','tranier','nationality'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $image = $request->file('image')->getClientOriginalName();
        $getfileExtension = $request->file('image')->getClientOriginalExtension();
        $folderName = $request->first_name;
        $caregiver_image = $image;
        $input = $request->all();
        $user = Caregiver::find($id);
        $input['profile'] = 'storage/images/'. $folderName.'/'.$caregiver_image;
        $user->update($input);
        $image_path_one = $request->file('image')->storeAs('public/images/'. $folderName, $caregiver_image);

        return redirect()->route('caregivers.index')
                        ->with('success','Caregiver updated successfully');
    }

    public function show(string $id)
    {
        $customer = Caregiver::find($id);
        $logo = $customer->profile;
        $logo_url = asset($logo);
        $customer['caregiver_image'] = $logo_url;
        $title = "Show Caregiver({$customer->first_name})";
        return view('caregivers.show',compact('customer', 'title'));
    }

    public function store(Request $request) : RedirectResponse
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|',
        ]);
        $image = $request->file('profile')->getClientOriginalName();
        $getfileExtension = $request->file('profile')->getClientOriginalExtension();
        $folderName = $request->first_name;
        $caregiver_image = $request->first_name . '-' . 'caregiver.' . $getfileExtension;

        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['profile'] = 'storage/images/'. $folderName.'/'.$caregiver_image;
            $caregiver = Caregiver::create($input);
            if($caregiver){
            $image_path_one = $request->file('profile')->storeAs('public/images/'. $folderName, $caregiver_image);
            }
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
