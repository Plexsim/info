<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>


<?php if(isset($meta)):?>	
	<meta name="description" content="<?php echo $meta;?>" />	
<?php else:?>
<meta name="Keywords" content="Shopping Cart, eCommerce, Wall IT, Orack, Plexsim">
<meta name="Description" content="Wall IT">
<?php endif;?>

<!--bootstrap3 css-->
<link href="<?php echo theme_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel='stylesheet' type='text/css'>
	
<!--ion icon fonts css-->
<?php echo theme_css('ionicons.css', true);?>
<!--custom css-->
<?php echo theme_css('style.css', true);?>
<!--google raleway font family-->
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,100,700,500' rel='stylesheet' type='text/css'>
 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!--flex slider css-->
<?php echo theme_css('flexslider.css', true);?>

<?php echo theme_css('owl-carousel/owl.carousel.css', true);?>
<?php echo theme_css('owl-carousel/owl.theme.css', true);?>

<meta name="twitter:widgets:theme" content="light">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<?php
//with this I can put header data in the header instead of in the body.
if(isset($additional_header_info))
{
	echo $additional_header_info;
}

?>
</head>

<body>
<div class="page-container">
  
	<!-- top navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	<div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".sidebar-nav">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <a class="navbar-brand" href="#">WallIT</a>
    	</div>
    </nav>

	<div class="container-fluid">
        <div class="row row-offcanvas row-offcanvas-left">
        
        <!--sidebar-->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div data-spy="affix" data-offset-top="45" data-offset-bottom="90">
            <ul class="nav" id="sidebar-nav">
              <li><a href="#">Home</a></li>
              <li><a href="#section1">Section 1</a></li>            
            </ul>
           </div>
        </div><!--/sidebar-->

	<?php
	/*
	 End header.php file
*/