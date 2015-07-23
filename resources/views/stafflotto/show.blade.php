@extends('stafflotto/index')
@section('frag_prizelist')


<!DOCTYPE html>
<html lang="en">	
<head>
	<meta charset="UTF-8">
	<title>Stafflotto_show</title>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>

	<style type="text/css">
    /*#animate_slidein {
      -moz-animation-duration: 5s;
      -webkit-animation-duration: 5s;
      -webkit-animation-delay: 2s;
      animation-name: slidein;
      -moz-animation-name: slidein;
      -webkit-animation-name: slidein;
      animation-iteration-count: infinite;重複
    }
    
    @keyframes slidein{
    	from {
	        margin-left:50%;
	        width:300%
	    }
	      
	    75% {
	        font-size:300%;
	        margin-left:25%;
	        width:150%;
	    }
	      
	    to {
	        margin-left:0%;
	        width:100%;
	    }
	}

    @-moz-keyframes slidein {
    	from {
    		margin-left:50%;
        	width:300%
      	}
      
	    5% {
	        font-size:300%;
	        margin-left:25%;
	        width:150%;
	    }
	      
	    to {
	        margin-left:0%;
	        width:100%;
	    }
    }
    
    @-webkit-keyframes slidein {
	    from {
	        margin-left:50%;
	        width:300%
	    }
	      
	    75% {
	        font-size:300%;
	        margin-left:25%;
	        width:150%;
	    }
	      
	    to {
	        margin-left:0%;
	        width:100%;
	    }
    }*/

    #slideshow{
    	opacity: 0;
    	-webkit-transition:opacity 1.0s linear 0s;
    	-moz-transition:opacity 1.0s linear 0s;
    	transition:opacity 1.0s linear 0s;
    }
  	</style>

  	<script>
		var ss_i = 0;	//做多少毫秒(*30+15)
		var ss_j = 0;	//記錄抽了幾次，抽到第幾個
		var ss_k = 0;	//計算該顯示的數字
		var ss_array = ["1","2","3","4","5","6","7","8","9","0"];
		var ss_elem1,ss_elem2,ss_elem3,ss_elem4,ss_elem5,ss_elem6;
		var ss_elemshow1,ss_elemshow2;
		var maxNum = 9;  
		var minNum = 0;
		var result1="",result2="";

		var winnersnum_cut = ["*","*","*","*","*","*"];
		var winnersnum_cut_integrated = [""];

		function ssNext(){
			ss_i++;
			//ss_elem.style.opacity = 0;

			setTimeout('ssSlide()',15);
		}
						
		function ssSlide(){

			if({{$nowprize->prize_page}} == 2)
			{
			if("{{$winnersnum}}" != "")
			{	
				winnersnum_cut = "{{$winnersnum}}".split("");
				winnersnum_cut_integrated = "{{$winnersnum}}".split(" ");
			}
			ss_elem1.innerHTML = ss_array[Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum];
			ss_elem2.innerHTML = ss_array[Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum];
			ss_elem3.innerHTML = ss_array[Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum];
			ss_elem4.innerHTML = ss_array[Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum];
			ss_elem5.innerHTML = ss_array[Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum];
			ss_elem6.innerHTML = ss_array[Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum];
			
			for(var $i=ss_k; $i<ss_k+1; $i++)
			{
				if(ss_i>=10)
				ss_elem1.innerHTML = winnersnum_cut[$i];
				if(ss_i>=20)
				ss_elem2.innerHTML = winnersnum_cut[$i+1];
				if(ss_i>=30)
				ss_elem3.innerHTML = winnersnum_cut[$i+2];
				if(ss_i>=40)
				ss_elem4.innerHTML = winnersnum_cut[$i+3];
				if(ss_i>=50)
				ss_elem5.innerHTML = winnersnum_cut[$i+4];
				if(ss_i>=60)
				ss_elem6.innerHTML = winnersnum_cut[$i+5];
			}

			

			ss_elem1.style.opacity = 1;
			ss_elem2.style.opacity = 1;
			ss_elem3.style.opacity = 1;
			ss_elem4.style.opacity = 1;
			ss_elem5.style.opacity = 1;
			ss_elem6.style.opacity = 1;
			//ss_elemshow1.style.opacity = 1;
			
			if(ss_i>60)	
			{
				if(ss_j%2 == 0)
				{
					result1 = result1 + "<br>" + winnersnum_cut_integrated[ss_j] + "</br>";
					
					ss_elemshow1.innerHTML = result1;
				}
				else
				{
					result2 = result2 + "<br>" + winnersnum_cut_integrated[ss_j] + "</br>";
					
					ss_elemshow2.innerHTML = result2;
				}
				ss_i = 0;
				ss_j++;
				ss_k += 7;

				if(ss_j<{{$winners->count()}})
				setTimeout('ssNext()',3000);
			}

			else
			setTimeout('ssNext()',30);
			}

			else
			{
				for(var $i=ss_k; $i<ss_k+1; $i++)
				{
					ss_elem1.innerHTML = winnersnum_cut[$i];
					ss_elem2.innerHTML = winnersnum_cut[$i+1];
					ss_elem3.innerHTML = winnersnum_cut[$i+2];
					ss_elem4.innerHTML = winnersnum_cut[$i+3];
					ss_elem5.innerHTML = winnersnum_cut[$i+4];
					ss_elem6.innerHTML = winnersnum_cut[$i+5];
				}
			}
		}
	</script>

