@extends('app')
@section('content')


<!DOCTYPE html>
<html lang="en">	
<head>
	<meta charset="UTF-8">
	<title>Backstage_edit</title>
</head>
<body>
<div class="container">
	
	@if($tag  == 'activity')
	
	@elseif($tag  == 'award')

		{!! Form::model($prizes,['url' => '/backstage/' . $tag . "/" . $prizes[0]->id, 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>編輯</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				@if(!empty($prizes))
				<tr>
					<td><h4>獎品名稱：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('name',$prizes[0]->name,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品獎項：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('type',$prizes[0]->type,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品所屬活動：</h4></td>
					<td>				
						<div class="form-group">
							{!! Form::select('activity_ID',array($activities_name),$prizes[0]->activity_ID,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
						
					</td>
				</tr>
				
				<tr>
					<td><h4>獎品等級：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('level',array('0' => '一般', '1' => '特殊'),$prizes[0]->level,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品數量：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('amount',$prizes[0]->amount,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品狀態：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('status',array('0' => '關', '1' => '開'),$prizes[0]->status,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endif
			</tbody>
		</table>

		
		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}
	@endif

	
</div>
</body>
</html>
@stop