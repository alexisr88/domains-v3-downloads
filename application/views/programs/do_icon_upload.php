<ul class="breadcrumb">
  <li><a href="<?php echo base_url('programs/view');?>">Programs</a> <span class="divider">/</span> </li>
  <li><a href="<?php echo base_url('programs/add_edit/'.$program->id);?>">Edit - <?php echo $program->name;?></a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('programs/upload_icon/'.$program->id);?>">Upload Icon</a> <span class="divider">/</span> </li>
</ul>

<?php if($status == 'fail') { ?>
<div class="alert alert-error">
	<?php echo @strip_tags($errors);?>
	<?php echo @$verrors;?>
</div>
<?php } ?>

<?php if($status == 'win') { ?>
<div class="alert alert-success">
	El Icono se agrego correctamente
</div>
<?php } ?>
