@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
            </div>
            <div class="pull-right">
                <a href="{{ route('download.order', ['order_no' => $order->order_no]) }}" class="btn btn-success"><i
                        class="fa fa-download"></i> Download Quotation</a>
                @if (!$order->caregiver_id)
                    <button class="btn btn-secondary" onclick="confirmAppointment()"><i class="fa fa-check"></i> Confirm Appointment</button>
                @endif
            </div>
        </div>
    </div>
    @include('inc.errors-alert')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Caregiver</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <input type="text" readonly
                    value="{{ $order->caregiver->first_name ?? '-' }} {{ $order->caregiver->last_name ?? null }}"
                    class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Customer</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <input type="text" readonly
                    value="{{ $order->customer->first_name }} {{ $order->customer->last_name ?? null }}"
                    class="form-control">
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
                <input type="text" readonly value="{{ date('d-m-Y', strtotime($order->start_date)) }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>End Date</strong>
                <input type="text" readonly value="{{ date('d-m-Y', strtotime($order->end_date)) }}"
                    class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Remarks</strong>
                <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control" readonly>{{ $order->remarks ?? '-' }}</textarea>
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

    {{-- scheduling --}}

    <div class="d-none" id="scheduling_div">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Scheduling <small></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Assign caregiver and schedule its duties</p>
                    {!! Form::model($order, ['method' => 'PATCH','route' => ['orders.schedule', $order->id], 'enctype' => 'multipart/form-data']) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <select name="caregiver_id" class="form-control custom-select-width" required>
                                <option value="" disabled selected>Select Caregiver</option>
                                @foreach ($caregivers as $caregiver)
                                    <option value="{{ $caregiver->id }}" {{ old('caregiver_id') == $caregiver->id ? 'selected' : '' }}>{{ $caregiver->first_name }} {{ $caregiver->last_name ?? null }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function confirmAppointment() {
            $('#scheduling_div').removeClass('d-none')
            // Get the top position of the target div
            var targetTopPosition = $("#scheduling_div").offset().top;
            // Scroll to the target div
            $("html, body").animate({
                scrollTop: targetTopPosition
            }, 1000); // Adjust the duration as needed
        }
    </script>
@endsection
