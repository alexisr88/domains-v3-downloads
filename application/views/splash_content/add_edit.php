<ul class="breadcrumb">
  <li><a href="<?php echo base_url('splash_content/view');?>">Splash Content</a> <span class="divider">/</span> </li>
  <?php if($splash->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('splash_content/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('splash_content/add_edit/'.$splash->id);?>">Edit - <?php echo $splash->title;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>


<div id="result"></div>
<?php echo $form; ?>

<script src="<?php echo base_url();?>bootstrap/js/bootstrap-typeahead.js"></script>
<script src="<?php echo base_url();?>bootstrap/js/ui.selectmenu.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('.show-help').tooltip('hide');
	$('.typeahead').typeahead();
});
</script>