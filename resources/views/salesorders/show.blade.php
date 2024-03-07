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
            <strong>Product</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <input type="text" readonly
                    value="{{ $order->products[0]->product->name }} ({{ $order->products[0]->product->treatment_type }})"
                    class="form-control">
            </div>
        </div>
    </div>
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
                <input type="text" readonly value="{{ $order->end_date ? date('d-m-Y', strtotime($order->end_date)) : '-' }}"
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
    <div @if(!count($order->schedulings)) class="d-none" @endif id="scheduling_div">
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
                            <strong class="required">Select Caregiver</strong>
                            {{ Form::select('caregiver_id', $caregivers, null, ['class' => 'form-control custom-select-width w-50', 'placeholder' => 'Select Caregiver', 'required' => true, "onchange" => "giveCaregiverEveryWhere(this.value)"]) }}

                        </div>
                        <div class="row">
                            @if($order->products[0]->product->treatment_type === 'daily')
                                @if(count($order->schedulings))
                                    @foreach ($order->schedulings as $i => $item)
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong  class="required">Start Date <small>Day {{ $i + 1 }}</small></strong>
                                                {!! Form::date('start_date[]', $item->start_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="w-75 caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, $item->caregiver_id, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true, 'placeholder' => 'Select Caregiver']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @for ($i = 0; $i < $order->products[0]->qty; $i++)
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong  class="required">Start Date <small>Day {{ $i + 1 }}</small></strong>
                                                {!! Form::date('start_date[]', Carbon\Carbon::parse($order->start_date)->addDays($i)->format('Y-m-d'), ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="w-75 caregiver_div d-none">


                                                {{ Form::select('caregiver[]', $caregivers, null, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true, 'placeholder' => 'Select Caregiver']) }}
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            @endif
                            @if($order->products[0]->product->treatment_type === 'weekly')
                                @if(count($order->schedulings))
                                    @foreach ($order->schedulings as $i => $item)
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong class="required">Start Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('start_date[]', $item->start_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong class="required">End Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('end_date[]', $item->end_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="w-75 caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, $item->caregiver_id, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true,'placeholder' => 'Select Caregiver']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @for ($i = 0; $i < $order->products[0]->qty; $i++)
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong class="required">Start Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('start_date[]', ($i === 0? Carbon\Carbon::parse($order->start_date)->addDays($i)->format('Y-m-d') : ''), ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong class="required">End Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('end_date[]', ($i == $order->products[0]->qty - 1 ? Carbon\Carbon::parse($order->end_date)->addDays($i)->format('Y-m-d') : ''), ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="w-75 caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, null, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true,'placeholder' => 'Select Caregiver']) }}
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            @endif
                        </div>

                        <div class="form-group text-center py-5">
                            <button type="submit" class="btn btn-secondary px-5">Save</button>
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

        $(document).on('click', '.advance', function() {
            if($(this).parents('.scheduling').find('.caregiver_div').hasClass('d-none')) {
                $(this).parents('.scheduling').find('.caregiver_div').removeClass('d-none')
                $(this).text('Hide')
            }else {
                $(this).parents('.scheduling').find('.caregiver_div').addClass('d-none')
                $(this).text('Advance')
            }
        })

        function giveCaregiverEveryWhere(val) {
            $('.caregivers__').val(val)
        }
    </script>
@endsection
