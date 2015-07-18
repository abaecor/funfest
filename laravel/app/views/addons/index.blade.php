@extends('layouts.main')

@section('content')


<h3 class="section-title style2 text-center">
	<span>Create Addons</span>
</h3>
	@if($errors->has())
		<div>
			<p>The following errors has occured:</p>
			<ul>
				@foreach ($errors->all() as $err)
					<li class='alert-danger'>{{ $err }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div>
			{{ Form::open(array('url'=>'admin/addons/create','files'=>true)) }}
			<p>
				{{ Form::label('type','Type') }}
				{{ Form::select('type',array('card'=>'Card','cake'=>'Cake','baloons'=>'Baloons','combo'=>'Combo','chocolates'=>'Chocolates'),'',array('class'=>'form-control input-md')) }}
				{{ Form::hidden('vendor_id',$user_id) }}
			</p>
			<p>
				{{ Form::label('description') }}
				{{ Form::text('description','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('image','Choose a file') }}
				{{ Form::file('image',array('class'=>'btn btn-primary')) }}
			</p>
			<p>
				{{ Form::label('price','Price') }}
				{{ Form::text('price','',array('class'=>'form-control input-md')) }}
			</p>
			{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
			{{ Form::close() }}
	</div>

@stop