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

    {!! Form::model($customer, ['method' => 'PATCH','route' => ['customers.update', $customer->id], 'enctype' => 'multipart/form-data']) !!}
      <div class="row">
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
                <strong>Age</strong>
                {!! Form::number('age', null, array('placeholder' => 'Age','class' => 'form-control', 'required' => true)) !!}
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
                                {!! Form::select('general_info_race', $races, null, ['class' => 'form-control']) !!}
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
                                <strong>Nationality</strong>
                                {!! Form::text('general_info_nationality', null, array('placeholder' => 'Nationality','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Occupation</strong>
                                {!! Form::text('general_info_occupation', null, array('placeholder' => 'Occupation','class' => 'form-control')) !!}
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
                              <strong>Email</strong>
                              {!! Form::text('contact_info_email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
</div>
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
                 
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Current Medical Situation</label>
                        <div class="col-md-9 col-sm-9 ">
                            {!! Form::textarea('care_medical_situation', null, ['class' => 'resizable_textarea form-control']) !!}<br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Medical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            {!! Form::textarea('care_medical_history', null, ['class' => 'resizable_textarea form-control']) !!}<br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Surgical History</label>
                        <div class="col-md-9 col-sm-9 ">
                            {!! Form::textarea('care_Surgical_History', null, ['class' => 'resizable_textarea form-control']) !!}<br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                                <strong>Nature Of Care</strong>
                                {!! Form::select('care_care_nature', $natureCare, null, ['class' => 'form-control']) !!}
                            </div>
                  </div>
 
          </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success" id="submit">Update</button>
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
