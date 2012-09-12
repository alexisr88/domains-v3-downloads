<ul class="breadcrumb">
  <li><a href="<?php echo base_url('news/view');?>">News</a> <span class="divider">/</span> </li>
  <?php if($new->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('news/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('news/add_edit/'.$new->id);?>">Edit - <?php echo $new->title;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>

<div id="result"></div>

<?php echo $form; ?>