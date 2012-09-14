<script src="<?php echo base_url('bootstrap/js/jquery-1.7.2.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
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
</style>

<script type="text/javascript">
$('document').ready(function(){
	id_div = '';
	
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