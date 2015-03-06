<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo (isset($page_title))?' :: '.$page_title:''; ?></title>

<!-- CSS -->
<link type="text/css" href="<?php echo base_url('assets/css/styles.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css');?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/redactor.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/jquery.timepicker.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/colpick.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/iconselect.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/upload/jquery.fileupload.css');?>" rel="stylesheet" />

<link type="text/css" href="<?php echo base_url('assets/css/calendar.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/icomoon.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/media-player.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/file-manager.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/form.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/styles.css');?>" rel="stylesheet" />

<!-- The following CSS codes are used to display the template customization in this page. You can remove these codes anytime -->
<style type="text/css">
.template-customize {
	position: fixed;
	bottom: 0;
	right: 35px;
	background: #000;
	background: rgba(0, 0, 0, 0.9);
	width: 154px;
	z-index: 10000;
	border: 2px solid #B6B6B6;
	border-bottom: 0;
	border-radius: 1px;
	box-shadow: 0 0 10px #000;
	height: 0;
}

.template-customize i {
	font-size: 30px;
	position: absolute;
	color: #000;
	top: -46px;
	left: 49px;
	padding: 10px 10px 4px 10px;
	border-radius: 100% 100% 0 0;
	background: #fff;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FFFFFF),
		color-stop(1, #B6B6B6) );
	background-image: -o-linear-gradient(bottom, #FFFFFF 0%, #B6B6B6 100%);
	background-image: -moz-linear-gradient(bottom, #FFFFFF 0%, #B6B6B6 100%);
	background-image: -webkit-linear-gradient(bottom, #FFFFFF 0%, #B6B6B6 100%);
	background-image: -ms-linear-gradient(bottom, #FFFFFF 0%, #B6B6B6 100%);
	background-image: linear-gradient(to bottom, #FFFFFF 0%, #B6B6B6 100%);
}

.template-customize i:hover {
	cursor: pointer;
	color: #3748d4;
}

.template-customize ul {
	list-style: none;
	float: left;
	margin: 10px 0 10px 20px;
	padding: 0;
}

.template-customize ul li {
	width: 45px;
	height: 30px;
	overflow: hidden;
	margin-bottom: 2px;
}

.template-customize ul li:hover {
	cursor: pointer;
	opacity: 0.8;
}
</style>

</head>
<body>
<?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>


<?php if($this->auth->is_logged_in(false, false)):?>
 <!-- Header -->
          <header id="header" class="clearfix">
               <!-- Logo -->
               <a href="<?php echo base_url()?>" class="logo shadowed">
                    Thundermatch Staff Site
               </a>
                                             
               <ul class="nav nav-pills pull-right shadowed" id="top-menu">
               		<?php 
               			$admin_detail	= $this->session->userdata('admin');
               		?>
               	   <li><a href="#">Hi, <?php echo $admin_detail['firstname']?></a></li>
                   <li><a href="<?php echo base_url();?>">Home</a></li>                                      
                   <li><a href="<?php echo $admin_url;?>admin"><?php echo lang('common_administrators') ?></a></li>                    
               	   <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><?php echo lang('common_log_out') ?></a></li>                       
               </ul> 
          </header>

 		<section id="main" role="main">
               
               <!-- Left Sidebar -->
               <aside id="leftbar" class="pull-left">
                    <div class="sidebar-container">
                         <!-- Main Menu -->
                         <ul class="side-menu shadowed">
                              <li>
                                  <a class="active" href="<?php echo $admin_url;?>files"><i class="icon-home"></i><?php echo lang('common_file')?></a>
                              </li>                              
                         </ul>
                    </div>
                    <span id="leftbar-toggle" class="visible-xs sidebar-toggle">
                         <i class="icon-angle-right"></i>
                    </span>
               </aside>
			   <aside id="rightbar" class="pull-right">
                    <div class="sidebar-container">
                         <!-- Date + Clock -->
                         <div class="clock shadowed">
                              <div id="date"></div>
                              <div id="time">
                                   <span id="hours"></span>
                                   :
                                   <span id="min"></span>
                                   :
                                   <span id="sec"></span>
                              </div>
                         </div>
                         
                         <!-- Calendar -->
                         <div class="shadowed side-calendar">
                              <div id="sidebar-calendar"></div>
                         </div>
                    </div>
                    
                    <span id="rightbar-toggle" class="hidden-lg sidebar-toggle">
                         <i class="icon-angle-left"></i>
                    </span>
               </aside>


<?php
    //lets have the flashdata overright "$message" if it exists
    if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
    if($this->session->flashdata('error'))
    {
        $error  = $this->session->flashdata('error');
    }
    
    if(function_exists('validation_errors') && validation_errors() != '')
    {
        $error  = validation_errors();
    }
    ?> 
    
<section id="content" class="container">  
<div class="c-block" id="default">
	<?php if (!empty($message)): ?>
        <div class="alert alert-success">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $error; ?>
        </div>
    <?php endif; ?> 
</div>    
<?php endif;?>      