@extends('stafflotto/index')
@section('frag_prizelist')


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
	  <div class="col-md-4">
	@foreach($nowprizes as $index => $nowprize)
	  {!!$nowprize->name!!}
	  @endforeach
	</div>
	  <!--<div class="col-md-4">目前抽取的獎項</div>-->
	</div>

	<div class="row">

	  	@if(!empty($winners))
			@foreach($winners as $index => $winner)
			{{ $winner->name }}
	 		@endforeach
	 	@endif

	</div>
	<div class="row">
	  <div class="col-md-7">

	  </div>
	  <div class="col-md-5"> 
	  	
		@foreach($nowprizes as $index => $nowprize)
			{!! Form::model($nowprize,['url' => '/stafflotto/' . $nowprize->name  , 'method' => 'PATCH'])  !!}
	  		<div class="row">
		  			{!! Form::submit('開始抽獎',['class'=>'btn btn-primary']) !!}
		  		</div>
		  	{!! Form::close() !!}
	  	@endforeach
			<!--{!! Form::model($nowprize,['url' => 'stafflotto/' . $nowprize->name  , 'method' => 'PATCH'])  !!}
	  		<div class="row">
		  			{!! Form::submit($nowprize->name,['class'=>'btn btn-primary']) !!}
		  		</div>
		  	{!! Form::close() !!}-->
	  	
	  	
	  </div>
	</div>
</div>
</body>
</html>
@stop