</head>
<body>
<div class="container">

	@if(!empty($nowprize))
		<div class="col-md-6">
			<table class="table table-striped">
			    <caption>
				    <div class="row">
					    <div class="col-md-4">
							<h2>{!!$nowprize->prize_name!!}</h2>
						</div>
						
						<div class="col-md-4">
						</div>
						
						<div class="col-md-4">
							{!! Form::model($nowprize,['url' => '/stafflotto/' . $nowprize->id , 'method' => 'PATCH'])!!}
							{!! Form::submit('開始抽獎',['class'=>'btn btn-primary']) !!}
							{!! Form::close() !!}
						</div>
					</div>

					@if(!empty($winners))
					
						<div class="col-md-2">
							<h1><span id="slideshow1"></span></h1>
							<script>
								ss_elem1 = document.getElementById("slideshow1");
								//ssSlide();
							</script>
						</div>
						
						<div class="col-md-2">
							<h1><span id="slideshow2"></span></h1>
							<script>
								ss_elem2 = document.getElementById("slideshow2");
								//ssSlide();
							</script>
						</div>

						<div class="col-md-2">
							<h1><span id="slideshow3"></span></h1>
							<script>
								ss_elem3 = document.getElementById("slideshow3");
								//ssSlide();
							</script>
						</div>
						
						<div class="col-md-2">
							<h1><span id="slideshow4"></span></h1>
							<script>
								ss_elem4 = document.getElementById("slideshow4");
								//ssSlide();
							</script>
						</div>

						<div class="col-md-2">
							<h1><span id="slideshow5"></span></h1>
							<script>
								ss_elem5 = document.getElementById("slideshow5");
								//ssSlide();
							</script>
						</div>
						
						<div class="col-md-2">
							<h1><span id="slideshow6"></span></h1>
							<script>
								ss_elem6 = document.getElementById("slideshow6");
								//ssSlide();
							</script>
						</div>
					
					@endif

				</caption>
		   		@if($nowprize->prize_page == 3)
				   	<thead>
				      	<tr>
					        <th>中獎號碼</th>
					        <th>員工編號</th>
					        <th>員工姓名</th>
				      	</tr>
				   	</thead>
			   		
			   		<tbody>
					   @if(!empty($winners))
							@foreach($winners as $index => $winner)
								<tr>
									<td>{{ $winner->staff_activity_number }}</td>
									<td>{{ $winner->staff_number }}</td>
									<td>{{ $winner->staff_name }}</td>
								</tr>
						 	@endforeach
						@endif
					</tbody>
				
				@elseif($nowprize->prize_page == 2)
					<tbody>
						<tr>
							<td>
							<center><h2><span id="showstaff1"></span></h2></center>
							<script>ss_elemshow1 = document.getElementById("showstaff1");</script>
							</td>

							<td>
							<center><h2><span id="showstaff2"></span></h2></center>
							<script>ss_elemshow2 = document.getElementById("showstaff2");</script>
							</td>
						</tr>
					</tbody>
				@endif
			</table>
		</div>
	@endif
	
	<script>ssSlide();</script>

</div>
</body>
</html>
@stop