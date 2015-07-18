@extends('layouts.main')

@section('content')
	<h3 class="section-title style2 text-center">
		<span>Edit Coupon Details</span>
	</h3>
	@foreach ($coupons as $key => $value)
		{{ Form::open(array('url'=>'admin/coupons/edit'))}}
			<p>
				{{ Form::label('Batch unique id') }}
				{{ Form::text('batchuniqid',$value->batchuniqid ,array('class'=>'form-control input-md')) }}
			</p>
			{{ Form::hidden('id',$value->id ,array('class'=>'form-control input-md')) }}
			{{ Form::hidden('code',$value->code ,array('class'=>'form-control input-md')) }}
			@if($value->batchuniqid != $value->code)
				{{ Form::hidden('batch', 1) }}
			@else	
				{{ Form::hidden('batch', 0) }}
			@endif
			<p>
				{{ Form::label('Discount') }}
				{{ Form::text('Discount',$value->discount,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('min_val','Minimum value')}}	
				{{ Form::text('min_val',$value->min_val,array('class'=>'form-control input-md'))}}
			</p>	
			<p>
				{{ Form::label('Type') }}
				{{ Form::text('Type',$value->type,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Parent Id') }}
				{{ Form::text('Parent Id',$value->parent_id,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Expiry') }}
				{{ Form::text('Expiry',$value->expiry,array('class'=>'form-control input-md')) }}
			</p>
			@if($value->batchuniqid == $value->code)
			<p>
				{{ Form::label('Status') }}
				<?php $status = array('activated'=>'activated','deactivated'=>'deactivated');?>
				{{ Form::select('Status',$status,'',array('class'=>'form-control input-md')) }}
			</p>
			@endif
			{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
		{{ Form::close() }}
	@endforeach
@stop