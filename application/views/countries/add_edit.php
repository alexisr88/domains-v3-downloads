<ul class="breadcrumb">
  <li><a href="<?php echo base_url('countries/view');?>">Countries</a> <span class="divider">/</span> </li>
  <?php if($countries->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('countries/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('countries/add_edit/'.$countries->id);?>">Edit - <?php echo $countries->english_iso_name;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>


<div id="result"></div>
<?php echo $form; ?>


<script type="text/javascript">
$(document).ready(function(){
	$('.show-help').tooltip('hide')
});
</script>