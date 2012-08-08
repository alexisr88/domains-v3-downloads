<ul class="breadcrumb">
  <li><a href="<?php echo base_url('licenses/view');?>">Licenses</a> <span class="divider">/</span> </li>
  <?php if($license->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('licenses/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('licenses/add_edit/'.$license->id);?>">Edit - <?php echo $license->name;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>


<div id="result"></div>
<?php echo $form; ?>


<script type="text/javascript">
$(document).ready(function(){
	$('.show-help').tooltip('hide')
});
</script>