<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Domains v 3.0</title>

    <!-- Le styles -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/css/custom.css" rel="stylesheet">

    <script src="<?php echo base_url('bootstrap/js/jquery-1.7.2.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('bootstrap/js/custom.js');?>" type="text/javascript"></script>
    
</head>
<body>


	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Domainsv3</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
            </ul>
            <p class="navbar-text pull-right">
            	Logged in as 
            	<a class="cUser" href="#"></a> | 
            	<a class="cUser" href="">Logout</a>
            </p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
      
        <div class="span2">
          <div class=" sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Splash Content</li>
              <li><a href="<?php echo base_url('splash_content/add_edit');?>"><i class="icon-plus"></i>New</a></li>
              <li><a href="<?php echo base_url('splash_content/view');?>"><i class="icon-th-list"></i>View</a></li>
              <li class="nav-header">Programs</li>
              <li><a href="<?php echo base_url('programs/add_edit');?>"><i class="icon-plus"></i>New</a></li>
              <li><a href="<?php echo base_url('programs/view');?>"><i class="icon-th-list"></i>View</a></li>
              <li class="nav-header">Categories</li>
              <li><a href="<?php echo base_url('categories/add_edit');?>"><i class="icon-plus"></i>New</a></li>
              <li><a href="<?php echo base_url('categories/view');?>"><i class="icon-th-list"></i>View</a></li>
              <li class="nav-header">Licenses</li>
              <li><a href="<?php echo base_url('licenses/add_edit');?>"><i class="icon-plus"></i>New</a></li>
              <li><a href="<?php echo base_url('licenses/view');?>"><i class="icon-th-list"></i>View</a></li>
              <li class="nav-header">Languages</li>
              <li><a href="<?php echo base_url('languages/add_edit');?>"><i class="icon-plus"></i>New</a></li>
              <li><a href="<?php echo base_url('languages/view');?>"><i class="icon-th-list"></i>View</a></li>
              <li class="nav-header">Countries</li>
              <li><a href="<?php echo base_url('countries/add_edit');?>"><i class="icon-plus"></i>New</a></li>
              <li><a href="<?php echo base_url('countries/view');?>"><i class="icon-th-list"></i>View</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="span10">


