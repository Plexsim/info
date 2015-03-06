
<!DOCTYPE HTML>
<html>
<head>
<title>404 error page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link href="<?php echo base_url('assets/css/404.css')?>" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<!-----start-wrap--------->
	<div class="wrap">
		<!-----start-content--------->
		<div class="content">
			<!-----start-logo--------->
			<div class="logo">
				<h1><a href="#"><img src="<?php echo base_url('assets/img/logo.png')?>"/></a></h1>
				<span><img src="<?php echo base_url('assets/img/signal.png')?>"/>Oops! The Page you requested was not found!</span>
			</div>
			<!-----end-logo--------->
			<!-----start-search-bar-section--------->
			<div class="buttom">
				<div class="seach_bar">
					<p>you can go to <span><a href="<?php echo base_url()?>">home</a></span> page</p>					
				</div>
			</div>
			<!-----end-sear-bar--------->
		</div>
		<!----copy-right-------------->
	</div>
	
	<!---------end-wrap---------->
</body>
</html>