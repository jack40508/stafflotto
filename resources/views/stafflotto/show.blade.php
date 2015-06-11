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
	  <div class="col-md-4">目前抽的獎項
	</div>
	  <!--<div class="col-md-4">目前抽取的獎項</div>-->
	</div>

	<div class="row">
	  <div class="col-md-1">得獎編號1</div>
	  <div class="col-md-1">得獎編號2</div>
	  <div class="col-md-1">得獎編號3</div>
	  <div class="col-md-1">得獎編號4</div>
	  <div class="col-md-1">得獎編號5</div>
	  <div class="col-md-1">得獎編號6</div>


	</div>
	<div class="row">
	  <div class="col-md-7">

	  </div>
	  <div class="col-md-5"> 
	  	
		@foreach($nowprizes as $index => $nowprize)
			{!! Form::model($nowprize,['url' => '/stafflotto/' . $nowprize->name  , 'method' => 'PATCH'])  !!}
	  		<div class="row">
		  			{!! Form::submit($nowprize->name,['class'=>'btn btn-primary']) !!}
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