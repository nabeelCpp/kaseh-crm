@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
        <strong>Caregiver</strong>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="text" readonly value="{{ $order->caregiver->first_name ?? '-'  }} {{ $order->caregiver->last_name ?? null  }}" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
        <strong>Customer</strong>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="text" readonly value="{{ $order->customer->first_name  }} {{ $order->customer->last_name ?? null  }}" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
        <strong>Sales Person</strong>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="text" class="form-control" id="sales_person" name="sales_person"
                value="{{ $order->user->name }}" readonly>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Start Date</strong>
            <input type="text" readonly value="{{ date('d-m-Y', strtotime($order->start_date)) }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>End Date</strong>
            <input type="text" readonly value="{{ date('d-m-Y', strtotime($order->end_date)) }}" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Remarks</strong>
            <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control" readonly>{{  $order->remarks ?? '-' }}</textarea>
        </div>
    </div>
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->products as $p)
            <tr>
                <th>{{ $p->product->name }}</th>
                <td>{{ $p->qty }}</td>
                <td>{{ $p->unit_price }}</td>
                <td>{{ $p->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
