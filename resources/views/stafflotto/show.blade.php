@extends('app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Stafflotto_show</title>
</head>
<body>
<div class="container">
	<div class="row">
		@foreach($prizes as $index => $prize)
		<div class="row">
	  		{{ $prize->name }}
	  	</div>
	  	@endforeach
	</div>
</div>
</body>
</html>

@stop