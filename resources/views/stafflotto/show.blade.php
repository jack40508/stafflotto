@extends('stafflotto/index')
@section('frag_prizelist')


<!DOCTYPE html>
<html lang="en">	
<head>
	<meta charset="UTF-8">
	<title>Stafflotto_show</title>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">

	<div class="col-md-6">
		<table class="table table-striped">
		    <caption>
			    <div class="row">
				    <div class="col-md-4">
						<h2>{!!$prize_now->prize_name!!}</h2>
					</div>
					
					<div class="col-md-4">
					</div>
					
					<div class="col-md-4">
						{!! Form::model($prize_now,['url' => '/stafflotto/' . $prize_now->id , 'method' => 'PATCH'])!!}
						{!! Form::submit('開始抽獎',['class'=>'btn btn-primary']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</caption>
		   	
		   	<thead>
		      	<tr>
			        <th>中獎號碼</th>
			        <th>員工編號</th>
			        <th>員工姓名</th>
		      	</tr>
		   	</thead>
	   		
	   		<tbody>
			   @if(!empty($winners))
					@foreach($winners as $index => $winner)
						<tr>
							<td>{{ $winner->staff_activity_number }}</td>
							<td>{{ $winner->staff_number }}</td>
							<td>{{ $winner->staff_name }}</td>
						</tr>
				 	@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
</body>
</html>
@stop