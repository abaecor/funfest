@extends('layouts.main')

@section('content')

<div id='newaccount'>
	<h1>Create new account</h1>

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

	{{ Form::open(array('url'=>'/users/create')) }}	
	<p>
		{{ Form::label('Firstname') }}
		{{ Form::text('firstname','',array('class'=>'form-control input-md')) }}
	</p>
	<p>
		{{ Form::label('Lastname') }}
		{{ Form::text('lastname','',array('class'=>'form-control input-md')) }}
	</p>
	<p>
		{{ Form::label('Username') }}
		{{ Form::text('username','',array('class'=>'form-control input-md')) }}
	</p>
	<p>
		{{ Form::label('Vendor code') }}
		{{ Form::text('uniq_ven_id','',array('class'=>'form-control input-md')) }}
	</p>
	<p>
		{{ Form::label('Password') }}
		{{ Form::password('password',array('class'=>'form-control input-md')) }}
	</p>
	<p>
		{{ Form::label('Address') }}
		{{ Form::textarea('address','',array('class'=>'form-control')) }}
	</p>
	<p>
		{{ Form::label('E-mail') }}
		{{ Form::text('email','',array('class'=>'form-control input-md')) }}
	</p>
	<p>
		{{ Form::label('Phone') }}
		{{ Form::text('phone','',array('class'=>'form-control input-md')) }}
	</p>
	{{ Form::hidden('type', $type)}}
	{{ Form::submit('create account',array('class'=>'btn btn-primary')) }}
	{{ Form::close() }}
</div>
	<h2><br/>OR<br/>
	Batch Edit 
	</h2>
	<div class="batch_class">
		{{Form::open(array('url'=>'admin/users/vendbatch','files'=>true))}}
		{{Form::label('exel_file','Upload a file for vendors')}}
		{{Form::file('excel_file',array('class'=>'btn btn-primary'))}}
		<br/>
		{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
		{{ Form::close() }}
	</div>
<div class="top30"></div>

@stop