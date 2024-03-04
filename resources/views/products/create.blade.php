@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @include('inc.errors-alert')


    <form action="{{ route('products.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <label class="required"><strong>Name</strong></label>
		            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => true]) }}
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <label class="required"><strong>Treatment Type</strong></label>
                    {{ Form::select('treatment_type', $treatmentType, null, ['class' => 'form-control', 'placeholder' => 'Select Treatment Type', 'onchange' => 'changeTreatementType(this.value)', 'required' => true]) }}
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12 d-none" id="days_per_week_div">
		        <div class="form-group">
		            <label class="required"><strong>No. of days per week</strong></label>
                    {{ Form::number('no_of_days_per_week', null, ['class' => 'form-control', 'placeholder' => 'No. of days/week', 'required' => true, 'min' => 1, 'max' => 7 ]) }}
		        </div>
		    </div>
			<div class="col-xs-12 col-sm-12 col-md-12 d-none" id="hrs_per_day_div">
		        <div class="form-group">
		            <label class="required"><strong>No. of hours per day</strong></label>
                    {{ Form::number('no_of_hrs_per_day', null, ['class' => 'form-control', 'placeholder' => 'No. of hrs/day', 'required' => true, 'min' => 1, 'max' => 24 ]) }}
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <label class="required"><strong>Price</strong></label>
					{{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Enter price', 'required' => true]) }}
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
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
    </script>
@endsection
