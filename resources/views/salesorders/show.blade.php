@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('quotations.index') }}"> Back</a>
        </div>
    </div>
</div>
<div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 "> Customer</label>
                <div class="col-md-6 col-sm-6">              
                    {{$quotation->customer->first_name}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">CareGiver</label>
                <div class="col-md-6 col-sm-6">
                {{$quotation->caregiver->first_name}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 "> Product</label>
                <div class="col-md-6 col-sm-6">              
                    {{$quotation->product->name}}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Sales Person</label>
                <div class="col-md-6 col-sm-6"> 
                {{$quotation->sales_person}}      
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Date</label>
                <div class="col-md-6 col-sm-6">              
                {{$quotation->date}}    
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Reference Description</label>
                <div class="col-md-6 col-sm-6"> 
                {{$quotation->refrence_description}} 
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Service From</label>
                <div class="col-md-6 col-sm-6">              
                {{$quotation->sub_quotations[0]->service_from}}   
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="field item form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Service To</label>
                <div class="col-md-6 col-sm-6">              
                {{$quotation->sub_quotations[0]->service_to}}   
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Description</label>
                <div class="col-md-6 col-sm-6"> 
                {{$quotation->sub_quotations[0]->description}} 
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Quantity</label>
                <div class="col-md-6 col-sm-6"> 
                {{$quotation->sub_quotations[0]->quantity}} 
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="col-form-label col-md-2 col-sm-2 ">Price</label>
                <div class="col-md-6 col-sm-6"> 
                {{$quotation->sub_quotations[0]->price}} 
                </div>
            </div>
        </div>


@endsection
