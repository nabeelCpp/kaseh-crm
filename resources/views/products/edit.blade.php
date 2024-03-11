@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')


    <form action="{{ route('products.update',$product->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
                    <label class="required"><strong>Name</strong></label>
		            {{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => true]) }}
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <label class="required"><strong>Treatment Type</strong></label>
                    {{ Form::select('treatment_type', $treatmentType, $product->treatment_type, ['class' => 'form-control', 'placeholder' => 'Select Treatment Type', 'onchange' => 'changeTreatementType(this.value)', 'required' => true]) }}
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12 @if($product->treatment_type === 'daily') d-none @endif" id="days_per_week_div">
		        <div class="form-group">
		            <label class="required"><strong>No. of days per week</strong></label>
                    @if($product->treatment_type === 'weekly')
                        {{ Form::number('no_of_days_per_week', $product->no_of_days_per_week, ['class' => 'form-control', 'placeholder' => 'No. of days/week', 'required' => true, 'min' => 1, 'max' => 7 ]) }}
                    @else
                        {{ Form::number('no_of_days_per_week', $product->no_of_days_per_week, ['class' => 'form-control', 'placeholder' => 'No. of days/week', 'min' => 1, 'max' => 7 ]) }}
                    @endif
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12" id="hrs_per_day_div">
		        <div class="form-group">
		            <label class="required"><strong>No. of hours per day</strong></label>
                    {{ Form::number('no_of_hrs_per_day', $product->no_of_hrs_per_day, ['class' => 'form-control', 'placeholder' => 'No. of hrs/day', 'required' => true, 'min' => 1, 'max' => 24 ]) }}
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
                    <label class="required"><strong>Price</strong></label>
					{{ Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Enter price', 'required' => true]) }}
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Update</button>
		    </div>
		</div>


    </form>


@endsection
@section('js')
    <script>
        const changeTreatementType = (value) => {
            if(value === 'daily') {
                if(!$('#days_per_week_div').hasClass('d-none')) {
                    $('#days_per_week_div').addClass('d-none')
                }
                if($('#hrs_per_day_div').hasClass('d-none')) {
                    $('#hrs_per_day_div').removeClass('d-none')
                }
                $('#days_per_week_div').find('input[name="days_per_week"]').val('')
                $('#days_per_week_div').find('input[name="days_per_week"]').removeAttr('required')
            }else if(value === 'weekly') {
                if($('#days_per_week_div').hasClass('d-none')) {
                    $('#days_per_week_div').removeClass('d-none')
                }
                if($('#hrs_per_day_div').hasClass('d-none')) {
                    $('#hrs_per_day_div').removeClass('d-none')
                }
                $('#days_per_week_div').find('input[name="days_per_week"]').attr('required', true)
            } else {
                if(!$('#days_per_week_div').hasClass('d-none')) {
                    $('#days_per_week_div').addClass('d-none')
                }

                if(!$('#hrs_per_day_div').hasClass('d-none')) {
                    $('#hrs_per_day_div').addClass('d-none')
                }
            }
        }

        @if(old('treatment_type') || $product->treatment_type)
            changeTreatementType('{{ old("treatment_type") ?? $product->treatment_type }}')
        @endif
    </script>
@endsection
