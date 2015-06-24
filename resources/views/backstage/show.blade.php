@extends('backstage/index')
@section('frag_itemlist')
	
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Backstage_show</title>
	</head>
	<body>
		@if( $tag  == 'activity')
			<table class="table table-striped">
				<thead>
			      	<tr>
				        <th>活動名稱</th>
				        <th>活動創建時間</th>
				        <th>狀態</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				   @if(!empty($activities))
						@foreach($activities as $index => $activity)
							<tr>
								<td>{{ $activity->name }}</td>
								<td>{{ $activity->created_at }}</td>
								<td>{{ $activity->status }}</td>
								<td>編輯</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif( $tag  == 'award')
			<table class="table table-striped">
				<thead>
			      	<tr>
				        <th>所屬活動</th>
				        <th>獎項名稱</th>
				        <th>獎品名稱</th>
				        <th>獎品等級</th>
				        <th>獎品數量</th>
				        <th>狀態</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				   @if(!empty($prizes))
						@foreach($prizes as $index => $prize)
							<tr>
								<td>{{ $activities[0]->name }}</td>
								<td>{{ $prize->type }}</td>
								<td>{{ $prize->name }}</td>
								<td>
									@if($prize->level == 0)
										一般
									@else
										特殊
									@endif
								</td>
								<td>{{ $prize->amount }}</td>
								<td>{{ $prize->status }}</td>
								<td>編輯</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif( $tag  == 'staff')
			<table class="table table-striped">
				<thead>
			      	<tr>
				        <th>所屬活動</th>
				        <th>員工編號</th>
				        <th>活動號碼</th>
				        <th>員工姓名</th>
				        <th>員工等級</th>
				        <th>狀態</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				   @if(!empty($staffs))
						@foreach($staffs as $index => $staff)
							<tr>
								<td>{{ $activities[0]->name }}</td>
								<td>{{ $staff->staff_ID }}</td>
								<td>{{ $staff->activity_number }}</td>
								<td>{{ $staff->name }}</td>
								<td>
									@if($staff->level == 0)
										一般
									@else
										特殊
									@endif
								</td>
								<td>{{ $staff->status }}</td>
								<td>編輯</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>
		@endif
	</body>
	</html>
	
@stop