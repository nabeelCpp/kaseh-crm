@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')



    {{-- {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!} --}}
    {!! Form::open(['route' => 'orders.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{ csrf_field() }}
    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Caregivers</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="caregiver_id" class="form-control custom-select-width" required>
                    <option value="" disabled selected>Select Caregiver</option>
                    @foreach ($caregivers as $caregiver)
                        <option value="{{ $caregiver->id }}" {{ old('caregiver_id') == $caregiver->id ? 'selected' : '' }}>{{ $caregiver->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong class="required">Customers</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="customer_id" class="form-control custom-select-width" required>
                    <option value="" disabled selected>Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong class="required">Product</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="product_id" id="productDropdown" class="form-control custom-select-width" onchange="populateProductDetails(this.value)" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong @if(strtolower(auth()->user()->getRoleNames()[0]) === 'admin') class="required" @endif>Sales Person</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                @if(strtolower(auth()->user()->getRoleNames()[0]) === 'admin')
                    {{ Form::select('sales_person', $salesAgents, null, ['class' => 'form-control', 'placeholder' => 'Select Sales Person', 'required' => true]) }}
                @else
                    <input type="text" class="form-control" id="sales_person" name="sales_person"
                    value="{{ Auth::user()->name }}" readonly>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong class="required">Quantity <small id="qty_type"></small></strong>
                {!! Form::number('quantity', null, ['placeholder' => 'Quantity', 'class' => 'form-control', 'min' => 0, 'required' => '', 'onchange' => 'changeQty(this.value)', 'id' => 'quantity', 'data-id' => '']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Unit Price </strong><small class="text-muted">({{ env('currency') }})</small>
                <input type="text" class="form-control" id="unit_price" name="unit_price"
                    value="{{ old('unit_price') }}" placeholder="{{ env('currency') }} 0" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Total </strong><small class="text-muted">({{ env('currency') }})</small>
                <input type="text" class="form-control" id="total" name="total_invoiced"
                    value="{{ old('total_invoiced') }}" placeholder="{{ env('currency') }} 0" readonly>
            </div>
        </div>
    </div>
    <div class="row" id="scheduling_dates">

    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Remarks</strong>
                <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control">{{ old('remarks') }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success" id="submit">Create Order</button>
    </div>
    {!! Form::close() !!}
@endsection
@section('js')
    <script>
        let products = (@json($products->toArray()))
        let price = 0;
        $(document).ready(function() {
            $('#submit').click(function(e) {
                let requiredFields = $("[required]");
                requiredFields.each(function() {
                    if (!$(this).val()) {
                        e.preventDefault();
                        $(this).parents('.form-group').addClass('bad');
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                    } else {
                        if ($(this).parents('.form-group').hasClass('bad')) {
                            $(this).parents('.form-group').removeClass('bad');
                        }
                    }
                })
            })
        })
        function populateProductDetails(id) {
            products.forEach(p => {
                if(p.id === parseInt(id)) {
                    price = p.price
                    $('#unit_price').val(price)
                    $('#qty_type').text(p.treatment_type === 'weekly' ? 'No. of Weeks' : 'No. of Days')
                    // Add data-id weekly/daily for displaying dates fields accordingly when quantity changes
                    $('#quantity').attr('data-id', p.treatment_type)
                    $('#quantity').val('')
                    $('#total').val('')
                    $('#scheduling_dates').html('')
                }
            });
        }

        @if (old('product_id'))
            populateProductDetails({{ old('product_id') }})
        @endif

        function changeQty(qty) {
            $('#total').val(parseInt(qty) * price)
        }

        $(document).on('change', '#quantity', function() {
            let type = $(this).attr('data-id')
            let qty = $(this).val()
            populateScheduling(type, qty)
        })

        function populateScheduling(type, qty) {
            let html = [];
            const today = new Date().toISOString().split('T')[0];
            for (let i = 0; i < qty; i++) {
                html.push(type === 'daily' ? `<div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Day ${i+1}</strong>
                            {!! Form::date('start_date[]', null, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => '${today}']) !!}
                        </div>
                    </div>` : `<div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Start Date <small>(Week ${i+1})</small></strong>
                                {!! Form::date('start_date[]', null, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => '${today}']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>End Date <small>(Week ${i+1})</small></strong>
                                {!! Form::date('end_date[]', null, ['placeholder' => '', 'class' => 'form-control', 'required' => '', 'min' => '${today}']) !!}
                            </div>
                        </div>`)
            }
            $('#scheduling_dates').html(html.join(''))
        }
    </script>
@endsection
