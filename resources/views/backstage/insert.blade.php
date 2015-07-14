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
								{!! Form::text('activity_name',"",['class' => 'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>活動狀態：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('activity_status',array('0' => '關', '1' => '開'),'0',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>
				</tbody>
			</table>

			
			{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}

		@elseif($tag == 'award')

			{!! Form::model($tag,['url' => '/backstage/' . $tag, 'method' => 'PATCH'])!!}

			<table class="table table-striped">
				<thead>
					<tr>
						<th><h2>新增獎項</h2></th>
						<th></th>
					</tr>
				</thead>
				   		
				<tbody>
					<tr>
						<td><h4>獎項名稱：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::text('award_name',"",['class' => 'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>


					<tr>
						<td><h4>獎項所屬活動：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('activity_id',$activities_name,'0',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>獎項狀態：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('award_status',array('0' => '關', '1' => '開'),'1',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>
				</tbody>
			</table>

			
			{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}

		@elseif($tag == 'prize')
			
			{!! Form::model($tag,['url' => '/backstage/' . $pretag . "/" . $precode . "/" . $tag, 'method' => 'PATCH'])!!}

			<table class="table table-striped">
				<thead>
					<tr>
						<th><h2>新增獎品</h2></th>
						<th></th>
					</tr>
				</thead>
				   		
				<tbody>
					<tr>
						<td><h4>獎品名稱：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::text('prize_name',"",['class' => 'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>獎品等級：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('prize_level',array('0' => '一般', '1' => '特殊'),'0',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>獎品數量：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::selectRange('prize_amount', 1, 100,'1',array('class'=>'form-control'))!!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>	

					<tr>
						<td><h4>獎品狀態：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('prize_status',array('0' => '關', '1' => '開'),'1',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>
				</tbody>
			</table>

			
			{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}		

		@elseif($tag == 'staff')
			
			{!! Form::model($tag,['url' => '/backstage/' . $tag, 'method' => 'PATCH'])!!}

			<table class="table table-striped">
				<thead>
					<tr>
						<th><h2>新增員工</h2></th>
						<th></th>
					</tr>
				</thead>
				   		
				<tbody>
					<tr>
						<td><h4>員工姓名：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::text('staff_name',"",['class' => 'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>員工編號：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::text('staff_number',"",['class' => 'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>活動號碼：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::text('staff_activity_number',"",['class' => 'form-control']) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>員工等級：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('staff_level',array('0' => '一般', '1' => '特殊'),'0',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>參加活動：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('activity_id',$activities_name,'0',array('class'=>'form-control')) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>

					<tr>
						<td><h4>參加狀態：</h4></td>
						<td>
							<div class="form-group">
								{!! Form::select('staff_status',array('0' => '未參加', '1' => '參加'),'1',array('class'=>'form-control')) !!}
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