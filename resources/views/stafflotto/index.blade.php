@extends('app')
@section('content')


<!DOCTYPE html>
<html lang="en">	
<head>
	<meta charset="UTF-8">
	<title>Stafflotto_index</title>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
	<div class="row">
	  <div class="col-md-8"style="font-family: 'Indie Flower', cursive;">The Activity Name</div>
	</div>

	<div class="row">
	  <div class="col-md-4">廠商logo</div>
	</div>

	<div class="row">
	
	<div class="col-md-9">  
		@yield('frag_prizelist')
	</div>
	  	<div class="col-md-3">
	  		@foreach($prizes_type as $index => $prize_type)			
				<div class="btn-group">
					<button type="button" class="btn btn-primary">{{ $prize_type->type }}</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  	</button>
				  <ul class="dropdown-menu" role="menu">
				  	@foreach($prizes as $index => $prize)
						@if($prize->type == $prize_type->type)
							<li><a href="/stafflotto/{{ $prize->name }}">{{ $prize->name }}　　　{{ $prize->amount }}</a></li>
							<li class="divider"></li>
						@endif
					@endforeach
				  </ul>
				</div>  		
			@endforeach
	  	</div>
	</div>


	</div>
</body>
</html>
@stop
