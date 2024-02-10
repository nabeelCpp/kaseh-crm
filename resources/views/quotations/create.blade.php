@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')



    {{-- {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!} --}}
    {!! Form::open(array('route' => 'quotations.store', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2">
        <strong>Caregivers</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <select name="caregiver_id" class="form-control custom-select-width">
                    @foreach ($caregivers as $caregiver)
                        <option value="{{ $caregiver->id }}">{{ $caregiver->first_name }}</option>
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
                    <select name="customer_id" class="form-control custom-select-width">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
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
                        <select name="product_id" id="productDropdown" class="form-control custom-select-width">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                    <input type="text" class="form-control" id="sales_person" name="sales_person" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>
        </div>
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Date</strong>
                    {!! Form::date('date', null, array('placeholder' => '','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Reference/Description Appointmen</strong>
                    {!! Form::text('refrence_description', null, array('placeholder' => 'Reference','class' => 'form-control')) !!}
                    </div>
                </div>
        </div>
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Description</strong>
                    {!! Form::text('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
                    </div>
                </div>
        </div>
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Service From</strong>
                    {!! Form::date('service_from', null, array('placeholder' => '','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Service To</strong>
                    {!! Form::date('service_to', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
        </div>
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Quantity</strong>
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                    <strong>Unit Price</strong>
                    <input type="text" name="price" id="productPriceInput" readonly>
                </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary" id="submit">Confirm Quotation</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#submit').click(function(e) {
                let requiredFields = $("[required]");
                requiredFields.each(function() {
                    if(!$(this).val()){
                        e.preventDefault();
                        $(this).parents('.form-group').addClass('bad');
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }else{
                        if($(this).parents('.form-group').hasClass('bad')){
                            $(this).parents('.form-group').removeClass('bad');
                        }
                    }
                })
            })
        })
        $(document).ready(function(){
        $('#productDropdown').change(function(){
            var productId = $(this).val();
            if(productId){
                $.ajax({
                    type: "GET",
                    url: '/get-product-price/' + productId,
                    success: function(response){
                        $('#productPriceInput').val(response.price);
                    }
                });
            }
        });
    });
    </script>
@endsection
