<ul class="breadcrumb">
  <li><a href="<?php echo base_url('domains/view');?>">Domains</a> <span class="divider">/</span> </li>
  <?php if($domain->id == Null) {  ?>
  <li class="active"><a href="<?php echo base_url('domains/add_edit/');?>">Add</a> <span class="divider">/</span> </li>
  <?php } else { ?>
  <li class="active"><a href="<?php echo base_url('domains/add_edit/'.$domain->id);?>">Edit - <?php echo $domain->host;?></a> <span class="divider">/</span> </li>
  <?php } ?>
</ul>


<div id="result"></div>
<?php echo $form; ?>


<script type="text/javascript">
$(document).ready(function(){
	$('.show-help').tooltip('hide')
});
</script>