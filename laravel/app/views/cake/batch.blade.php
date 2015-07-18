@extends('layouts.main')

@section('content')
<h2>
Batch Upload 
</h2>
<div class="batch_class">
	{{Form::open(array('url'=>'/cake/batch','files'=>true))}}
	{{Form::label('exel_file','Upload a file')}}
	{{Form::file('excel_file',array('class'=>'btn btn-primary'))}}
	<br/>
	{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
	{{ Form::close() }}
</div>
<div class="batch_class">
	{{Form::open(array('url'=>'/cake/imagebatchup','files'=>true))}}
	{{Form::label('imgs','Upload images for batch upload')}}
	{{Form::file('imgs[]',array('class'=>'btn btn-primary','multiple'=>true))}}
	<br/>
	{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
	{{ Form::close() }}
</div>

@stop