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

			<a href="/backstage/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>

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
								<td>{{ $activity->activity_name }}</td>
								<td>{{ $activity->created_at }}</td>
								<td>@if($activity->activity_status == '0')
										關閉
									@else
										開啟
									@endif
								<td>
								
								{!! Form::model($activities,['url' => '/backstage/' . $tag . "/" . $activity->id . "/delete", 'method' => 'PATCH'])!!}

								<a href="/backstage/{{$tag}}/{{ $activity->id }}/edit" class="btn btn-primary" role="button">編輯</a>
								{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}

								{!! Form::close() !!}
								</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif($tag  == 'award')

			<a href="/backstage/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>

			<table class="table table-striped">
				<thead>
			      	<tr>
				        <th>所屬活動</th>
				        <th>獎項名稱</th>
				        <th>狀態</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				    @if(!empty($awards))
						@foreach($awards as $index => $award)
							<tr>
								<td>{{ $award->activity_name }}</td>
								<td>{{ $award->award_name }}</td>

								<td>@if($award->award_status == '0')
										關閉
									@else
										開啟
									@endif</td>
								<td>
								{!! Form::model($awards,['url' => '/backstage/' . $tag . "/" . $award->id . "/delete", 'method' => 'PATCH'])!!}

								<a href="/backstage/{{$tag}}/{{ $award->id }}/edit" class="btn btn-primary" role="button">編輯</a>

								{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}

								<a href="/backstage/{{$tag}}/{{ $award->id }}/prize" class="btn btn-info" role="button">獎品內容</a>

								{!! Form::close() !!}								
								</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif($tag  == 'prize')
			
			<a href="/backstage/{{$pretag}}/{{$precode}}/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>

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
								<td>{{$prize->activity_name}}</td>
								<td>{{ $prize->award_name }}</td>
								<td>{{ $prize->prize_name }}</td>
								<td>
									@if($prize->prize_level == '0')
										一般
									@else
										特殊
									@endif
								</td>
								<td>{{ $prize->prize_amount }}</td>
								<td>@if($prize->prize_status == '0')
										關閉
									@else
										開啟
									@endif</td>
								<td>
								{!! Form::model($prize,['url' => '/backstage/' . $pretag . "/" . $prize->award_id . "/" . $tag . "/" . $prize->id . "/delete", 'method' => 'PATCH'])!!}

								<a href="/backstage/{{$pretag}}/{{$precode}}/{{$tag}}/{{ $prize->id }}/edit" class="btn btn-primary" role="button">編輯</a>

								{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}

								{!! Form::close() !!}								
								</td>
							</tr>
					 	@endforeach
					@endif
				</tbody>
			</table>

		@elseif($tag  == 'staff')
			
			<a href="/backstage/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>

			<table class="table table-striped">
				<thead>
			      	<tr>
				        <th>所屬活動</th>
				        <th>員工編號</th>
				        <th>活動號碼</th>
				        <th>員工姓名</th>
				        <th>員工等級</th>
				        <th>狀態</th>
				        <th>備註</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				    @if(!empty($staffs))
						@foreach($staffs as $index => $staff)
							<tr>
								<td>{{ $staff->activity_name }}</td>
								<td>{{ $staff->staff_number }}</td>
								<td>{{ $staff->staff_activity_number }}</td>
								<td>{{ $staff->staff_name }}</td>
								<td>
									@if($staff->staff_level == '0')
										一般
									@else
										特殊
									@endif
								</td>
								<td>@if($staff->staff_status == '0')
										未參與
									@else
										參與
									@endif
								</td>
								<td>{{ $staff->staff_remark }}</td>
								
								{!! Form::model($staffs,['url' => '/backstage/' . $tag . "/" . $staff->id . "/delete", 'method' => 'PATCH'])!!}

								<td><a href="/backstage/{{$tag}}/{{ $staff->id }}/edit" class="btn btn-primary" role="button">編輯</a>

								{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}

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
				        <th>備註</th>
				        <th></th>
			      	</tr>
			   	</thead>
		   		
		   		<tbody>
				    @if(!empty($winners))
						@foreach($winners as $index => $winner)
							<tr>
								<td>{{ $winner->activity_name}}</td>
								<td>{{ $winner->staff_number }}</td>
								<td>{{ $winner->staff_activity_number }}</td>
								<td>{{ $winner->staff_name }}</td>
								<td>{{ $winner->prize_name }}</td>
								<td>{{ $winner->staff_remark }}</td>
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