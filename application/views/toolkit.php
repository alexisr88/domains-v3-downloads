<script src="<?php echo base_url('bootstrap/js/jquery-1.7.2.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('bootstrap/colorpicker/css/colorpicker.css');?>" />
<script src="<?php echo base_url('bootstrap/colorpicker/js/colorpicker.js');?>" type="text/javascript"></script>


<style type="text/css">
.editable {
	border:1px dashed #eee;
}
.editable:hover {
	background:#f8f8f8;
}
.or-text {padding:10px;border-bottom:1px dashed #444}
.set-content {min-height:150px;background:#eee;min-width:100%;position:fixed;bottom:0;z-index:99999999}
.set-content .title {background:#444;color:#fff;padding:10px;}

.translation textarea {width:100%;min-height:100px;padding:10px}
.toolkit-data a {padding:10px;background:#444;color:#fff;text-shadow:1px 1px 1px #000;border-radius:5px}
.toolkit-data {padding-left:10px;padding-bottom:15px}

#bg-toolkit {position:absolute;width:350px;height:350px;background:#eee;z-index:10;top:0px;left:0px;border-radius:5px;}
#bg-toolkit .title {background:#444;color:#fff;text-shadow:1px 1px 1px #000;padding:10px;border-radius-top-left:5px}
#bg-toolkit .content {padding:10px}
#bg-toolkit .content input {width:80%;border:1px solid #444;padding:1%}
#bg-toolkit .content a {color:blue;cursor:pointer}
#bg-toolkit .content .lb {margin-bottom:4px;}
</style>

<script type="text/javascript">
$('document').ready(function(){

	$('.set-bg').click(function(){

		bg_url = $('input[name=bg-image]').val();
		$('body').css('background','url('+bg_url+')');
		
	});

	$('.editable').ColorPicker({
		color: '#0000ff',
		onShow: function (colpkr) {
			el_id = $(this).attr('id');
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#'+el_id).css('color', '#' + hex);
		}
	});

	//$('#colorpickerHolder').ColorPicker({flat: true});
	
	id_div = '';

	logo_url = 'http://ns208873.ovh.net/domains-v3-downloads/uploads/office-icon.png';

	
	$('#example').popover('show');
	$('a').click(function(){
		return false;
	});
	$('.editable').click(function(){

		id_div = $(this).attr('id');
				
		$('.or-text').empty();
		$('.translation textarea').val('');
		$('.or-text').append($(this).html());
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

<div id="bg-toolkit">
	<div class="title">Backgrounds</div>
	<div class="content">
		<div class="lb">Image Url <a class="set-bg"> (SET) </a></div>
		<input type="text" name="bg-image" />
	</div>
	
	<div id="colorpickerHolder">
	</div>
</div>

<div class="set-content">
<div class="toolkit-data">
	<a class="do-set">Guardar textos</a>
	<a class="hide-guides">Esconder guias</a>
	<a class="show-guides">Mostrar guias</a>
</div>

<div class="or-text"></div>
<div class="translation">
	<textarea id="oc-content"></textarea>
</div>
</div>