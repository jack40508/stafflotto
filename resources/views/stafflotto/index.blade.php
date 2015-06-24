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
	  <div class="col-md-8"style="font-family: 'Indie Flower', cursive;"><h1>The Activity Name</h1></div>
	</div>

	<div class="row">
	  <div class="col-md-4"><h2>廠商logo</h2></div>
	</div>

	<div class="row">
	
		<div class="col-md-8">  
			@yield('frag_prizelist')
		</div>

	  	<div class="col-md-4">
	  		@foreach($prizes_type as $index => $prize_type)			
				<div class="row">
					<div class="btn-group">
						<button type="button" class="btn btn-primary btn-block" style="width: 150px; margin-top:5px;">{{ $prize_type->type }}</button>
						<button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-expanded="false" style="margin-top:5px">
					    <span class="caret"></span>
					    <span class="sr-only">Toggle Dropdown</span>
					  	</button>
					  	
					  <ul class="dropdown-menu" role="menu">
					  	@foreach($prizes as $index => $prize)
							@if($prize->type == $prize_type->type)
								<li><a href="/stafflotto/{{ $prize->prize_ID }}">{{ $prize->name }}　　　　　{{ $prize->amount }}</a></li>
								<li class="divider"></li>
							@endif
						@endforeach
					  </ul>
				  	</div>
				</div>  		
			@endforeach
	  	</div>
	</div>
</div>
</body>
</html>
@stop
