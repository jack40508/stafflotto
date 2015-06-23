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

	<div class="col-md-6">
		<table class="table table-striped">
		    <caption>
			    <div class="row">
				    <div class="col-md-4">
					    @foreach($nowprizes as $index => $nowprize)
							<h2>{!!$nowprize->name!!}</h2>
						@endforeach
					</div>
					
					<div class="col-md-4">
					</div>
					
					<div class="col-md-4">
						@foreach($nowprizes as $index => $nowprize)
							{!! Form::model($nowprize,['url' => '/stafflotto/' . $nowprize->name  , 'method' => 'PATCH'])!!}
							  	{!! Form::submit('開始抽獎',['class'=>'btn btn-primary']) !!}
							{!! Form::close() !!}
						@endforeach
					</div>
				</div>
			</caption>
		   	
		   	<thead>
		      	<tr>
			        <th>中獎號碼</th>
			        <th>中獎姓名</th>
		      	</tr>
		   	</thead>
	   		
	   		<tbody>
			   @if(!empty($winners))
					@foreach($winners as $index => $winner)
						<tr>
							<td>{{ $winner->code }}</td>
							<td>{{ $winner->name }}</td>
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