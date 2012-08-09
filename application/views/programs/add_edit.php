<ul class="breadcrumb">
  <li><a href="<?php echo base_url('programs/view');?>">Programs</a> <span class="divider">/</span> </li>
  <?php if($program->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('programs/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('programs/add_edit/'.$program->id);?>">Edit - <?php echo $program->name;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>

<div id="result"></div>

<?php echo $form; ?>


<script type="text/javascript">
$(document).ready(function(){
	$("#ratings-options i.set-rate").live('mouseenter',function() {
		rate_number = parseInt($(this).attr('rel'));
		
		for(i = rate_number; i <= 5; i++) {
			$("#ratings-options #star"+i).removeClass('icon-star').addClass('icon-star-empty');
		}
		for(i = 1; i <= rate_number; i++) {
			$("#ratings-options #star"+i).removeClass('icon-star-empty').addClass('icon-star');
		}
				
		$(this).removeClass('icon-star-empty').addClass('icon-star');
	}).mouseleave(function() {
		
	});

	$('.set-rate').click(function(){

		$('input[name=our_valuation]').val($(this).attr('rel'));
		
	});
	
});
</script>