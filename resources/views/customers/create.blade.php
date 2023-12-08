@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')



    {{-- {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!} --}}
    {!! Form::open(array('route' => 'customers.store', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
    {{ csrf_field() }}
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
                    {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control', 'required' => true)) !!}
                </div>
                <div class="alert ">First name is required!</div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Last Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control', 'required' => true)) !!}
                </div>
                <div class="alert ">Last name is required!</div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>DOB</strong>
                {!! Form::date('dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>ID/SNN CAREID</strong>
                {!! Form::text('snn', null, array('placeholder' => 'ID/SNN CAREID','class' => 'form-control')) !!}
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
                            <div class="form-group">
                                <strong>Sex</strong>
                                {!! Form::select('general_info_sex', $sex, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Race</strong>
                                {!! Form::text('general_info_race', null, array('placeholder' => 'Race','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>I/C</strong>
                                {!! Form::text('general_info_ic', null, array('placeholder' => 'IC','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Nationality</strong>
                                {!! Form::text('general_info_nationality', null, array('placeholder' => 'Nationality','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Passport</strong>
                                {!! Form::text('general_info_passport', null, array('placeholder' => 'Passport','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Occupation</strong>
                                {!! Form::text('general_info_occupation', null, array('placeholder' => 'Occupation','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Website</strong>
                                {!! Form::text('general_info_website', null, array('placeholder' => 'Website','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Deceased</strong><br>
                              {!! Form::checkbox('general_info_deceased', '1', false, array()) !!}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Marital Status</strong>
                                {!! Form::select('general_info_marital', $marital, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <strong>Deceased Date</strong>
                        {!! Form::date('general_info_decease_date', null, array('placeholder' => 'Deceased Date','class' => 'form-control')) !!}
                        </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Notes</strong>
                                {!! Form::textarea('general_info_notes', null, ['class' => 'form-control','style' => 'height: 100px;']) !!}
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="privateinfo" role="tabpanel" aria-labelledby="privateinfo-tab">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Caregiver Responsibilities</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_responsibilities" ></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Caregiver Requirements</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_requirements" ></textarea><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Notes</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_notes" ></textarea><br>
                        </div><br>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Raferral Code Signup</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="privateinfo_caregiver_referrel_code" ></textarea>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {!! Form::text('contact_info_address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {!! Form::text('contact_info_phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('contact_info_city', null, array('placeholder' => 'city','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('contact_info_state', null, array('placeholder' => 'State','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {!! Form::text('contact_info_zip', null, array('placeholder' => 'Zip','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('contact_info_country', null, array('placeholder' => 'country','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Mobile</strong>
                              {!! Form::text('contact_info_mobile', null, array('placeholder' => 'Mobile','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Fax</strong>
                          {!! Form::text('contact_info_fax', null, array('placeholder' => 'Fax','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {!! Form::text('contact_info_email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Latitude</strong>
                          {!! Form::text('contact_info_latitude', null, array('placeholder' => 'Latitude','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Longitude</strong>
                              {!! Form::text('contact_info_longitude', null, array('placeholder' => 'Longitude','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Date</strong>
                          {!! Form::date('contact_info_dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
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
                              {!! Form::text('emergencyfname', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {!! Form::text('emergency_phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Last Name</strong>
                              {!! Form::text('emergency_lname', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Mobile</strong>
                          {!! Form::text('emergency_mobile', null, array('placeholder' => 'Mobile','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {!! Form::text('emergency_address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>FAX</strong>
                          {!! Form::text('emergency_fax', null, array('placeholder' => 'Fax','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {!! Form::text('emergency_email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Relation</strong>
                          {!! Form::text('emergency_relation', null, array('placeholder' => 'Relation','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('emergency_city', null, array('placeholder' => 'City','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('emergency_state', null, array('placeholder' => 'State','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {!! Form::text('emergency_zip', null, array('placeholder' => 'Zip','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('emergency_country', null, array('placeholder' => 'country','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Latitude</strong>
                              {!! Form::text('emergency_geo_latitude', null, array('placeholder' => 'Latitude','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Longitude</strong>
                          {!! Form::text('emergency_longitude', null, array('placeholder' => 'Longitude','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {!! Form::date('emergency_dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <hr>
                   <h2 style="color:black">Closest Family Member Information</h2>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>First Name</strong>
                              {!! Form::text('emergency_cf_fname', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {!! Form::text('emergency_cf_phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Last Name</strong>
                              {!! Form::text('emergency_cf_lname', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Mobile</strong>
                          {!! Form::text('emergency_cf_mobile', null, array('placeholder' => 'Mobile','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {!! Form::text('emergency_cf_address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>FAX</strong>
                          {!! Form::text('emergency_cf_fax', null, array('placeholder' => 'Fax','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {!! Form::text('emergency_cf_email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Relation</strong>
                          {!! Form::text('emergency_cf_relation', null, array('placeholder' => 'Relation','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('emergency_cf_city', null, array('placeholder' => 'City','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('emergency_cf_state', null, array('placeholder' => 'State','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {!! Form::text('emergency_cf_zip', null, array('placeholder' => 'Zip','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('emergency_cf_country', null, array('placeholder' => 'country','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Latitude</strong>
                              {!! Form::text('emergency_cf_geo_latitude', null, array('placeholder' => 'Latitude','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Longitude</strong>
                          {!! Form::text('emergency_cf_longitude', null, array('placeholder' => 'Longitude','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {!! Form::date('emergency_cf_dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                   </div>


                  <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Current Medical Situation</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="care_medical_situation" ></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Medical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="care_medical_history" ></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Surgical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="care_Surgical_History" ></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                                <strong>Nature Of Care</strong>
                                {!! Form::select('care_care_nature', $natureCare, null, ['class' => 'form-control']) !!}
                            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#submit').click(function(e) {
                let requiredFields = $("[required]");
                requiredFields.each(function() {
                    if(!$(this).val()){
                        e.preventDefault();
                        $(this).parents('.form-group').addClass('bad');
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }else{
                        if($(this).parents('.form-group').hasClass('bad')){
                            $(this).parents('.form-group').removeClass('bad');
                        }
                    }
                })
            })
        })
    </script>
@endsection
