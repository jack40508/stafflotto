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

		<div class="col-md-2"> 
			<div class="sidebar-nav"> 
			    <div class="well" style="width:200px; padding: 8px 0;"> 
			        <ul class="nav nav-list">  
			          
			          <li class="nav-header">資料表管理</li>         
			          <li><a href="/backstage/activity">活動管理</a></li> 
			          <li><a href="/backstage/award">獎項及獎品管理</a></li> 
			          <li><a href="/backstage/staff">抽獎號碼管理</a></li> 
			          <li><a href="/backstage/winner">中獎名單一覽表</a></li> 
			          <li><a href="#">網站管理</a></li> 
			          <li><a href="/backstage/image">圖檔管理</a></li> 
			          <li><a href="/backstage/excel">Excel管理</a></li> 
			          <li><a href="/backstage/user">使用者管理</a></li> 

			        </ul>
			    </div> 
			</div>
		</div>

		<div class="col-md-8">  
			@yield('frag_itemlist')
		</div>

		<div class="col-md-2"> 
			
		</div>

	</div>

</body>
</html>
@stop