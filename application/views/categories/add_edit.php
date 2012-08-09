<ul class="breadcrumb">
  <li><a href="<?php echo base_url('categories/view');?>">Categories</a> <span class="divider">/</span> </li>
  <?php if($category->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('categories/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('categories/add_edit/'.$category->id);?>">Edit - <?php echo $category->name;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>


<div id="result"></div>
<?php echo $form; ?>


<script type="text/javascript">
$(document).ready(function(){
	$('.show-help').tooltip('hide')
});
</script>