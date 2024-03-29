<?php

namespace App\Http\Controllers;
use App\Models\Caregiver;
use Illuminate\Http\Request;

class PublicCaregiver extends Controller
{
    public function CareGiver($id)
    {
        $caregiver = Caregiver::find($id);
        $title = $caregiver->first_name.' '.($caregiver->last_name ?? null);
        $logo = $caregiver->profile;
        $logo_url = asset($logo);
        $caregiver['caregiver_image'] = $logo_url;
        return view('caregivers.PublicAccess',compact('caregiver', 'title'));
    }
}
