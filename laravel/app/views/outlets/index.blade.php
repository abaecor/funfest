@extends('layouts.main')

@section('content')
	<div>
	@if(count($outlets) > 0)
	<h3 class="section-title style2 text-center">
		<span>Current Outlets Info</span>
	</h3>
	 <table class='table table-striped'>
	 		<col width="5%">
			<col width="35%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
			<col width="30%">
		 	<tr>
		 		<th>#</th>
		 		<th>Outlet Address</th>
		 		<th>City</th>
		 		<th>Pincode</th>
		 		<th>Phone</th>
		 		<th>Delivery Option</th>
		 	</tr>
		 	@foreach ($outlets as $k=>$outlet)
				<tr>
					<td>{{$k+1}}</td>
					<td>{{ $outlet->address1 }}<br/>{{ $outlet->address2 }}</td>
					<td>{{ $outlet->city }}</td>
					<td>{{ $outlet->pincode }}</td>
					<td>{{ $outlet->phone }}</td>
					<td>{{ $outlet->delivery_options }}</td>
				</tr>	
			@endforeach
	</table>
	@endif
	</div>

	<div>
		<h3 class="section-title style2 text-center">
			<span>Add new outlet</span>
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
		{{ Form::open(array('url'=>'admin/outlets/addoutlets')) }}
			<p>
				{{ Form::label('address1','Address 1') }}
				{{ Form::text('address1','',array('class'=>'form-control input-md')) }}
				{{ Form::hidden('user_id',$user_id) }}
			</p>
			<p>
				{{ Form::label('address2','Address 2') }}
				{{ Form::text('address2','',array('class'=>'form-control input-md')) }}
			</p>

			<p>
				{{ Form::label('city','City') }}
				{{ Form::text('city','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('pincode','Pincode') }}
				{{ Form::text('pincode','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('phone','Phone') }}
				{{ Form::text('phone','',array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('delivery_options[]','Delivery Options') }}
				{{ Form::select('delivery_options[]', array('midnight delivery'=>'midnight delivery','early morning delivery'=>'early morning delivery','special delivery options'=>'special delivery options'), array('midnight delivery'),array('multiple','class'=>'form-control input-md')) }}
				<br/> ctrl+click for multi select
			</p>
			{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
			{{ Form::close() }}	
	</div>
@stop