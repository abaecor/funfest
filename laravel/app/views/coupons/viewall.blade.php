@extends('layouts.main')

@section('content')

<div id='viewall'>
	<h3 class="section-title style2 text-center">
		<span>View all Coupons</span>
	</h3>

	<div class="tab-content">
		<div class="tab-pane active" id="order">
			<table class='table table-striped'>
			<tr>
				<th>Unique ID</th>
				<th>No. of coupons</th>
				<th>Value</th>
				<th>Validity</th>
				<th>Type</th>
				<th>Status</th>
				<th>Associated with</th>
				<th>Edit/delete/download</th>
			</tr>
			@foreach ($coupons as $key => $value)
			<tr>
				<td>{{ $value->batchuniqid }}</td>
				@if($value->batchuniqid == null)
					<td>{{ $value->code }}</td>
				@else
					<td>{{ $value->total }}</td>	
				@endif
				<td>{{ $value->discount }}</td>
				<td>{{ $value->expiry }}</td>
				<td>
					{{ $value->type }}
				</td>
				<td>
					{{ $value->status }}
				</td>
				<td>
					<?php 
				 		echo $parent = ($value->parent_id == null) ? 'Generic' : $value->parent_id;
					?>
				</td>
				<td>
					@if($value->batchuniqid != $value->code)
						<span class='links'><a href="/coupons/edit?id={{ $value->batchuniqid }}&process=batch">Edit</a></span>
					@else
						<span class='links'><a href="/coupons/edit?id={{ $value->id }}&process=individual">Edit</a></span>
					@endif
					@if($value->batchuniqid != null)
						{{--<span class='links'><a href="/coupons/delete?id={{ $value->batchuniqid }}&process=batch">Delete</a></span> | --}}
					@else
						{{--<span class='links'><a href="/coupons/delete?id={{ $value->id }}&process=individual">Delete</a></span> | --}}
					@endif
					@if($value->batchuniqid != $value->code)
						|	<span class='links'><a href="/coupons/download?batchid={{ $value->batchuniqid }}">Excel download</a></span>
					@endif
				</td>
			</tr>	
			@endforeach
			</table>
		</div>
	</div>		

</div>		

@stop

@section('pagination')

	<section id='pagination'>
		{{ $coupons->links() }}
	</section> <!-- end pagination -->

@stop