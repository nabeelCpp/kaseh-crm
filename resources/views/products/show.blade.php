@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" value="{{ $product->name }}" readonly class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 @if($product->treatment_type === 'weekly') col-md-4 @else col-md-6 @endif">
            <div class="form-group">
                <label><strong>Treatment Type</strong></label>
                <input type="text" readonly class="form-control" value="{{ ucfirst( $product->treatment_type) }}">
            </div>
        </div>
        @if($product->treatment_type === 'weekly')
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <label><strong>No. of days per week</strong></label>
                    <input type="text" readonly class="form-control" value="{{ $product->no_of_days_per_week }}">
                </div>
            </div>
        @endif
        <div class="col-xs-12 col-sm-12 @if($product->treatment_type === 'weekly') col-md-4 @else col-md-6 @endif">
            <div class="form-group">
                <label><strong>No. of hours per day</strong></label>
                <input type="text" readonly class="form-control" value="{{ $product->no_of_hrs_per_day }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="text" value="{{ env('currency') }} {{ $product->price }}" readonly class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail" readonly>{{ $product->detail }}</textarea>
            </div>
        </div>
    </div>
@endsection
