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
    {!! Form::open(array('route' => 'caregivers.store', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
    {{ csrf_field() }}
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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Nick Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::text('nick_name', null, array('placeholder' => 'Nick Name','class' => 'form-control', 'required' => true)) !!}
                </div>
                <div class="alert ">Nick name is required!</div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Nationality<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                {!! Form::select('nationality', $nationality, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Age</strong>
                {!! Form::number('age', null, array('placeholder' => 'Age','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>IC Number</strong>
                {!! Form::text('ic_number', null, array('placeholder' => 'IC Number','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Height</strong>
                {!! Form::text('height', null, array('placeholder' => 'Height','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Weight</strong>
                {!! Form::text('weight', null, array('placeholder' => 'Weight','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Mobile</strong>
                {!! Form::number('mobile', null, array('placeholder' => 'Mobile','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Passport</strong>
                {!! Form::text('passport', null, array('placeholder' => 'Passport','class' => 'form-control')) !!}
            </div>
        </div>



        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_content">
                  <div class="tab-pane fade show active" id="generalinfo" role="tabpanel" aria-labelledby="generalinfo-tab">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Passport Expiry Date</strong>
                         {!! Form::date('passport_expiry_date', null, array('placeholder' => 'Passport Expiry Date','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Visa</strong>
                            {!! Form::text('visa', null, array('placeholder' => 'Visa','class' => 'form-control')) !!}
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                                <strong>Visa Expiry Date</strong>
                         {!! Form::date('visa_expiry_date', null, array('placeholder' => 'Visa Expiry Date','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                                <strong>Date Of Birth</strong>
                         {!! Form::date('date_of_birth', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                           <div class="form-group">
                                <strong>Gender</strong>
                                {!! Form::select('gender', $sex, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                           <div class="form-group">
                                <strong>Are You Certified Trainer?</strong>
                                {!! Form::select('trainer', $tranier, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                                <strong>Marital Status</strong>
                                {!! Form::select('marital_status', $marital, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Email</strong>
                          {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Profession</strong>
                              {!! Form::select('profession', $professionals, null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Transportation</strong>
                          {!! Form::text('trasportation', null, array('placeholder' => 'Transportation','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Status</strong>
                              {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                    </div>
</div>
                   <h2 style="color:black">Address</h2>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Address 1</strong>
                              {!! Form::text('address_one', null, array('placeholder' => 'Address One','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Address 2</strong>
                          {!! Form::text('address_two', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>PostCode</strong>
                              {!! Form::text('postcode', null, array('placeholder' => 'PostCode','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                          <strong>Country</strong>
                          {!! Form::text('country', null, array('placeholder' => 'country','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>City</strong>
                              {!! Form::text('city', null, array('placeholder' => 'City','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>State</strong>
                          {!! Form::text('state', null, array('placeholder' => 'State','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <hr>

                    <h2 style="color:black">Bank Details</h2>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Bank Name</strong>
                              {!! Form::text('bank_name', null, array('placeholder' => 'Bank Name','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Bank Account</strong>
                          {!! Form::text('bank_account', null, array('placeholder' => 'Bank Account','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>Bank Cardholder</strong>
                              {!! Form::text('bank_cardholder', null, array('placeholder' => 'Bank Cardholder','class' => 'form-control')) !!}
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                          <strong>Xero ID</strong>
                          {!! Form::text('xero_id', null, array('placeholder' => 'Xero ID','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>

                    <h2 style="color:black">Availability</h2>
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Availability Date</strong>
                          {!! Form::date('date_of_availability', null, array('placeholder' => 'Availability Date','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                              <strong>HashTag</strong>
                              {!! Form::text('hashtag', null, array('placeholder' => 'Hashtag','class' => 'form-control')) !!}
                          </div>
                        </div>
                    </div>


                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Biography</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="internal_remarks" ></textarea><br>
                        </div><br>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 ">Internal Remarks</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="resizable_textarea form-control" name="skills" ></textarea><br>
                        </div><br>
                    </div><br>
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
