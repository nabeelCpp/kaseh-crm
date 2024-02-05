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

{!! Form::model($invoices, ['method' => 'PATCH','route' => ['invoices.update', $invoices->id], 'enctype' => 'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_content">
                <div class="tab-pane fade show active" id="generalinfo" role="tabpanel" aria-labelledby="generalinfo-tab">

                    <div class="form-group">
                        <strong>Care Type</strong>
                        {!! Form::text('care_type', null, array('placeholder' => 'Care Type', 'class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <strong>Products</strong><br>
                        <select name="product" id="product" class="form-control">
                            @foreach($products as $option)
                            <option value="{{ $option->id }}" {{ ($option->id == $invoices->product) ? 'selected' : '' }}>
                                {{ $option->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Caregivers</strong>
                        <select name="caregiver_id" id="caregiver_id" class="form-control">
                            @foreach($caregivers as $option)
                            <option value="{{ $option->id }}" {{ ($option->id == $invoices->caregiver_id) ? 'selected' : '' }}>
                                {{ $option->first_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Customers</strong>
                        <select name="customer_id" id="customer_id" class="form-control">
                            @foreach($customers as $option)
                            <option value="{{ $option->id }}" {{ ($option->id == $invoices->customer_id) ? 'selected' : '' }}>
                                {{ $option->first_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Date To</strong>
                            {!! Form::date('date_to', null, array('placeholder' => 'Date To', 'class' => 'form-control')) !!}
                        </div>
                        <div class="col-md-6">
                            <strong>Date From</strong>
                            {!! Form::date('date_from', null, array('placeholder' => 'Date From', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center mt-3">
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
                if (!$(this).val()) {
                    e.preventDefault();
                    $(this).parents('.form-group').addClass('bad');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else {
                    if ($(this).parents('.form-group').hasClass('bad')) {
                        $(this).parents('.form-group').removeClass('bad');
                    }
                }
            })
        })
    })
</script>
@endsection
