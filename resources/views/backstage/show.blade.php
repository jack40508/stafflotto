@extends('backstage/index')
@section('frag_itemlist') 

<script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').focus()
  });
  </script>
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Backstage_show</title>
</head>
<body>

	@if($tag  == 'activity')

		<div class="row">
			<div class="col-md-2">
				<a href="/backstage/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

<!--	//Button to trigger modal
		<a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-large">執行範例對話視窗</a>
			 
		//Modal
		<div id="myModal" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">對話視窗標題</h3>
            </div>
            <div class="modal-body">
                <h4>對話視窗中的文字</h4>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem.</p>

                <h4>對話視窗中的彈出視窗</h4>
                <p>This <a href="#" role="button" class="btn popover-test" title="" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="A Title">button</a> should trigger a popover on click.</p>

                <h4>對話視窗中的工具提示</h4>
                <p><a href="#" class="tooltip-test" title="" data-original-title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="" data-original-title="Tooltip">that link</a> should have tooltips on hover.</p>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">關閉</button>
                <button class="btn btn-primary">儲存變更</button>
            </div>
        </div>
-->
			
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
							
							<center>
							<a href="/backstage/{{$tag}}/{{ $activity->id }}/edit" class="btn btn-primary" role="button">編輯</a>
							<a class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$activity->id}}" >刪除</a>
							</center>
							
							</td>
						</tr>

						<!--Jquery+Boostrap Modal -->
				        <div class="modal fade" id="myModal{{$activity->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				            <div class="modal-dialog">
					            <div class="modal-content">
					                <div class="modal-header">
					            	    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        	        <h4 class="modal-title" id="myModalLabel">請輸入密碼</h4>
					                </div>
					                <div class="modal-body">
					                    {!! Form::model($activities,['url' => '/backstage/' . $tag . "/" . $activity->id . "/delete", 'method' => 'PATCH'])!!}
					                    <h4>此操作需要管理員權限，請輸入相關密碼：</h4>
						                {!! Form::password('password',['class' => 'form-control']) !!}
					                </div>
					                <div class="modal-footer">
					                    {!!Form::button('Close',['class'=>"btn btn-default",'data-dismiss'=>"modal"])!!}
					                    {!!Form::submit('Submit',['class'=>'btn btn-primary'])!!}
					                    {!!Form::close()!!}
					                </div>
					            </div>
				        	</div>
				    	</div>
				 	@endforeach
				@endif
			</tbody>
		</table>

	@elseif($tag  == 'award')

		<div class="row">
			<div class="col-md-2">
				<a href="/backstage/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

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
							<center>
							<a href="/backstage/{{$tag}}/{{ $award->id }}/edit" class="btn btn-primary" role="button">編輯</a>
								{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}
								<a href="/backstage/{{$tag}}/{{ $award->id }}/prize" class="btn btn-info" role="button">獎品內容</a>
							</center>
							{!! Form::close() !!}								
						
							</td>
						</tr>
				 	@endforeach
				@endif
			</tbody>
		</table>

	@elseif($tag  == 'prize')
		
		<div class="row">
			<div class="col-md-2">
				<a href="/backstage/{{$pretag}}/{{$precode}}/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

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
							<center>
							{!! Form::model($prize,['url' => '/backstage/' . $pretag . "/" . $prize->award_id . "/" . $tag . "/" . $prize->id . "/delete", 'method' => 'PATCH'])!!}

							<a href="/backstage/{{$pretag}}/{{$precode}}/{{$tag}}/{{ $prize->id }}/edit" class="btn btn-primary" role="button">編輯</a>
								{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}
							</center>
							{!! Form::close() !!}
															
							</td>
						</tr>
				 	@endforeach
				@endif
			</tbody>
		</table>

	@elseif($tag  == 'staff')
		
		<div class="row">
			<div class="col-md-2">
				<a href="/backstage/{{$tag}}/insert" class="btn btn-success" role="button">新增</a>
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

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
							
							<td>
							{!! Form::model($staffs,['url' => '/backstage/' . $tag . "/" . $staff->id . "/delete", 'method' => 'PATCH'])!!}
							<center>
							<a href="/backstage/{{$tag}}/{{ $staff->id }}/edit" class="btn btn-primary" role="button">編輯</a>

							{!! Form::submit('刪除',['class'=>'btn btn-danger']) !!}
							</center>
							{!! Form::close() !!}
										
							</td>
						</tr>
				 	@endforeach
				@endif
			</tbody>
		</table>

	@elseif($tag  == 'winner')
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

		<table class="table table-striped">
			<thead>
		      	<tr>
			        <th>所屬活動</th>
			        <th>員工編號</th>
			        <th>活動號碼</th>
			        <th>員工姓名</th>
			        <th>獲得獎項</th>
			        <th>獲獎輪次</th>
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
							<td>第{{ $winner->staff_round }}輪</td>
							<td>{{ $winner->staff_remark }}</td>
							<td><center><a href="/backstage/{{$tag}}/{{ $winner->id }}/edit" class="btn btn-primary" role="button">編輯</a><center></td>
						</tr>
				 	@endforeach
				@endif
			</tbody>
		</table>

	@elseif($tag  == 'user')
		
		<div class="row">
			<div class="col-md-2">				
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

		<table class="table table-striped">
			<thead>
		      	<tr>
			        <th>名稱</th>
			        <th>帳號</th>
			        <th>密碼</th>
			        <th></th>
		      	</tr>
		   	</thead>
	   		
	   		<tbody>
			    @if(!empty($users))
					<tr>
						<td>{{ $users->name }}</td>
						<td>{{ $users->account }}</td>
						<td>{{ $users->password_original }}</td>
						<td>
						<center><a href="/backstage/{{$tag}}/{{ $users->id }}/edit" class="btn btn-primary" role="button">編輯</a></center>
						</td>
					</tr>
					@endif
			</tbody>
		</table>

	@elseif($tag == 'excel')
	
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

		{!! Form::model($tag,['url' => '/backstage/excelimport', 'method' => 'POST','files' => true])!!}
		<div class="row">
		<h3>選擇檔案：</h3>

			<div class="col-md-5">
				{!! Form::file('excel_filepath',[]) !!}
			</div>
			<div class="col-md-4">
				{!! Form::submit('匯入Excel',['class'=>'btn btn-primary']) !!}
				<a href="/backstage/{{$tag}}/exceldownload" class="btn btn-primary" role="button">下載範例</a>
			</div>
		</div>
		{!! Form::close() !!}

		{!! Form::model($tag,['url' => '/backstage/excelexport', 'method' => 'PATCH'])!!}
		<div class="row">
		<h3>選擇活動：</h3>

		<div class="row">
			<div class="col-md-5">
				{!! Form::select('activity_id',$activities_name,0,array('class'=>'form-control')) !!}
			</div>
			<div class="col-md-2">
				{!! Form::submit('匯出Excel',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
		{!! Form::close() !!}

	@elseif($tag == 'image')

		<div class="row">
			<div class="col-md-2">	
			</div>
			<div class="col-md-8">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
					    {{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>

		{!! Form::model($tag,['url' => '/backstage/imageupload', 'method' => 'POST', 'files' => true])!!}
		<div class="row">
		<h3>選擇檔案(僅能上傳jpg、png、bmp)：</h3>

			<div class="col-md-5">
				{!! Form::file('image_filepath',[]) !!}
			</div>
			<div class="col-md-2">
				{!! Form::submit('上傳圖片',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
		{!! Form::close() !!}

		<table class="table table-striped">
			<thead>
		      	<tr>
			        <th>圖片縮圖</th>
			        <th>圖片名稱</th>
			        <th>目前用於</th>
			        <th></th>
		      	</tr>
		   	</thead>
		   		
		   	<tbody>
				@if(!empty($pictures))
					@foreach($pictures as $index => $picture)
						<tr>
							<td><img src="/../uploads/image/{{$picture->picture_name}}" class="img-responsive" alt="Responsive image" style= width:200px;height:50px></td>
							<td>{{ $picture->picture_originalname }}</td>
							@if($picture->usingfor == -1)
							<td>未使用</td>
							@elseif($picture->usingfor == 0)
							<td>背景</td>
							@else
							<td>{{ $picture->activity_name }}</td>
							@endif
							<td><center><a href="/backstage/{{$tag}}/{{ $picture->id }}/edit" class="btn btn-primary" role="button">編輯</a></Senter></td>
						</tr>
						
				 	@endforeach
				@endif
			</tbody>
		</table>

	@endif
</body>
	</html>
	
@stop