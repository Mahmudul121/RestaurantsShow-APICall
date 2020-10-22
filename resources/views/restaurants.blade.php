<!DOCTYPE html>
<html>
    <head>
        <title>Restaurants</title>
        <style type="text/css">
        	body{
        		margin: 0px,0px,0px,0px;
        	}
        	.input-head{
				text-align: center;  
				background-color: 165, 176, 168;  	
			}
			.card-size{
				padding: 0px !important;
				background-color: #FFFFFF;
				width: 30%;
				height: 324px;
				border-radius: 3px; 
				margin:6px 6px 6px 6px;
				display: inline-block;
			}
			.card-size img{
				border-top-right-radius: 3px; 
				border-top-left-radius: 3px; 
				width: 100%;
				height: 183px;
			}
			.card-size:hover{
				box-shadow: 2px 2px 10px black;
			}
        </style>
    </head>
    <body>
    	<form method="post">
    		@csrf
	         <div class="container">
	         	<hr class="row" style="border: 0.5px solid #D4D4D4; width: 100%;">
	         	<div class="col-lg-12">
	         		<div class="input-head">
	         			<label><b>Lattitude :</b></label>
	         			<input type="number" name="lattitude" step="0.0001">
	         			<label style="padding-right: 10px;padding-left: 10px;">   </label>
	         			<label><b>Longitude :</b></label>
	         			<input type="number" name="longitude" step="0.0001">
	         			<label style="padding-right: 10px;padding-left: 10px;">   </label>
	         			<input type="submit" name="submit">
	         		</div>
	         	</div>
	         	<hr class="row" style="border: 0.5px solid #D4D4D4; width: 100%;">
	         	<div class="col-lg-12">
	         		@if($postcode[0] !== "none")
		         		@foreach($postcode as $key => $value)
		         		<div class="col-lg-4 card card-size">
		         			<div>
								<img src="photo/rest.jpg">
							</div>
							<div style="text-align: center;">
								<p style="margin-top: 0px;">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
							</div>
							<div style="text-align: center;">
								<label><b>Postal Code :{{ $value }}</b></label>
							</div>
							<div style="margin-left: 5px; margin-right: 5px; word-break: break-all;">
								<label><b>Restaurants :{{ $name[$key] }}</b></label>
							</div>
		         		</div>
	         		@endforeach

	         		@else
		         		<div style="text-align: center;">
		         			<h1>Welcome</h1>
		         		</div>
	         		@endif
	         		<div style="text-align: center;">
	         			<h1>{{session('Error')}}</h1>
	         		</div>

	         	</div>
	         </div>
         </form>
    </body>
</html>
