@extends('app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Backstage_index</title>
</head>
<body>
<div class="container">
	
	@if($tag  == 'activity')
		{!! Form::model($tag,['url' => '/backstage/' . $tag, 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>新建活動</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				<tr>
					<td><h4>活動名稱：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('name',"",['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>活動狀態：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('status',array('0' => '關', '1' => '開'),array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		
		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}
	@endif

</div>
</body>
</html>
@stop