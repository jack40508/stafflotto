@extends('app_backstage')
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
		{!! Form::model($activities,['url' => '/backstage/' . $tag . "/" . $activities->id . '/update', 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>編輯</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				@if(!empty($activities))
				<tr>
					<td><h4>活動名稱：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('activity_name',$activities->activity_name,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>活動狀態：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('activity_status',array('0' => '關', '1' => '開'),$activities->activity_status,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endif
			</tbody>
		</table>

		
		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}

	@elseif($tag  == 'award')

		{!! Form::model($awards,['url' => '/backstage/' . $tag . "/" . $awards->id . '/update', 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>編輯</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				@if(!empty($awards))
				<tr>
					<td><h4>獎項名稱：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('award_name',$awards->award_name,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎項所屬活動：</h4></td>
					<td>				
						<div class="form-group">
							{!! Form::select('activity_id',$activities_name,$nowactivity,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				

				<tr>
					<td><h4>獎項狀態：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('award_status',array('0' => '關', '1' => '開'),$awards->award_status,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endif
			</tbody>
		</table>

		
		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}

	@elseif($tag == 'prize')

		{!! Form::model($prizes,['url' => '/backstage/' . $pretag . "/" . $prizes->award_id . "/" . $tag . "/" . $prizes->id . '/update', 'method' => 'PATCH'])!!}

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
							{!! Form::text('prize_name',$prizes->prize_name,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品所屬獎項：</h4></td>
					<td>				
						<div class="form-group">
							{!! Form::select('award_id',$awards_name,$nowaward,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品等級：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('prize_level',array('0' => '一般', '1' => '特殊'),$prizes->prize_level,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>獎品數量：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::selectRange('prize_amount', 1, 100,$prizes->prize_amount,array('class'=>'form-control'))!!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>				

				<tr>
					<td><h4>獎品狀態：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('prize_status',array('0' => '關', '1' => '開'),$prizes->prize_status,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endif
			</tbody>
		</table>

		
		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}


	@elseif($tag  == 'staff')
		{!! Form::model($staffs,['url' => '/backstage/' . $tag . "/" . $staffs->id . '/update', 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>編輯</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				@if(!empty($staffs))
				<tr>
					<td><h4>員工名稱：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('staff_name',$staffs->staff_name,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>員工編號：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('staff_number',$staffs->staff_number,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>活動編號：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('staff_activity_number',$staffs->staff_activity_number,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>員工等級：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('staff_level',array('0' => '一般', '1' => '特殊'),$staffs->staff_level,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>員工所屬活動：</h4></td>
					<td>				
						<div class="form-group">
							{!! Form::select('activity_id',$activities_name,$nowactivity,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
						
					</td>
				</tr>

				<tr>
					<td><h4>員工參與狀態：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::select('staff_status',array('0' => '未參與', '1' => '參與'),$staffs->staff_status,array('class'=>'form-control')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>備註：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('staff_remark',$staffs->staff_remark,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endif
			</tbody>
		</table>

		
		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}

	@elseif($tag  == 'winner')
	{!! Form::model($winners,['url' => '/backstage/' . $tag . "/" . $winners->id . '/update', 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>編輯</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				@if(!empty($winners))
				<tr>
					<td><h4>獲得獎項：</h4></td>
					<td>
						<div class="form-group">
							@if(!empty($prizes_name))
							{!! Form::select('prize_id',$prizes_name,$nowprize,array('class'=>'form-control')) !!}
							{!! Form::close() !!}

							@else
							該次活動查無獎品
							@endif
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>備註：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('staff_remark',$winners->staff_remark,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endif
			</tbody>
		</table>

		{!! Form::submit('確認',['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}

		@elseif($tag == 'user')
		{!! Form::model($users,['url' => '/backstage/' . $tag . "/" . $users->id . '/update', 'method' => 'PATCH'])!!}

		<table class="table table-striped">
			<thead>
				<tr>
					<th><h2>編輯</h2></th>
					<th></th>
				</tr>
			</thead>
			   		
			<tbody>
				@if(!empty($users))
				<tr>
					<td><h4>管理者姓名：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('name',$users->name,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>帳號：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('account',$users->account,['class' => 'form-control']) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>

				<tr>
					<td><h4>密碼：</h4></td>
					<td>
						<div class="form-group">
							{!! Form::text('password_original',$users->password_original,['class' => 'form-control']) !!}
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