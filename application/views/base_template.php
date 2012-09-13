<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<link href='http://fonts.googleapis.com/css?family=Headland+One' rel='stylesheet' type='text/css'>

<!-- Add jQuery library -->
<script type="text/javascript" src="../../bootstrap/fancy/lib/jquery-1.8.0.min.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="../../bootstrap/fancy/source/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="../../bootstrap/fancy/source/jquery.fancybox.css?v=2.1.0" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="../../bootstrap/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.3" />
<script type="text/javascript" src="../../bootstrap/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.3"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="../../bootstrap/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.6" />
<script type="text/javascript" src="../../bootstrap/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.6"></script>
	

<style type="text/css">
body {margin:0px;padding:0px;font-family: 'Headland One', serif;font-size:12px}
.container {width:1080px;margin:0 auto;}
.header {height:110;background:#eee}
.header .logo {float:left;padding-left:15px}
.header .site-name {font-size:30px;font-weight:bold;display:inline-block;margin-left:15px;margin-top:20px;text-transform:uppercase;color:#fff;text-shadow:1px 1px 1px #000}
.header .logo img {width:100px;height:100px;}

.header {filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $data->color;?>', endColorstr='<?php echo $header_color;?>'); /* for IE */}
.header {background: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $data->color;?>), to(<?php echo $header_color;?>)); /* for webkit browsers */}
.header {background: -moz-linear-gradient(top,  #<?php echo $data->color;?>,  <?php echo $header_color;?>); /* for firefox 3.6+ */} 
.header {border-bottom:1px solid #444;border-radius:5px}

.middle-content {filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#444', endColorstr='#000'); /* for IE */}
.middle-content {background: -webkit-gradient(linear, left top, left bottom, from(#444), to(#000)); /* for webkit browsers */}
.middle-content {background: -moz-linear-gradient(top,  #444,  #000); /* for firefox 3.6+ */} 

.middle-content {padding:10px}
.middle-content .slider {width:520px;float:Left;padding:10px}
.middle-content .slider-title {color:#fff;text-shadow:1px 1px 1px #000;font-size:16px}
.middle-content .slider-descr {color:#fff;font-size:12px;margin:10px 0px} 
.middle-content .slider-tags {padding:5px;border-radius:5px;background:#f8f8f8}

.middle-content .screenshots {width:500px;float:left;padding:10px}
.middle-content {border-radius:10px;margin:10px 0px}

.main-screenshot img {width:450px;height:250px;border-radius:5px;margin:0 auto;margin-left:30px}

.stuff {width:100%;height:150px;background:#000;border-bottom:2px solid #eee;border-radius:10px}

.data-stuff {padding:1%;background:#f8f8f8;width:30%;float:left;min-height:100%;}
.data-stuff .stuff-title {font-size:16px;padding-bottom:10px;color:#<?php echo $data->color;?>}
.data-stuff ul {margin:0px;padding:0px;list-style-type:none;font-size:11px}
.data-stuff ul li strong {display:inline-block;width:100px;text-align:center}
.data-stuff ul li {border-bottom:1px dashed #eee;padding:5px}

.thumbs-stuff {background:#eee;padding:1%;float:left;width:66.3%;min-height:100%;}
.thumbs-stuff .stuff-title {font-size:16px;padding-bottom:10px;color:#<?php echo $data->color;?>}
.thumbs-stuff .thumbs img {border-radius:10px;margin-right:10px;}
.thumbs-stuff .thumbs {margin-left:20px;}
.thumbs-stuff .thumbs a {text-decoration:none}

.outer-content {width:98%;background:#eee;padding:10px;border-radius:10px;margin-top:15px;}
.outer-content  {filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#eee', endColorstr='#fff'); /* for IE */}
.outer-content  {background: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#fff)); /* for webkit browsers */}
.outer-content  {background: -moz-linear-gradient(top,  #eee,  #fff); /* for firefox 3.6+ */} 

.outer-title {font-size:16px;padding-bottom:10px;color:<?php echo $data->color;?>}

#download{
	cursor:pointer;
	background-image: url("http://ns208873.ovh.net/domains-v3-downloads/bootstrap/img/btn.png");
	background-repeat: no-repeat;
	background-position:left top;
	font-family: 'Ropa Sans', sans-serif;
	color:#FFF;
	text-transform:uppercase;
	font-size:24px;
	padding:0 20px 0 65px;
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;
	text-align:center;
	line-height:57px;
	z-index:500;
	display:inline-block;
	margin:0 auto;
	-moz-box-shadow: 0px 0px 15px #c4c4c4;
	-webkit-box-shadow: 0px 0px 15px #c4c4c4;
	box-shadow: 0px 0px 15px #c4c4c4;
}	

</style>

</head>
<body>

<div class="container">

	<div class="header">
		<div class="logo"><img src="http://ns208873.ovh.net/domains-v3-downloads/uploads/<?php echo $data->icon_slug . $data->icon_extension;?>" /></div>
		<div class="site-name"><?php echo $data->name;?></div>
		<div style="clear:left"></div>
	</div>
	
	<div class="middle-content">
		<div class="slider">
			<div class="slider-title"><?php echo $data->splash_title;?></div>
			<div class="slider-descr"><?php echo $data->splash_text;?></div>
			<br />
			<div id="download" style="background-color:<?php echo $data->color;?>">Pobierz OpenOffice</div>	
		</div>
		<div class="screenshots">
			<div class="main-screenshot">
				<img src="<?php echo $screenshots[0]->ss_url;?>" />
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
	
	<div class="stuff">
		<div class="data-stuff">
			<div class="stuff-title">Specifications</div>
			<ul>
				<li><strong>Version:</strong> <?php echo $data->version;?></li>
				<li><strong>Size:</strong> <?php echo $data->size;?></li>
				<li><strong>License:</strong> <?php echo $data->license_name;?></li>
				<li><strong>Category:</strong> <?php echo $data->category_name;?></li>
			</ul>
		</div>
		
		<div class="thumbs-stuff">
			<div class="stuff-title">Screenshots</div>
			
			<div class="thumbs">
			<?php foreach($screenshots as $ss):?>
			<a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo $ss->ss_url;?>" title="<?php echo $data->name . ' Screenshots'?>">
				<img src="<?php echo $ss->ss_thumb;?>" />
			</a>
			<?php endforeach;?>
			</div>
			
		</div>
		
		<div style="clear:left"></div>
	</div>
	
	<br />
	
	<div class="outer-content">
		<div class="outer-title">Descripcion</div>
		<div class="outer-description"><?php echo nl2br($data->splash_full_text)?></div>
	</div>
	
	<div class="footer">
	</div>
	
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
});
</script>
	
</div>
</body>
</html>