<ul class="breadcrumb">
  <li><a href="<?php echo base_url('languages/view');?>">Languages</a> <span class="divider">/</span> </li>
  <?php if($language->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('languages/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('languages/add_edit/'.$language->id);?>">Edit - <?php echo $language->english_iso_name;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>


<div id="result"></div>
<?php echo $form; ?>


<script type="text/javascript">
$(document).ready(function(){
	$('.show-help').tooltip('hide')
});
</script>