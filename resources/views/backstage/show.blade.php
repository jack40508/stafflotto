@extends('backstage/index')
@section('frag_itemlist')
	
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Backstage_show</title>
	</head>
	<body>
		@if($tag  == 'activity')

			<a href="/backstage/{{$tag}}/insert" class="btn btn-primary" role="button">新增</a>

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
								<td>@if($activity->status == '0')
										關閉
									@else
										開啟
									@endif
								<td>
								
								{!! Form::model($activities,['url' => '/backstage/' . $tag . "/" . $activity->id . "/delete", 'method' => 'PATCH'])!!}

								<a href="/backstage/{{$tag}}/{{ $activity->id }}/edit" class="btn btn-primary" role="button">編輯</a>
								{!! Form::submit('刪除',['class'=>'btn btn-primary']) !!}

								{!! Form::close() !!}
								</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif($tag  == 'award')
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
								<td>{{ $activities[$prize->activity_ID-1]->name }}</td>
								<td>{{ $prize->type }}</td>
								<td>{{ $prize->name }}</td>
								<td>
									@if($prize->level == '0')
										一般
									@else
										特殊
									@endif
								</td>
								<td>{{ $prize->amount }}</td>
								<td>@if($prize->status == '0')
										關閉
									@else
										開啟
									@endif</td>
								<td>
								{!! Form::model($activities,['url' => '/backstage/' . $tag . "/" . $prize->id . "/delete", 'method' => 'PATCH'])!!}

								<a href="/backstage/{{$tag}}/{{ $prize->id }}/edit" class="btn btn-primary" role="button">編輯</a>

								{!! Form::submit('刪除',['class'=>'btn btn-primary']) !!}

								{!! Form::close() !!}								
								</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif($tag  == 'staff')
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
								<td>{{ $activities[$staff->activity_ID-1]->name }}</td>
								<td>{{ $staff->staff_ID }}</td>
								<td>{{ $staff->activity_number }}</td>
								<td>{{ $staff->name }}</td>
								<td>
									@if($staff->level == '0')
										一般
									@else
										特殊
									@endif
								</td>
								<td>@if($staff->status == '0')
										未參與
									@else
										參與
									@endif
								</td>
								
								{!! Form::model($activities,['url' => '/backstage/' . $tag . "/" . $staff->id . "/delete", 'method' => 'PATCH'])!!}

								<td><a href="/backstage/{{$tag}}/{{ $staff->id }}/edit" class="btn btn-primary" role="button">編輯</a>

								{!! Form::submit('刪除',['class'=>'btn btn-primary']) !!}

								{!! Form::close() !!}				
								</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

			@elseif($tag  == 'winner')
			<table class="table table-striped">
				<thead>
			      	<tr>
				        <th>所屬活動</th>
				        <th>員工編號</th>
				        <th>活動號碼</th>
				        <th>員工姓名</th>
				        <th>獲得獎項</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				    @if(!empty($winners))
						@foreach($winners as $index => $winner)
							<tr>
								<td>
								@foreach($activities as $index => $activity)
									@if($activity->id == $winner->activity_ID)
									{{ $activity->name }}
								@endif
								@endforeach
								</td>
								<td>{{ $winner->staff_ID }}</td>
								<td>{{ $winner->activity_number }}</td>
								<td>{{ $winner->name }}</td>
								<td>
								@foreach($prizes as $index => $prize)
									@if($prize->id == $winner->prize_ID)
									{{ $prize->name }}
								@endif
								@endforeach
								</td>
								<td><a href="/backstage/{{$tag}}/{{ $winner->id }}/edit" class="btn btn-primary" role="button">編輯</a></td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>
		@endif
	</body>
	</html>
	
@stop