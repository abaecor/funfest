@extends('layouts.main')

@section('content')

	<div id='admin' class='filter_product'>
		<h3 class="section-title style2 text-center">
			<span>Create new product</span>
		</h3>


			@if($errors->has())
				<div>
					<p>The following errors has occured:</p>
					<ul>
						@foreach ($errors->all() as $err)
							<li>{{ $err }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{{ Form::open(array('url'=>'admin/products/create','files'=>true)) }}
			<p>
				{{ Form::label('category_id','Category') }}
				{{ Form::select('category_id',$categories,'',array('class'=>'form-control input-md')) }}
				{{ Form::hidden('vendor_id',$user_id) }}
			</p>
			<p>
				{{ Form::label('title') }}
				{{ Form::text('title','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('','The product you are trying to add already exists. Please add it as a secondary vendor. However, this will not effect your rating/product selling.',array('class'=>'msg-al')) }}<br/>
				{{ Form::label('exists','Add as secondary vendor',array('class'=>'msg-al')) }}
				{{ Form::checkbox('exists') }}
				{{ Form::hidden('prod_id','',array('id'=>'prod_id')) }}
			</p>
			<p>
				{{ Form::label('description') }}
				{{ Form::textarea('description','',array('class'=>'form-control input-md')) }}
			</p>
			<p class='img_upload'>
				{{ Form::label('image','Choose a file') }}
				{{ Form::file('image',array('class'=>'btn btn-primary')) }}
			</p>
			<p>
				{{ Form::label('Regular price') }}
				{{ Form::text('regular_price','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Delux price') }}
				{{ Form::text('delux_price','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('Premium price') }}
				{{ Form::text('premium_price','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('City') }}
				{{ Form::text('city','',array('class'=>'form-control input-md')) }}
			</p>
			{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
			{{ Form::close() }}
			<hr/>
			@if(Session::get('user_status') == 'super')
			<h2><br/>OR<br/>
			Batch Upload 
			</h2>
			<div class="batch_class">
				{{Form::open(array('url'=>'admin/products/batchup','files'=>true))}}
				{{Form::label('exel_file','Upload a file')}}
				{{Form::file('excel_file',array('class'=>'btn btn-primary'))}}
				<br/>
				{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
			<div class="batch_class">
				{{Form::open(array('url'=>'admin/products/imagebatchup','files'=>true))}}
				{{Form::label('imgs','Upload images for batch upload')}}
				{{Form::file('imgs[]',array('class'=>'btn btn-primary','multiple'=>true))}}
				<br/>
				{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
			@endif
	</div>

@stop