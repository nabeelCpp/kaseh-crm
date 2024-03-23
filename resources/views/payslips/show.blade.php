@extends('layouts.app')
@section('css')
    <style>
        .invoice-title h2,
        .invoice-title h3 {
            display: inline-block;
        }

        .table>tbody>tr>.no-line {
            border-top: none;
        }

        .table>thead>tr>.no-line {
            border-bottom: none;
        }

        .table>tbody>tr>.thick-line {
            border-top: 2px solid;
        }
    </style>
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('payslips.index') }}"> Back</a>
                <a class="btn btn-info" href="#"> Print</a>
            </div>
            <div class="pull-right">
                @if($data->status === 'pending')
                    {!! Form::model($data, ['method' => 'PATCH','route' => ['payslips.update', $data->id]]) !!}
                        {{ csrf_field() }}
                        {!! Form::hidden('status', 'paid') !!}
                        <button type="submit" class="btn btn-danger"> Mark As Pay</button>
                    {!! Form::close() !!}
                @else
                    <span class="badge badge-success">Paid</span>
                @endif
            </div>
        </div>
    </div>
    @include('inc.errors-alert')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <h2>Invoice: <strong>{{ $data->invoice_no }}</strong></h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                            <strong>Billed To: </strong>
                            {{$data->caregiver->first_name}} {{ $data->caregiver->last_name ?? null }}<br>
                            {{ $data->email }}<br>
                            {{$data->mobile}}
                        </address>
                    </div>
                    {{-- <div class="col-xs-6 text-right">
                        <address>
                            <strong>Shipped To:</strong><br>
                            Jane Smith<br>
                            1234 Main<br>
                            Apt. 4B<br>
                            Springfield, ST 54321
                        </address>
                    </div> --}}
                </div>
                <div class="row">
                    {{-- <div class="col-xs-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            Visa ending **** 4242<br>
                            jsmith@email.com
                        </address>
                    </div> --}}
                    <div class="col-xs-12">
                        <address>
                            <strong>@if($data->paid_at) Invoiced @else Invoice @endif Date:</strong><br>
                            {{ $data->paid_at ? date('D d M Y', strtotime($data->paid_at)) : date('D d M Y') }}<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Work summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td><strong>Product</strong></td>
                                        <td class="text-center"><strong>Description</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-center"><strong>Unit Price</strong></td>
                                        <td class="text-center"><strong>Taxes</strong></td>
                                        <td class="text-center"><strong>Amount</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                        $tax = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($data->scheduling_days as $key => $item)
                                        @php
                                            $unit_price = 0;
                                            if($item->sales_order->products[0]->product->treatment_type === 'daily') {
                                                $unit_price = $item->sales_order->products[0]->unit_price;
                                            }else if($item->sales_order->products[0]->product->treatment_type === 'weekly') {
                                                $unit_price = $item->sales_order->products[0]->unit_price / $item->sales_order->products[0]->product->no_of_days_per_week;
                                            }else if($item->sales_order->products[0]->product->treatment_type === 'monthly') {
                                                $unit_price = $item->sales_order->products[0]->unit_price / 30;
                                            }
                                            $subtotal += $unit_price;
                                        @endphp
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->sales_order->products[0]->product->name }}</td>
                                            <td  class="text-center">{{ $item->remarks }}</td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">{{ number_format($unit_price, 2) }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ number_format($unit_price, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-center">{{ env('CURRENCY') }} {{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Tax</strong></td>
                                        <td class="no-line text-center">{{ env('CURRENCY') }} {{ number_format($tax, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="thick-line text-center"><strong>Total</strong></td>
                                        <td class="thick-line text-center">{{ env('CURRENCY') }} {{ number_format($subtotal - $tax, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
