<?php echo $html_template; ?>

<script src="<?php echo base_url('bootstrap/js/jquery-1.7.2.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('bootstrap/js/jquery-ui-1.8.23.custom.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('bootstrap/colorpicker/js/colorpicker.js');?>" type="text/javascript"></script>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('bootstrap/colorpicker/css/colorpicker.css');?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('bootstrap/css/ui-lightness/jquery-ui-1.8.23.custom.css');?>" />
<link rel="stylesheet" media="screen" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/black-tie/jquery-ui.css" />



<style type="text/css">
.editable:hover {cursor:pointer;}

/*
#bg-toolkit * {font-size:12px}
#bg-toolkit {margin-top:15px}
#bg-toolkit .title {font-weight:bold;}
#bg-toolkit input[type=text] {border:1px solid #444;border-radius:5px;padding:4px;}
#bg-toolkit .lb {margin:10px 0px;}
#bg-toolkit .wh {width:50px;margin-right:20px}
*/


#bg-toolkit {position:absolute;min-heigth:100%;height:100%;width:232px;background:#eee;top:0px;left:0px;border-right:2px solid #000;display:none}
#bg-toolkit .title {background:#444;color:#fff;text-shadow:1px 1px 1px #000;padding:5px;border-bottom:2px solid #000;border-top:2px solid #000}
#bg-toolkit .content {padding:10px;}
#bg-toolkit .content input[type=text] {border:1px solid #444;border-radius:5px;padding:3px}

#dialog {display:none}
#dialog * {font-size:12px;}
#dialog .ui-dialog-titlebar {width:93%;margin:0 auto;margin-top:5px;}
#dialog .text-changer {width:99.6%;height:150px;border:1px solid #eee;margin-top:5px;padding:0px;margin:0px;margin-top:5px}
#dialog a.btn-pp {color:blue;padding:5px;background:#444;color:#fff;text-shadow:1px 1px 1px #000;margin-top:10px;display:inline-block;cursor:pointer;border-radius:5px}

.active-element {border:3px dashed #ff4400}
.save-all {color:#fff;font-weight:bold;position:absolute;top:10px;left:10px;cursor:pointer;}
</style>

<div id="dialog" title="Change content">
	<textarea id="oc-content" class="text-changer"></textarea>
	<a class="do-set btn-pp">Save Content</a>
</div>

<a class="save-all">Confirmar Landing</a>
<div style="display:none" id="final-save"></div>

<script type="text/javascript">
$('document').ready(function(){

	$('.save-all').click(function(){

		items = [];
		
		$.each($('.editable'), function(item) { 
			  element_id 	= $(this).attr('id');
			  element_html 	= $(this).html();

			  data = {'id':element_id,'text':""+element_html+""}
			  items.push(data);
		});

		f_data = {'items':items}

		var jqxhr = $.ajax({
			  url: 		'<?php echo $url_save_content;?>',
			  type: 	'POST',
			  data: 	f_data,
		});
		
	});
	
	$('.set-bg').click(function(){

		bg_url = $('input[name=bg-image]').val();
		$('body').css('background','url('+bg_url+')');
		
	});

	$('.set-logo').click(function(){

		bg_url = $('input[name=bg-logo]').val();
		$('#header').css('background','url('+bg_url+') no-repeat center left');
		
	});

	$('#colorSelector').ColorPicker({
		color: '#0000ff',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector div').css('backgroundColor', '#' + hex);
		}
	});
	
	id_div = '';
		
	$('#example').popover('show');
	$('a').click(function(){
		return false;
	});
	$('.editable').click(function(){
		$("#dialog").dialog({ width: 670, height: 250 });
		$('.editable').removeClass('active-element');
		$(this).addClass('active-element');
		id_div = $(this).attr('id');

		

		$('#oc-content').focus();
		$('#oc-content').val($('#'+id_div).html());
	});

	$('.do-set').click(function(){
		$('#'+id_div).empty();
		$('#'+id_div).html($('#oc-content').val());
	});
	$('.hide-guides').click(function(){
		$('.editable').css('border','none');
	});
	$('.show-guides').click(function(){
		$('.editable').css('border','1px dashed #eee');
	});

});
</script>
 
<div id="bg-toolkit" title="Other changes">
	<div class="title">Backgrounds</div>
	<div class="content">
		<div class="lb">Image Url <a class="set-bg"> (SET) </a></div>
		<input type="text" name="bg-image" />
		<div class="divider"></div>
		<div class="lb">Logo Url <a class="set-logo"> (SET) </a></div>
		<input type="text" name="bg-logo" />
	</div>
	
	<div class="title">Colors</div>
	<div class="content">
	</div>
</div>