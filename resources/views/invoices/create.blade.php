@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')



    {{-- {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!} --}}
    {!! Form::open(array('route' => 'invoices.store', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-1">
        <strong>Caregivers</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="caregiver_id" class="form-control custom-select-width">
                    @foreach ($caregivers as $caregiver)
                        <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-1">
        <strong>Customers</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="customer_id" class="form-control custom-select-width">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
            <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                                <strong>Care Type</strong>
                                {!! Form::select('care_type', $homecaretypes, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                            <strong>Products</strong>
                            {!! Form::select('product', $products, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                <strong>Date From</strong>
                {!! Form::date('date_from', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                <strong>Date To</strong>
                {!! Form::date('date_to', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
            </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary" id="submit">Confirm Appointment</button>
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
