@extends('layouts.main')

@section('content')
	
	<div id='admin'>
		<h3 class="section-title style2 text-center">
			<span>Add new vendor</span>
		</h3>

		@if($errors->has())
			<div id='form-errors'>
				<p>Following errors occurred : </p>
				<ul>
					@foreach ($errors->all() as $error) 
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div><!-- end form errors-->
		@endif

		{{ Form::open(array('url'=>'admin/vendors/create')) }}
		<p>
			{{ Form::label('firstname') }}
			{{ Form::text('firstname') }}
		</p>
		<p>
			{{ Form::label('lastname') }}
			{{ Form::text('lastname') }}
		</p>
		<p>
			{{ Form::label('username') }}
			{{ Form::text('username') }}
		</p>
		<p>
			{{ Form::label('uni_ven_id','Vendor code') }}
			{{ Form::text('uni_ven_id') }}
		</p>
		<p>
			{{ Form::label('password') }}
			{{ Form::password('password') }}
		</p>
		<p>
			{{ Form::label('address') }}
			{{ Form::textarea('address') }}
		</p>
		<p>
			{{ Form::label('email') }}
			{{ Form::text('email') }}
		</p>
		<p>
			{{ Form::label('primary phone') }}
			{{ Form::text('phone') }}
		</p>
		<p>
			{{ Form::label('secondary phone') }}
			{{ Form::text('phone2') }}
		</p>
		<p>
			{{ Form::label('delivery options') }}
			{{ Form::text('delivery options') }}
		</p>
		{{ Form::submit('Submit',array('class'=>'btn')) }}
		{{ Form::close() }}
	</div><!-- end admin -->
 
@stop