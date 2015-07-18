@extends('layouts.main')

@section('content')

	<div id='signin'>
		
		{{ Form::label('Email') }}
		{{ Form::text('email') }}

		{{ Form::label('Password') }}
		{{ Form::password('password') }}

		
	</div>

	<div class='signup'>
		{{ HTML::link('/users/newaccount','Create new account') }}
	</div>
@stop
