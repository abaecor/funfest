@extends('layouts.main')

@section('content')
	<h3 class="section-title style2 text-center">
		<span>Add address</span>
	</h3>
	{{ Form::open(array('url'=>'admin/users/addaddress'))}}
		
		<p>
			{{ Form::label('Address') }}
			{{ Form::textarea('address',"",array('class'=>'form-control input-md')) }}
		</p>
		
		{{ Form::submit('Submit',array('class'=>'btn btn-primary bottom-30')) }}	
	{{ Form::close() }}
@stop