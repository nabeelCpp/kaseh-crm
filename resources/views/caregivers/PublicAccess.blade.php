@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
            </div>
            {{-- <div class="pull-right">
                <a href="{{ route('download.order', ['order_no' => $order->order_no]) }}" class="btn btn-success"><i
                        class="fa fa-download"></i> Download Quotation</a>
                @if (!$order->caregiver_id)
                    <button class="btn btn-secondary" onclick="confirmAppointment()"><i class="fa fa-check"></i> Confirm Appointment</button>
                @endif
            </div> --}}
        </div>
    </div>
    @include('inc.errors-alert')
    <style>
       .caregiver-image {
        max-width: 200px; /* Set the maximum width of the image */
        max-height: 150px; /* Set the maximum height of the image */
        border-radius: 50%; /* Make the image round */
        border: 2px solid #ccc; /* Add a border around the image */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a shadow to the image */
    }
    </style>
    <div class="row">
        <img src="{{ $caregiver->caregiver_image }}" alt="Image" class="caregiver-image">
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Caregiver</strong>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <input type="text" readonly
                    value="{{ $caregiver->first_name ?? '-' }} {{ $caregiver->last_name ?? null }}"
                    class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Nationality</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <input type="text" readonly
                    value="{{ $caregiver->nationality }} "
                    class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Mobile</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" id="sales_person" name="sales_person"
                    value="{{ $caregiver->mobile }}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Joining Date</strong>
                <input type="text" readonly value="{{ date('d-m-Y', strtotime($caregiver->created_at)) }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Country</strong>
                <input type="text" readonly value="{{$caregiver->country }}"
                    class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Age</strong>
                <input type="text" readonly value="{{ $caregiver->age }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Gender</strong>
                <input type="text" readonly value="{{$caregiver->gender }}"
                    class="form-control">
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Remarks</strong>
                <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control" readonly>{{ $order->remarks ?? '-' }}</textarea>
            </div>
        </div>
    </div> --}}


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Profession</th>
                <th>Status</th>
                <th>Marital Status</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <th>{{$caregiver->profession  }}</th>
                    <td>{{$caregiver->status  }}</td>
                    <td>{{ $caregiver->marital_status  }}</td>
                    <td>{{ $caregiver->address_one  }}</td>
                </tr>
        </tbody>
    </table>

    {{-- scheduling --}}

    {{-- <div class="d-none" id="scheduling_div">
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
    </div> --}}
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
