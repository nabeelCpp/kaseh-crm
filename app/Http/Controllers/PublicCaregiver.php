<?php

namespace App\Http\Controllers;
use App\Models\Caregiver;
use Illuminate\Http\Request;

class PublicCaregiver extends Controller
{
    public function CareGiver($id)
    {
        $customer = Caregiver::find($id);
        $title = "Show Caregiver({$customer->first_name})";
        $logo = $customer->profile;
        $logo_url = asset($logo);
        $customer['caregiver_image'] = $logo_url;
        return view('caregivers.PublicAccess',compact('customer', 'title'));
    }
}
