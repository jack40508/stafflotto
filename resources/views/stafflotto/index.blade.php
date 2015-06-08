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
	  <div class="col-md-8"style="font-family: 'Indie Flower', cursive;">I'm title</div>
	  <div class="col-md-4">!!目前獎項!!
	</div>
	  <!--<div class="col-md-4">目前抽取的獎項</div>-->
	</div>

	<div class="row">
	  <div class="col-md-6">廠商logo</div>
	  <div class="col-md-1">得獎編號1</div>
	  <div class="col-md-1">得獎編號2</div>
	  <div class="col-md-1">得獎編號3</div>
	  <div class="col-md-1">得獎編號4</div>
	  <div class="col-md-1">得獎編號5</div>
	  <div class="col-md-1">得獎編號6</div>

	</div>
	<!--<input type="Button" name="名稱" value="顯示值" onClick="事件處理程序">-->

	<div class="row">
	  <div class="col-md-11">
	  	
		@if(!empty($prizes_of_type))
	  		@foreach($prizes_of_type as $index => $prize_of_type)
			
				<div class="row">
			  		{{ $prize_of_type->name }}
			  	</div>
			 
	  		@endforeach
	  	@endif
	  </div>
	  	<div class="col-md-1">
			
			@foreach($prizes_type as $index => $prize_type)
			<!--{!! Form::model($prize_type,['url' => 'stafflotto/' . $prize_type->type, 'methad' => 'PATCH'])  !!}!-->
			{!! Form::model($prize_type,['url' => 'stafflotto/' . $prize_type->type  , 'method' => 'PATCH'])  !!}
		  		<div class="row">
		  			<!--{{ $prize_type->type }}!-->
		  			{!! Form::submit($prize_type->type,['class'=>'btn btn-primary']) !!}
		  		</div>
		  	{!! Form::close() !!}
	  		@endforeach
	  	
	  </div>
	</div>

	<div class="row">
	  <div class="col-md-11">
	  </div>
	  <div class="col-md-1">
	  
	  	{!! Form::open() !!}
	  	{!! Form::submit('submit1',['class'=>'btn btn-primary', 'id'=>'btn_startlottery']) !!}
	  	<!--<button type="submit" class="btn btn-primary">開始抽獎</button>!-->
	  	{!! Form::close() !!}


	  <!--<button type="submit" class="btn btn-primary">開始抽獎</button>!-->
	  </div>
	</div>
	</div>
</body>
</html>
@stop
