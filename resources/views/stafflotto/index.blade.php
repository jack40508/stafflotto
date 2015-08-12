@extends('app')
@section('content')


<!DOCTYPE html>
<html lang="en">	
<head>
	<meta charset="UTF-8">
	<title>Stafflotto_index</title>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
</head>
<!--<body style="background: url(http://subtlepatterns.com/patterns/stardust.png);">-->
@if(empty($tag) && !empty($background))
<body style="background: url(/uploads/image/{{ $background->picture_name }});">
@elseif(!empty($tag) && !empty($background))
<body style="background: url(/../uploads/image/{{ $background->picture_name }});">
@else
<body style="background: url(http://subtlepatterns.com/patterns/stardust.png);">
@endif

@if(!empty($activities))
	<div class="container">
		<div class="row">
			@if(empty($tag) && !empty($pictures))
			<img src="/uploads/image/{{ $pictures->picture_name }}" class="img-responsive" alt="Responsive image" width="100%">
			@elseif(!empty($tag) && !empty($pictures))
			<img src="/../uploads/image/{{ $pictures->picture_name }}" class="img-responsive" alt="Responsive image">
			@else
			<div class="col-md-8"style="font-family: 'Indie Flower', cursive;"><h1>{{ $activities->activity_name }}</h1>
			@endif
		</div>	
	
		<div class="row">
		
			<div class="col-md-9">  
				@yield('frag_prizelist')
			</div>

		  	<div class="col-md-3">
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
@endif

</body>
</html>
@stop
