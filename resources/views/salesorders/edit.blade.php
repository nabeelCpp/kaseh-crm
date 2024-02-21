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
    {!! Form::model($order, ['method' => 'PATCH','route' => ['orders.update', $order->id], 'enctype' => 'multipart/form-data']) !!}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Caregiver</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="caregiver_id" class="form-control custom-select-width" required>
                    <option value="" disabled selected>Select Caregiver</option>
                    @foreach ($caregivers as $caregiver)
                        <option value="{{ $caregiver->id }}" {{ old('caregiver_id') == $caregiver->id || $caregiver->id == $order->caregiver_id ? 'selected' : '' }}>{{ $caregiver->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Customers</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="customer_id" class="form-control custom-select-width" required>
                    <option value="" disabled selected>Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id || $customer->id === $order->customer_id ? 'selected' : '' }}>{{ $customer->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
            <strong>Product</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="product_id" id="productDropdown" class="form-control custom-select-width" onchange="populateProductDetails(this.value)" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id || $product->id === $order->products[0]->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
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
                    value="{{ Auth::user()->name }}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Quantity</strong>
                {!! Form::number('quantity', $order->products[0]->qty ?? null, ['placeholder' => 'Quantity', 'class' => 'form-control', 'min' => 0, 'required' => '', 'onchange' => 'changeQty(this.value)']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Unit Price </strong><small class="text-muted">({{ env('currency') }})</small>
                <input type="text" class="form-control" id="unit_price" name="unit_price"
                    value="{{ old('unit_price') ?? ($order->products[0]->unit_price ?? null) }}" placeholder="{{ env('currency') }} 0" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Total </strong><small class="text-muted">({{ env('currency') }})</small>
                <input type="text" class="form-control" id="total" name="total_invoiced"
                    value="{{ old('total_invoiced') ?? ($order->products[0]->total ?? null) }}" placeholder="{{ env('currency') }} 0" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Start Date</strong>
                {!! Form::date('start_date', null, ['placeholder' => '', 'class' => 'form-control', 'required' => '']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>End Date</strong>
                {!! Form::date('end_date', null, ['placeholder' => '', 'class' => 'form-control', 'required' => '']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Remarks</strong>
                <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control">{{ old('remarks') ?? ($order->remarks??null) }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success" id="submit">Update Order</button>
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
                }
            });
        }

        @if (old('product_id'))
            populateProductDetails({{ old('product_id') }})
        @endif

        function changeQty(qty) {
            $('#total').val(parseInt(qty) * price)
        }
    </script>
@endsection
