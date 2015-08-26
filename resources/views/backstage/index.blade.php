@extends('app_backstage')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Backstage_index</title>
</head>
<body>
	
	<div class="row">

		<div class="col-md-3"> 
			<div class="sidebar-nav"> 
			    <div class="well" style="width:200px; padding: 8px 0;"> 
			        <ul class="nav nav-list">  
			          
			        	<li class="nav-header">資料表管理</li>         
			          
			        	@if(!empty($tag))
				        	@if($tag == 'activity')
				          		<li><a href="/backstage/activity"><b><u>活動管理</u></b></a></li>
				        	@else
				         		<li><a href="/backstage/activity">活動管理</a></li>
				          	@endif
							
							@if($tag == 'award')
								<li><a href="/backstage/award"><b><u>獎項及獎品管理</u></b></a></li> 
							@else
								<li><a href="/backstage/award">獎項及獎品管理</a></li>
							@endif

							@if($tag == 'staff')
								<li><a href="/backstage/staff"><b><u>抽獎號碼管理</u></b></a></li> 
							@else
								<li><a href="/backstage/staff">抽獎號碼管理</u></b></a></li> 
							@endif

							@if($tag == 'winner')
								<li><a href="/backstage/winner"><b><u>中獎名單一覽表</u></b></a></li>
							@else
								<li><a href="/backstage/winner">中獎名單一覽表</a></li>
							@endif

							@if($tag == 'image')
								<li><a href="/backstage/image"><b><u>圖檔管理</u></b></a></li> 
							@else
								<li><a href="/backstage/image">圖檔管理</a></li> 
							@endif

							@if($tag == 'excel')
								<li><a href="/backstage/excel"><b><u>Excel管理</u></b></a></li>
							@else
								<li><a href="/backstage/excel">Excel管理</a></li>
							@endif

							@if($tag == 'user')
								<li><a href="/backstage/user"><b><u>使用者管理</u></b></a></li> 
							@else
								<li><a href="/backstage/user">使用者管理</a></li> 
							@endif

						@else
							<li><a href="/backstage/activity">活動管理</a></li>
							<li><a href="/backstage/award">獎項及獎品管理</a></li>
							<li><a href="/backstage/staff">抽獎號碼管理</u></b></a></li> 
							<li><a href="/backstage/winner">中獎名單一覽表</a></li>
							<li><a href="/backstage/image">圖檔管理</a></li> 
							<li><a href="/backstage/excel">Excel管理</a></li>
							<li><a href="/backstage/user">使用者管理</a></li> 
						@endif
			         
			           
			          

			        </ul>
			    </div> 
			</div>
		</div>

		<div class="col-md-8">  
			@yield('frag_itemlist')
		</div>


	</div>

</body>
</html>
@stop