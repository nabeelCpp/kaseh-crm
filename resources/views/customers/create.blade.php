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
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Image</strong>
                {!! Form::file('image', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>First Name</strong>
                {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Last Name</strong>
                {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
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
                                {!! Form::select('general_info[sex]', $sex, null, ['class' => 'form-control', 'required' => true]) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Race</strong>
                                {!! Form::text('general_info[race]', null, array('placeholder' => 'Race','class' => 'form-control', 'required' => true)) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>I/C</strong>
                                {!! Form::text('general_info[ic]', null, array('placeholder' => 'IC','class' => 'form-control', 'required' => true)) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Nationality</strong>
                                {!! Form::text('general_info[nationality]', null, array('placeholder' => 'Nationality','class' => 'form-control', 'required' => true)) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Passport</strong>
                                {!! Form::text('general_info[passport]', null, array('placeholder' => 'Passport','class' => 'form-control', 'required' => true)) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Occupation</strong>
                                {!! Form::text('general_info[occupation]', null, array('placeholder' => 'Occupation','class' => 'form-control', 'required' => true)) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Website</strong>
                                {!! Form::text('general_info[website]', null, array('placeholder' => 'Website','class' => 'form-control', 'required' => true)) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Deceased</strong><br>
                              {!! Form::checkbox('general_info[deceased]', '1', false, array()) !!}
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Marital Status</strong>
                                {!! Form::select('general_info[marital]', $marital, null, ['class' => 'form-control', 'required' => true]) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <strong>Deceased Date</strong>
                        {!! Form::date('decease_date', null, array('placeholder' => 'Deceased Date','class' => 'form-control')) !!}
                        </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Notes</strong>
                                {!! Form::textarea('notes', null, ['class' => 'form-control','style' => 'height: 100px;']) !!}
                            </div>
                        </div>
                    </div>
                    See Customers portal from source website and fill input fields accordingly.
                  </div>
                  <div class="tab-pane fade" id="privateinfo" role="tabpanel" aria-labelledby="privateinfo-tab">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Caregiver Responsibilities</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="caregiver_responsibilities" required></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Caregiver Requirements</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="caregiver_requirements" required></textarea><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Notes</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="caregiver_notes" required></textarea><br>
                        </div><br>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Raferral Code Signup</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="caregiver_referrel_code" required></textarea>
                        </div>
                    </div>
                    See Customers portal from source website and fill input fields accordingly.
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {!! Form::text('general_info[address]', null, array('placeholder' => 'Address','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {!! Form::text('general_info[phone]', null, array('placeholder' => 'Phone','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('general_info[city]', null, array('placeholder' => 'city','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('general_info[state]', null, array('placeholder' => 'State','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {!! Form::text('general_info[zip]', null, array('placeholder' => 'Zip','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('general_info[country]', null, array('placeholder' => 'country','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Mobile</strong>
                              {!! Form::text('general_info[mobile]', null, array('placeholder' => 'Mobile','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Fax</strong>
                          {!! Form::text('general_info[fax]', null, array('placeholder' => 'Fax','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {!! Form::text('general_info[email]', null, array('placeholder' => 'Email','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Latitude</strong>
                          {!! Form::text('general_info[latitude]', null, array('placeholder' => 'Latitude','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Longitude</strong>
                              {!! Form::text('general_info[longitude]', null, array('placeholder' => 'Longitude','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Date</strong>
                          {!! Form::date('dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
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
                              {!! Form::text('general_info[fname]', null, array('placeholder' => 'First Name','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {!! Form::text('general_info[phone]', null, array('placeholder' => 'Phone','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Last Name</strong>
                              {!! Form::text('general_info[lname]', null, array('placeholder' => 'Last Name','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Mobile</strong>
                          {!! Form::text('general_info[mobile]', null, array('placeholder' => 'Mobile','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {!! Form::text('general_info[address]', null, array('placeholder' => 'Address','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>FAX</strong>
                          {!! Form::text('general_info[fax]', null, array('placeholder' => 'Fax','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {!! Form::text('general_info[email]', null, array('placeholder' => 'Email','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Relation</strong>
                          {!! Form::text('general_info[relation]', null, array('placeholder' => 'Relation','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('general_info[city]', null, array('placeholder' => 'City','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('general_info[state]', null, array('placeholder' => 'State','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {!! Form::text('general_info[zip]', null, array('placeholder' => 'Zip','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('general_info[country]', null, array('placeholder' => 'country','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Latitude</strong>
                              {!! Form::text('general_info[geo_latitude]', null, array('placeholder' => 'Latitude','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Longitude</strong>
                          {!! Form::text('general_info[longitude]', null, array('placeholder' => 'Longitude','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {!! Form::date('dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <hr>
                   <h2 style="color:black">Closest Family Member Information</h2>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>First Name</strong>
                              {!! Form::text('general_info[cf_fname]', null, array('placeholder' => 'First Name','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Phone</strong>
                          {!! Form::text('general_info[cf_phone]', null, array('placeholder' => 'Phone','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Last Name</strong>
                              {!! Form::text('general_info[cf_lname]', null, array('placeholder' => 'Last Name','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Mobile</strong>
                          {!! Form::text('general_info[cf_mobile]', null, array('placeholder' => 'Mobile','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address</strong>
                              {!! Form::text('general_info[cf_address]', null, array('placeholder' => 'Address','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>FAX</strong>
                          {!! Form::text('general_info[cf_fax]', null, array('placeholder' => 'Fax','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Email</strong>
                              {!! Form::text('general_info[cf_email]', null, array('placeholder' => 'Email','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Relation</strong>
                          {!! Form::text('general_info[cf_relation]', null, array('placeholder' => 'Relation','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('general_info[cf_city]', null, array('placeholder' => 'City','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('general_info[cf_state]', null, array('placeholder' => 'State','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Zip</strong>
                              {!! Form::text('general_info[cf_zip]', null, array('placeholder' => 'Zip','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('general_info[cf_country]', null, array('placeholder' => 'country','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Latitude</strong>
                              {!! Form::text('general_info[cf_geo_latitude]', null, array('placeholder' => 'Latitude','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Geo Longitude</strong>
                          {!! Form::text('general_info[cf_longitude]', null, array('placeholder' => 'Longitude','class' => 'form-control', 'required' => true)) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {!! Form::date('cf_dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                   </div>
                   
                   
                  <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Current Medical Situation</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="medical_situation" required></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Medical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="medical_history" required></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Surgical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="Surgical_History" required></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                                <strong>Nature Of Care</strong>
                                {!! Form::select('general_info[care_nature]', $natureCare, null, ['class' => 'form-control', 'required' => true]) !!}
                            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
