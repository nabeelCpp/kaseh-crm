@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
        </div>
    </div>
</div>
<div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Image</strong>
                {!! Form::file('image', null, array('class' => 'form-control')) !!}
            </div>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">First Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">              
                    {{$customer->first_name}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Last Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                {{$customer->last_name}}
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>DOB</strong>
                @if($customer->dob) <br><small class="text-muted">{{ $customer->dob ? date('d-M-Y', strtotime($customer->dob)) : '-' }}</small> @endif            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>ID/SNN CAREID</strong>
                {{ $customer->snn }}</div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="generalinfo-tab" data-toggle="tab" href="#generalinfo" role="tab" aria-controls="home" aria-selected="true">General Information</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="privateinfo-tab" data-toggle="tab" href="#privateinfo" role="tab" aria-controls="profile" aria-selected="false">Private Information</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="emergency-tab" data-toggle="tab" href="#emergency" role="tab" aria-controls="emergency" aria-selected="false">Emergency</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="care-tab" data-toggle="tab" href="#care" role="tab" aria-controls="care" aria-selected="false">Care Assessment</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="generalinfo" role="tabpanel" aria-labelledby="generalinfo-tab">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group col-md-6 col-sm-6">
                                <strong>Sex</strong>
                               {{ $customer->general_info_sex }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Race</strong>
                                {{ $customer->general_info_race }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>I/C</strong>
                                {{ $customer->general_info_ic}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Nationality</strong>
                                {{ $customer->general_info_nationality}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Passport</strong>
                                {{$customer->general_info_passport}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Occupation</strong>
                                {{$customer->general_info_occupation}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Website</strong>
                                {{$customer->general_info_website}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Deceased</strong>
                              {{$customer->general_info_website}}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Marital Status</strong>
                                {{$customer->general_info_marital}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <strong>Deceased Date</strong>
                        {{$customer->general_info_decease_date}}
                        </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Notes</strong>
                                {{$customer->general_info_notes}}
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="privateinfo" role="tabpanel" aria-labelledby="privateinfo-tab">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Caregiver Responsibilities</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_responsibilities" >{{$customer->privateinfo_caregiver_responsibilities}}</textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Caregiver Requirements</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_requirements" >{{$customer->privateinfo_caregiver_requirements}}</textarea><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Notes</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_notes" >{{$customer->privateinfo_caregiver_notes}}</textarea><br>
                        </div><br>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Raferral Code Signup</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_referrel_code" >{{$customer->privateinfo_caregiver_referrel_code}}</textarea>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {{$customer->contact_info_address}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {{$customer->contact_info_phone}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {{$customer->contact_info_city}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {{$customer->contact_info_state}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {{$customer->contact_info_zip}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {{$customer->contact_info_country}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Mobile</strong>
                              {{$customer->contact_info_mobile}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Fax</strong>
                          {{$customer->contact_info_fax}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {{$customer->contact_info_email}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Latitude</strong>
                          {{$customer->contact_info_latitude}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Longitude</strong>
                              {{$customer->contact_info_longitude}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Date</strong>
                          {{$customer->contact_info_dob}}
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="emergency" role="tabpanel" aria-labelledby="emergency-tab">
                   <h2 style="color:black">Emergency Contact Information</h2>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>First Name</strong>
                              {{$customer->emergencyfname}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {{$customer->emergency_phone}}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Last Name</strong>
                              {{$customer->emergency_lname}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Mobile</strong>
                          {{$customer->emergency_mobile}}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {{$customer->emergency_address}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>FAX</strong>
                          {{$customer->emergency_fax}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {{$customer->emergency_email}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Relation</strong>
                          {{$customer->emergency_relation}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {{$customer->emergency_city}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {{$customer->	emergency_state}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {{$customer->emergency_zip}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {{$customer->emergency_country}}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Latitude</strong>
                              {{$customer->emergency_geo_latitude}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Longitude</strong>
                          {{$customer->emergency_longitude}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {{$customer->emergency_dob}}
                          </div>
                        </div>
                    </div>
                    <hr>
                   <h2 style="color:black">Closest Family Member Information</h2>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>First Name</strong>
                              {{$customer->emergency_cf_fname}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {{$customer->emergency_cf_phone}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Last Name</strong>
                              {{$customer->emergency_cf_lname}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Mobile</strong>
                          {{$customer->emergency_cf_mobile}}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {{$customer->emergency_cf_address}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>FAX</strong>
                          {{$customer->emergency_cf_fax}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {{$customer->emergency_cf_email}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Relation</strong>
                          {{$customer->emergency_cf_relation}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {{$customer->emergency_cf_city}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {{$customer->emergency_cf_state}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {{$customer->emergency_cf_zip}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {{$customer->emergency_cf_country}}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Latitude</strong>
                              {{$customer->emergency_cf_geo_latitude}}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Longitude</strong>
                          {{$customer->emergency_cf_longitude}}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {{$customer->emergency_cf_dob}}
                          </div>
                        </div>
                    </div>
                   </div>


                  <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Current Medical Situation</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="care_medical_situation" >{{$customer->care_medical_situation}}</textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Medical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="care_medical_history" >{{$customer->care_medical_history}}</textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Surgical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="care_Surgical_History" >{{$customer->care_Surgical_History}}</textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                                <strong>Nature Of Care</strong>
                                {{$customer->care_care_nature}}
                            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </div> -->
    </div>

<!-- <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>First Name:</strong>
            {{ $customer->first_name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Last Name:</strong>
            {{ $customer->last_name }}
        </div>
    </div>
</div> -->
@endsection
