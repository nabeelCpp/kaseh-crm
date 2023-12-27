@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
        </div>
    </div>
</div>
<div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Product Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">              
                    {{$invoice->product}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Care Type<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                {{$invoice->care_type}}
                </div>
            </div>
        </div>
     
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Customer Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">              
                    {{$invoice->customer->first_name}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Caregiver Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">              
                    {{$invoice->caregiver->first_name}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Date From</strong>
                {{$invoice->date_from}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Date To</strong>
                {{$invoice->date_to}}
            </div>
        </div>

@endsection
