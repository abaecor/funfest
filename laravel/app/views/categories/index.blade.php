@extends('layouts.main')

@section('content')

	<div id='admin'>
		
		<h3 class="section-title style2 text-center">
			<span>Categories</span>
		</h3>

		<ul>
			@foreach($categories as $category)
				<li>	
					{{ $category->name }} - 
					{{ Form::open(array('url'=>'admin/categories/destroy','class'=>'link')) }}
					{{ Form::hidden('id', $category->id) }}
					{{ Form::submit('delete',array('class'=>'btn')) }}
					{{ Form::close() }}
				</li>
			@endforeach
		</ul>

		<h1>Create new category</h1><hr>

			@if($errors->has())
				<div>
					<p>The following errors has occured:</p>
					<ul>
						@foreach($errors->all() as $err)
							<li>{{ $err }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{{ Form::open(array('url'=>'admin/categories/create')) }}
			<p>
				{{ Form::label('name') }}
				{{ Form::text('name') }}
			</p>
			{{ Form::submit('Submit',array('class'=>'btn')) }}
			{{ Form::close() }}

	</div>

@stop