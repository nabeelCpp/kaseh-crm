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
                <textarea name="remarks" cols="30" rows="10" class="form-control" readonly>{{ $order->remarks ?? '-' }}</textarea>
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
                            @if ($order->products[0]->product->treatment_type === 'weekly' || $order->products[0]->product->treatment_type === 'monthly')
                                <br>

                                <strong class="mt-2 required">Select Days ({{ $order->products[0]->product->no_of_days_per_week }} days / week) <small>{{ $order->products[0]->product->no_of_hrs_per_day }} hours/day</small>:</strong>
                                <p class="p-5 days_container" id="main_divion_of_days" data-id="{{ $order->products[0]->product->no_of_days_per_week }}">
                                    @php
                                        $start_date = Carbon\Carbon::parse($order->start_date)
                                    @endphp
                                    @for ($j = 0; $j < 7; $j++)
                                        @for ($k = 0; $k < count($order->scheduled_days); $k++)
                                            @php
                                                $sd = $order->scheduled_days[$k];
                                                $checked = $start_date->format('l') === $sd->day ? true : false;
                                                if($checked) {
                                                    break;
                                                }
                                            @endphp
                                        @endfor
                                        {!! Form::checkbox('days_scheduled[]', $start_date->format('l'), $checked ?? false, ['class' => 'days_checkbox']) !!} {{ $start_date->format('l') }}


                                        @php
                                            $start_date->addDay()
                                        @endphp
                                    @endfor
                                <p>
                                <div class="form-group">
                                    <label for="" class="required">Expected time to start: </label>
                                    <div class="input-group date w-25">
                                        {!! Form::time('time', $order->scheduled_days[0]->time ?? null, ['class' => 'form-control', 'required' => true]) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($order->products[0]->product->treatment_type === 'daily')
                                @if(count($order->schedulings))
                                    @foreach ($order->schedulings as $i => $item)
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong  class="required">Start Date <small>Day {{ $i + 1 }}</small></strong>
                                                {!! Form::date('start_date[]', $item->start_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d'), 'readonly' => true]) !!}
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
                                                {!! Form::date('start_date[]', $item->start_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d'), 'readonly' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong class="required">End Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('end_date[]', $item->end_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d'), 'readonly' => true]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, $item->caregiver_id, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true,'placeholder' => 'Select Caregiver']) }}
                                                <p class="mt-2">Select Days ({{ $order->products[0]->product->no_of_days_per_week }} days / week) <small>{{ $order->products[0]->product->no_of_hrs_per_day }} hours/day</small>:</p>
                                                <p class="p-2 days_container" data-id="{{ $order->products[0]->product->no_of_days_per_week }}">
                                                    @php
                                                        $start_date = $i == 0 ? Carbon\Carbon::parse($order->start_date) : $start_date
                                                    @endphp
                                                    @for ($j = 0; $j < 7; $j++)
                                                        @php
                                                            $checked = false
                                                        @endphp
                                                        @for ($k = 0; $k < count($item->scheduling_days); $k++)
                                                            @php
                                                                $sd = $item->scheduling_days[$k];
                                                                $checked = $start_date->format('Y-m-d') ===  Carbon\Carbon::parse($sd->date)->format('Y-m-d') ? true : false;
                                                                if($checked) {
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endfor
                                                        <label for="" class="px-1">
                                                            {!! Form::checkbox('days['.$i.'][]', $start_date->format('Y-m-d'), $checked ?? false, ['class' => 'days_checkbox', 'data' => $start_date->format('l')]) !!} {{ $start_date->format('l') }}<small>( {{ $start_date->format('M-d') }})</small>
                                                        </label>
                                                        @php
                                                           $start_date->addDay()
                                                        @endphp
                                                    @endfor
                                                <p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                        @php
                                            $start_date__ = null;
                                        @endphp
                                    @for ($i = 0; $i < $order->products[0]->qty; $i++)
                                        @php
                                            $start_date__ = Carbon\Carbon::parse($start_date__ ?? $order->start_date)->addDays($start_date__?1:0)->format('Y-m-d')
                                        @endphp
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong class="required">Start Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('start_date[]', ($start_date__), ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                        </div>
                                        @php
                                            $start_date__ = (Carbon\Carbon::parse($start_date__)->addDays(6)->format('Y-m-d') )
                                        @endphp
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong class="required">End Date <small>Week {{$i+1}}</small></strong>
                                                {!! Form::date('end_date[]', $start_date__ , ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, null, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true,'placeholder' => 'Select Caregiver']) }}
                                                <p class="mt-2">Select Days ({{ $order->products[0]->product->no_of_days_per_week }} days / week) <small>{{ $order->products[0]->product->no_of_hrs_per_day }} hours/day</small>:</p>
                                                <p class="p-2 days_container" data-id="{{ $order->products[0]->product->no_of_days_per_week }}">
                                                    @php
                                                        $start_date = $i === 0 ? Carbon\Carbon::parse($order->start_date) : $start_date
                                                    @endphp
                                                    @for ($j = 0; $j < 7; $j++)
                                                        <label for="" class="px-1">
                                                            {!! Form::checkbox('days['.$i.'][]', $start_date->format('Y-m-d'), false, ['class' => 'days_checkbox','data' => $start_date->format('l')]) !!} {{ $start_date->format('l') }}<small>( {{ $start_date->format('M-d') }})</small>

                                                        </label>
                                                        @php
                                                           $start_date->addDay()
                                                        @endphp
                                                    @endfor
                                                <p>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            @endif

                            @if($order->products[0]->product->treatment_type === 'monthly')
                                @if(count($order->schedulings))
                                    @foreach ($order->schedulings as $i => $item)
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong class="required">Start Date <small>Month {{$i+1}}</small></strong>
                                                {!! Form::date('start_date[]', $item->start_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d'), 'readonly' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong class="required">End Date <small>Month {{$i+1}}</small></strong>
                                                {!! Form::date('end_date[]', $item->end_date, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d'), 'readonly' => true]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, $item->caregiver_id, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true,'placeholder' => 'Select Caregiver']) }}

                                                <p class="p-2 days_container" data-id="{{ $order->products[0]->product->no_of_days_per_week }}">
                                                    @php
                                                        $date_period_ = new DatePeriod(new DateTime($item->start_date), new DateInterval('P1D'), new DateTime($item->end_date));
                                                    @endphp

                                                    @foreach ($date_period_ as $d)
                                                        @php
                                                            $checked = false
                                                        @endphp
                                                        @for ($k = 0; $k < count($item->scheduling_days); $k++)
                                                            @php
                                                                $sd = $item->scheduling_days[$k];
                                                                $checked = $d->format('Y-m-d') ===  Carbon\Carbon::parse($sd->date)->format('Y-m-d') ? true : false;
                                                                if($checked) {
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endfor
                                                        <label for="" class="px-1">
                                                            {!! Form::checkbox('days['.$i.'][]',$d->format('Y-m-d'), $checked ?? false, ['class' => 'days_checkbox','data' => $d->format('l')]) !!} {{ $d->format('l') }}<small>( {{ $d->format('M-d') }})</small>
                                                        </label>
                                                    @endforeach
                                                <p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                        @php
                                            $start_date__ = null;
                                        @endphp
                                    @for ($i = 0; $i < $order->products[0]->qty; $i++)
                                        @php
                                            $start_date__ = Carbon\Carbon::parse($start_date__ ?? $order->start_date)->addDays($start_date__?1:0)->format('Y-m-d')
                                        @endphp
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong class="required">Start Date <small>Month {{$i+1}}</small></strong>
                                                {!! Form::date('start_date[]', ($start_date__), ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                        </div>
                                        @php
                                            $temp_start_date = new DateTime($start_date__);
                                            $start_date__ = (Carbon\Carbon::parse($start_date__)->addMonths(1)->format('Y-m-d') );
                                            $temp_end_date = new DateTime($start_date__);
                                            $date_period_ = new DatePeriod($temp_start_date, new DateInterval('P1D'), $temp_end_date);
                                            $start_date__ = (Carbon\Carbon::parse($start_date__)->subDay()->format('Y-m-d') )
                                        @endphp
                                        <div class="col-xs-12 col-sm-12 col-md-6 scheduling">
                                            <div class="form-group">
                                                <strong class="required">End Date <small>Month {{$i+1}}</small></strong>
                                                {!! Form::date('end_date[]', $start_date__ , ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-link advance">Advance</button>
                                            </div>
                                            <div class="caregiver_div d-none">
                                                {{ Form::select('caregiver[]', $caregivers, null, ['class' => 'form-control custom-select-width w-50 caregivers__', 'required' => true,'placeholder' => 'Select Caregiver']) }}

                                                <p class="p-2 days_container" data-id="{{ $order->products[0]->product->no_of_days_per_week }}">
                                                    @foreach ($date_period_ as $d)
                                                        <label for="" class="px-1">
                                                            {!! Form::checkbox('days['.$i.'][]',$d->format('Y-m-d'), false, ['class' => 'days_checkbox','data' => $d->format('l')]) !!} {{ $d->format('l') }}<small>( {{ $d->format('M-d') }})</small>
                                                        </label>
                                                    @endforeach
                                                <p>
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
    <table class="table table-striped table-bordered dataTable no-footer">
        <thead>
            <tr>
                <th>Sn#</th>
                <th>Product</th>
                <th>Care Giver</th>
                <th>Customer</th>
                <th>Service Dates</th>
                <th>Expected Starting Time</th>
                <th>Expected Hours</th>
                <th>Work Status</th>
                <th>Remarks</th>
                <th>Reviewed By</th>
                <th>Reason For Refuse</th>
                <th>Invoiced?</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->schedulingsDays as $key => $day)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order->products[0]->product->name }}</td>
                    <td>{{ $day->scheduling->caregiver->first_name}} {{$day->scheduling->caregiver->last_name ?? null}}</td>
                    <td>{{ $order->customer->first_name }} {{ $order->customer->last_name ?? null }}</td>
                    <td>{{date('D d M Y', strtotime($day->date))}}</td>
                    <td>{{ $order->scheduled_days[0]->time ?? null }}</td>
                    <td>{{ $order->products[0]->product->no_of_hrs_per_day }}</td>
                    <td>
                        <div class="input-group-btn">
                            @if ($day->status === 'assign')
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false" @if(date('Y-m-d') < date('Y-m-d', strtotime($day->date))) disabled @endif data-schedule="{{ $day->id }}">{{ ucfirst($day->status) }}<span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @foreach ($status as $st)
                                        @if($st !== $day->status)<li><a class="dropdown-item" data-toggle="modal" data-target="#openActionModal" onclick="changeStatus({{$day->id}}, '{{ $st }}')">{{ucfirst($st)}}</a></li>@endif
                                    @endforeach
                                </ul>
                            @else
                                <button type="button" class="btn @if($day->status === 'failed') btn-danger @else btn-success @endif"  disabled>{{ ucfirst($day->status) }} <i class="fa fa-lock"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                    <td>{{ $day->remarks }}</td>
                    <td>{{ $day->user->name ?? null }}</td>
                    <td>{{ $day->reason_for_refuse }}</td>
                    <td><i class="fa fa-{{$day->payslip_id?'check':'times'}} text-{{$day->payslip_id?'success':'danger'}}"></i></td>
                    <td>{{ $day->payslip_id ? $day->payslip->invoice_no : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

     <!-- Modal -->
     <div class="modal fade" id="openActionModal" tabindex="-1" role="dialog" aria-labelledby="openSchedulingsModalTitle"
     aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to <span class="status"></span> schedule?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <input type="hidden" id="status">
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea id="remarks" class="form-control"></textarea>
                    </div>

                    <div class="form-group d-none" id="refuseDiv">
                        <label for="reasonForRefuse">Reason For Refuse</label>
                        <textarea id="reasonForRefuse" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-info" id="updateStatus">Update Status</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
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

        //
        $(document).on('change', '#main_divion_of_days .days_checkbox', function() {
            // if($('.days_checkbox[data="'+$(this).val()+'"]').is(':not(:checked)')) {
            // }
            $('.days_checkbox[data="'+$(this).val()+'"]').prop('checked', $(this).is(':checked'))
        })

        $(document).on('change', '.days_checkbox', function() {
            let container = $(this).parents('.days_container')
            let daysLimit = parseInt(container.attr('data-id'))
            let checkedBoxes = container.find('.days_checkbox:checked').length
            if(checkedBoxes === daysLimit) {
                if($(this).parent().attr('id') === 'main_divion_of_days') {
                    $('.days_checkbox:not(:checked)').attr('disabled', '')
                }else {
                    container.find('.days_checkbox:not(:checked)').attr('disabled', '')
                }
            }else{
                if($(this).parent().attr('id') === 'main_divion_of_days') {
                    $('.days_checkbox').removeAttr('disabled')
                }else {
                    container.find('.days_checkbox').removeAttr('disabled')
                }
            }
        })
        $('.dataTable').DataTable()

        function changeStatus(id, status) {
            $('#reasonForRefuse').val('')
            $('#remarks').val('')
            $('#id').val('')
            $('#status').val('')
            if(status === 'failed') {
                if($('#refuseDiv').hasClass('d-none')){
                    $('#refuseDiv').removeClass('d-none')
                }
            }else {
                if(!$('#refuseDiv').hasClass('d-none')){
                    $('#refuseDiv').addClass('d-none')
                }
            }
            $('#id').val(id)
            $('#status').val(status)
            $('.status').text(status)
        }

        $(document).on('click', '#updateStatus', function() {
            let data = {}
            data._token = '{{ csrf_token() }}'
            data.id = $('#id').val()
            data.status = $('#status').val()
            data.remarks = $('#remarks').val()
            if(data.status === 'failed') {
                data.reason_for_refuse = $('#reasonForRefuse').val()
            }
            let url = '{{ url("/scheduling/update/") }}/'+data.id
            let buttonText = $(this).text();
            $.ajax({
                url: url,
                data,
                type: 'POST',
                beforeSend: function(){
                    $(this).html('<i class="fa fa-spin fa-spinner"></i>')
                    $(this).attr('disabled', true)
                },
                success: function(response) {
                    if(response.success) {
                        let button = $('[data-schedule="'+data.id+'"]')
                        button.removeClass('btn-warning')
                        button.addClass(data.status === 'failed' ? 'btn-danger' : 'btn-success')
                        button.attr('disabled', true)
                        button.html(response.status+' <i class="fa fa-lock"></i>')
                        $('#openActionModal').modal('hide')
                    }
                },
                complete: function() {
                    $(this).html(buttonText)
                    $(this).attr('disabled', false)
                    window.location.reload()
                }
            })
        })
    </script>
@endsection
