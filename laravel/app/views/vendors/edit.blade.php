@extends('layouts.main')

@section('content')
	<h3 class="section-title style2 text-center">
		<span>Edit Vendor</span>
	</h3>
		{{ Form::open(array('url'=>'admin/users/edit'))}}
			@if($super)
			<p>
				{{ Form::label('Vendor code') }}
				{{ Form::hidden('id',$vendors->id)}}
				{{ Form::text('uniq_ven_id',$vendors->uniq_ven_id ,array('class'=>'form-control input-md')) }}
			</p>
			@endif
			<p>
				{{ Form::label('First name') }}
				{{ Form::text('firstname',$vendors->firstname,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Last name') }}
				{{ Form::text('lastname',$vendors->lastname,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Username') }}
				{{ Form::text('username',$vendors->username,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Address') }}
				{{ Form::textarea('address',$vendors->address,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Phone') }}
				{{ Form::text('phone',$vendors->phone,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Registered mobile number.') }}
				<br/>
				<span style="font-size:11px;">* For getting mobile notification of new orders.</span>
				{{ Form::text('rmn',$vendors->rmn,array('class'=>'form-control input-md')) }}
			</p>
			@if(Session::get('user_status') != 'vendor')
			<p>
				{{ Form::label('Status') }}
				<?php $status = array('active'=>'active','inactive'=>'inactive');?>
				{{ Form::select('status',$status,'',array('class'=>'form-control input-md')) }}
			</p>
			@endif
			{{ Form::submit('Submit',array('class'=>'btn btn-primary bottom-30')) }}	
		{{ Form::close() }}
@stop