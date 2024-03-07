@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('caregivers.index') }}"> Back</a>
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
        <img src="{{ $customer->caregiver_image }}" alt="Image">
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
                <strong>Age</strong>
                {{$customer->age}}
                </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>ID/SNN CAREID</strong>
                {{ $customer->ic_number }}</div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_content">
                <!-- <div class="tab-content" id="myTabContent"> -->
                  <!-- <div class="tab-pane fade show active" id="generalinfo" role="tabpanel" aria-labelledby="generalinfo-tab"> -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group col-md-6 col-sm-6">
                                <strong>Sex</strong>
                               {{ $customer->gender }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Race</strong>
                                {{ $customer->nationality }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Passport</strong>
                                {{$customer->general_info_passport}}
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Marital Status</strong>
                                {{$customer->marital_status}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Profession</strong>
                                {{$customer->profession}}
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Notes</strong>
                                {{$customer->general_info_notes}}
                            </div>
                        </div>
                    </div> -->
                  <!-- </div> -->
                  <!-- <div class="tab-pane fade" id="privateinfo" role="tabpanel" aria-labelledby="privateinfo-tab">
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
                  </div> -->
                  <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> -->
                    <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Address 1</strong>
                                {{$customer->address_one}}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>Address 2</strong>
                            {{$customer->address_two}}
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>City</strong>
                                {{$customer->city}}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>State</strong>
                            {{$customer->state}}
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Mobile</strong>
                                {{$customer->mobile}}
                            </div>
                          </div>
                          <!-- <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>Fax</strong>
                            {{$customer->contact_info_fax}}
                            </div>
                          </div> -->
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Email</strong>
                                {{$customer->email}}
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Cardholder</strong>
                                {{$customer->bank_cardholder}}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>Xeio ID</strong>
                            {{$customer->xero_id}}
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Bank Account</strong>
                                {{$customer->bank_account}}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>Bank Name</strong>
                            {{$customer->bank_name}}
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Passport</strong>
                                {{$customer->passport}}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>Visa</strong>
                            {{$customer->visa}}
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Date Of Pasport Expiry</strong>
                                {{$customer->passport_expiry_date}}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                            <strong>Visa Expiry Date</strong>
                            {{$customer->visa_expiry_date}}
                            </div>
                          </div>
                      </div>
                      <!-- <div class="row">
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
                      </div> -->
                    </div>
                  <!-- <div class="tab-pane fade" id="emergency" role="tabpanel" aria-labelledby="emergency-tab"> -->
                   <!-- <h2 style="color:black">Emergency Contact Information</h2> -->


                    <!-- <div class="row">
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
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Geo Date</strong>
                              {{$customer->emergency_dob}}
                          </div>
                        </div>
                    </div> -->

                   <!-- <h2 style="color:black">Closest Family Member Information</h2>
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
                   </div> -->


                  <!-- <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab"> -->
                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Internal Remarks</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="skills" >{{$customer->skills}}</textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Biography</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="internal_remarks" >{{$customer->internal_remarks}}</textarea><br>
                        </div><br>
                    </div><br>
                    <br>
          </div>
    </div>
@endsection
