@extends('layouts.login')
@section('content')
    <style>
       .caregiver-image {
        max-width: 200px; /* Set the maximum width of the image */
        max-height: 150px; /* Set the maximum height of the image */
        border-radius: 50%; /* Make the image round */
        border: 2px solid #ccc; /* Add a border around the image */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a shadow to the image */
    }
    </style>
    <div class="p-5">

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
    </div>


@endsection
