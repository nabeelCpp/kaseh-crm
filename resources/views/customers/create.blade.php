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
                    Contact info here
                  </div>
                  <div class="tab-pane fade" id="emergency" role="tabpanel" aria-labelledby="emergency-tab">
                    Emergency here
                  </div>
                  <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
                    Care Assessment here
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
