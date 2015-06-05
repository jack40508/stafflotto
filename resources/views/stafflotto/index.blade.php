@extends('app')
@section('content')

<!DOCTYPE html>
<html lang="en">	
<head>
	<meta charset="UTF-8">
	<title>Stafflotto_index</title>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="row">
	  <div class="col-md-8"style="font-family: 'Indie Flower', cursive;">I'm title</div>
	  <div class="col-md-4">
	  <!--
	  <?php foreach ($staff_name as $staff_names) : ?>
	  	<?= $staff_names; ?>
	  <?php endforeach ?>-->

	  @foreach($staff_name as $index => $staff_names)
	  	<div class="row">
	  		<a href="stafflotto/{{ $index }}">{{ $staff_names }}</a>
	  	</div>
	  @endforeach
	  </div>
	  <!--<div class="col-md-4">目前抽取的獎項</div>-->
	</div>

	<div class="row">
	  <div class="col-md-6">廠商logo</div>
	  <div class="col-md-1">得獎編號1</div>
	  <div class="col-md-1">得獎編號2</div>
	  <div class="col-md-1">得獎編號3</div>
	  <div class="col-md-1">得獎編號4</div>
	  <div class="col-md-1">得獎編號5</div>
	  <div class="col-md-1">得獎編號6</div>

	</div>
	
	<!--<input type="Button" name="名稱" value="顯示值" onClick="事件處理程序">-->

	<div class="row">
	  <div class="col-md-11">
	  	得獎名單
	  </div>
	  <div class="col-md-1">
	  <a href="home"><button type="button" class="btn btn-primary">開始抽獎</button></a>	
	  </div>
	</div>

</body>
</html>

@stop