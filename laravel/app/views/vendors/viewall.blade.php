@extends('layouts.main')

@section('content')
	
	<div id='admin'>
		<h3 class="section-title style2 text-center">
			<span>Vendor List</span>
		</h3>
			<div class="tab-content">
				<div class="tab-pane active" id="order">
					<table class='table table-striped'>
					<tr>
						<th>ID</th>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Username</th>
						<th>Address</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Edit/delete</th>
					</tr>
					@foreach ($vendors as $key => $value)
					<tr>
						<td>{{ $value->uniq_ven_id }}</td>
						<td>{{ $value->firstname }}</td>
						<td>{{ $value->lastname }}</td>
						<td>
							{{ $value->username }}
						</td>
						<td>
							{{ $value->address }}
						</td>
						<td>
							{{$value->email}}
						</td>
						<td>
							{{$value->phone}}
						</td>
						<th>
							<span class='links'><a href="/users/edit/{{ $value->id }}">Edit</a></span> | 
							<span class='links'><a href="/users/delete/{{ $value->id }}">Delete</a></span>  
						</th>
					</tr>	
					@endforeach
					</table>
				</div>
			</div>	
	</div>
@stop		
@section('pagination')
	{{ $vendors->links() }}
@stop