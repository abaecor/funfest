@extends('layouts.main')

@section('content')
<script src="//x.s2d6.com/js/globalpixel.js?x=sp&h=10972&o={{ $purchase_data['txnid'] }}&g=transaction&s={{ $purchase_data['amount'] }}&q=1"></script>

<div class="col-sm-12">
	<h1 class="text-center special">Thank You For Your Purchase<br>
 	 <span style="font-size:18px; text-transform:lowercase"> If you  have any problems, queries, bugs, issues, requests or need any help then email me at <a href="mailto:care@Funfest.com">care@Funfest.com</a></span> </h1>
</div>

@stop