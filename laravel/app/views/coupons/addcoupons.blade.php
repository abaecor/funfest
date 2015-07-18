@extends('layouts.main')

@section('content')

<div id='addcoupon'>
	<h3 class="section-title style2 text-center">
		<span>Generate Coupons</span>
	</h3>

	{{ Form::open(array('url'=>'admin/coupons/addcoupons')) }}
	<?php
		$categories = array('cb'=>'Cash Back','dis'=>'Discount');
	?>
	{{ Form::label('category_id','Coupon type') }}
	{{ Form::select('category_id',$categories,'',array('class'=>'form-control input-md')) }}

	{{ Form::label('coupon_code','Coupon code') }}
	{{ Form::text('coupon_code','',array('class'=>'form-control input-md')) }}

	{{ Form::label('discount','Add amount') }}
	{{ Form::text('discount','',array('class'=>'form-control input-md')) }}

	{{ Form::label('min_val','Minimum value')}}	
	{{ Form::text('min_val','',array('class'=>'form-control input-md'))}}
	
	{{ Form::label('validity','Valid upto')}}	
	{{ Form::text('validity','',array('class'=>'form-control input-md','placeholder'=>'yyyy/mm/dd'))}}

	{{ Form::label('associate','Assign the code to an existing category')}}	
	<?php 
		$parents = array('0'=>'Select if applicable','1'=>'Free Charge','2'=>'Lens Kart','3'=>'Mac Donalds');
	?>
	{{ Form::select('associate',$parents,'',array('class'=>'form-control input-md')) }}

	{{ Form::submit('Submit',array('class'=>'btn btn-primary top30')) }}
	{{ Form::close() }}

	<br/><br/>

	<h3 class="section-title style2 text-center">
		<span>Batch Generate</span>
	</h3>
	{{ Form::open(array('url'=>'admin/coupons/addbatch')) }}

	{{ Form::label('label','Add a prefix to coupon') }}
	{{ Form::text('label','',array('class'=>'form-control input-md')) }}
	
	{{ Form::label('validity','Valid upto')}}	
	{{ Form::text('validity','',array('class'=>'form-control input-md','placeholder'=>'yyyy/mm/dd'))}}

	{{ Form::label('number','Number of codes to be generated')}}	
	{{ Form::text('number','',array('class'=>'form-control input-md'))}}

	<?php
		$categories = array('cb'=>'Cash Back','dis'=>'Discount');
	?>
	{{ Form::label('category_id','Coupon type') }}
	{{ Form::select('category_id',$categories,'',array('class'=>'form-control input-md')) }}
	
	{{ Form::label('discount','Add amount') }}
	{{ Form::text('discount','',array('class'=>'form-control input-md')) }}

	{{ Form::label('min_val','Minimum value')}}	
	{{ Form::text('min_val','',array('class'=>'form-control input-md'))}}

	{{ Form::label('referal','Promotional company name')}}	
	{{ Form::text('referal','',array('class'=>'form-control input-md'))}}

	{{ Form::submit('Submit',array('class'=>'btn btn-primary top30')) }}
	{{ Form::close() }}

</div>		

@stop