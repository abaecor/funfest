@extends('layouts.main')

@section('content')
<div class="container top25">
	<h3 class="section-title style2 text-center">
		<span>Address details</span>
	</h3>
	<div class='addinfo col-lg-3 col-md-12 col-sm-12 col-xs-12'>
		<h4>Base Address</h4>
		<span>
			{{ $base_address['0']['address'] }}
		</span>
	</div>

	@foreach($other_add as $k=>$v)
	<div class='addinfo col-lg-3 col-md-12 col-sm-12 col-xs-12'>
		<h4>Address {{ $k+1 }}</h4>
		<span>
			{{$v['address']}}
		</span>
	</div>
	@endforeach
</div>	
@stop