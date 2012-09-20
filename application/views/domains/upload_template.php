<script type="text/javascript">

var folder_name 	= '';
var program_name 	= '';
var upload_url		= '<?php echo base_url(); ?>/uploadfy/do_template_upload/<?php echo $domain->id; ?>/{folder_name}/{program_name}';

$(function() {

	$('.do_upload').click(function(){

		program_name = $("input[id='program_name']").val();
		upload_url = upload_url.replace(/{program_name}/ig, program_name);
		
		folder_name  = $("input[id='folder_name']").val();
		upload_url = upload_url.replace(/{folder_name}/ig, folder_name); 
		
		if(folder_name != '' && program_name != '')
		{
			$(this).hide();
			$('.alert-error').hide();
		    $('#file_upload').uploadify({
		        'swf'      : '<?php echo base_url(); ?>/bootstrap/css/uploadify.swf',
		        'uploader' : upload_url,
		        'onQueueComplete' : function(file) {
		        	$('#ss-container').empty();
		        }
		    });		
		}
		else
		{
			$('.alert-error').show();
		}
	});

	
});

</script>

<ul class="breadcrumb">
  <li><a href="<?php echo base_url('domains/sem');?>">Domains</a> <span class="divider">/</span> </li>
</ul>
 
<div class="alert alert-error" style="display:none">Debe especificar una carpeta de destino y programa</div>

<div class="well">
<label>Nueva carpeta de destino: </label><input type="text" id="folder_name" />
<label>Programa: </label><input type="text" name="program_name" id="program_name" value="" data-provide="typeahead" data-items="5" data-source="<?php echo $programs_th ?>" />
<br />
<a class="btn do_upload" style="margin-top:10px">Upload Files</a>
<hr />
<input type="file" name="file_upload" id="file_upload" style="display:none" />
</div>

