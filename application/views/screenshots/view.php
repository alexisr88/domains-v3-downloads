<script type="text/javascript">
$(function() {
    $('#file_upload').uploadify({
        'swf'      : '/bootstrap/css/uploadify.swf',
        'uploader' : '/uploadfy/do_upload/<?php echo $program->id; ?>',
        'onQueueComplete' : function(file) {
        	$('#ss-container').empty();
            $('#ss-container').load('<?php echo base_url()."programs/screenshots/{$program->id}/true"; ?>',function(){
                
            });
        }
    });
});


$(document).ready(function(){

	$('.delete-img').click(function(){
		
		  var answer 		= confirm('Delete user');
		  var screenshot 	= $(this).attr('rel');
		  
		if(true == answer) 
		{   
			//
			var jqxhr = $.ajax({
				  url: 		'<?php echo base_url('programs/delete_screenshot/')?>/'+screenshot,
				  type: 	'GET',
			});

			jqxhr.done(function(data) {
				$('#img-'+screenshot).fadeOut();				
			});
			//
		}
	}); 
	
});
</script>

<?php if(False === $ss_only) { ?>
<ul class="breadcrumb">
  <li><a href="<?php echo base_url('programs/home');?>">Programs</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('programs/screenshots/'.$program->id);?>">Screenshots</a> <span class="divider">/</span> </li>
</ul>

<hr />
<input type="file" name="file_upload" id="file_upload" />
<hr />
<?php } ?>

<div id="ss-container">
<div class="screenshots">
	<?php foreach($screenshots as $screenshot):?>
	<div id="img-<?php echo $screenshot->id?>" class="img-box delete-img" rel="<?php echo $screenshot->id ?>" style="display:inline">
		<img src="<?php echo base_url("uploads/$program->id/$screenshot->thumb"); ?>" class="img-rounded" />
		<span class="inline-options"><i class="icon-remove"></i></span>
	</div>
	<?php endforeach;?>
</div>
</div>

