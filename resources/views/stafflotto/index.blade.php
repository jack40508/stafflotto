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
	  <div class="col-md-8"style="font-family: 'Indie Flower', cursive;"><h1>{{ $activities->activity_name }}</h1></div>
	</div>

	<div class="row">
	  <div class="col-md-4"><h2>廠商logo</h2></div>
	</div>

	<div class="row">
	
		<div class="col-md-8">  
			@yield('frag_prizelist')
		</div>

	  	<div class="col-md-4">
	  		@foreach($awards as $index => $award)			
				<div class="row">
					<div class="btn-group">
						<button type="button" class="btn btn-primary btn-block" style="width: 200px; margin-top:5px;">{{ $award->award_name }}</button>
						<button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-expanded="false" style="margin-top:5px">
					    <span class="caret"></span>
					    <span class="sr-only">Toggle Dropdown</span>
					  	</button>
					  	
					  <ul class="dropdown-menu" role="menu" style="width: 200px">
					  	@foreach($prizes as $index => $prize)
							@if($prize->award_id == $award->id)
								<li>
									<a href="/stafflotto/{{ $prize->id }}">
										<div class="row">
											<div class="col-md-8">
												{{ $prize->prize_name }}
											</div>
											<div class="col-md-4">
												{{ $prize->prize_amount }}
											</div>
										</div>
									</a>
								</li>
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
