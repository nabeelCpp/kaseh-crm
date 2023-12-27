@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('caregivers.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')
    {!! Form::model($invoices, ['method' => 'PATCH','route' => ['invoices.update', $invoices->id], 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_content">
                  <div class="tab-pane fade show active" id="generalinfo" role="tabpanel" aria-labelledby="generalinfo-tab">
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Care Type</strong>
                          {!! Form::text('care_type', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                        </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                          <div class="form-group">
                          <strong>Product</strong>
                          {!! Form::text('product', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                          </div>
                    </div>
                 </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <strong>Date To</strong>
                    {!! Form::date('date_to', null, array('placeholder' => 'Availability Date','class' => 'form-control')) !!}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <strong>Date From</strong>
                    {!! Form::date('date_from', null, array('placeholder' => 'Availability Date','class' => 'form-control')) !!}
                </div>
            </div>
 
          </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
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
