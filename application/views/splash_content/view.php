<ul class="breadcrumb">
  <li><a href="<?php echo base_url('countries/home');?>">Countries</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('countries/view');?>">View</a> <span class="divider">/</span> </li>
</ul>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Program</th>
			<th>Lang</th>
			<th>Title</th>
			<th>Text</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($splashs as $splash):?>
	<tr>
		<td><?php echo $splash->id?></td>
		<td><?php echo $splash->program_name;?></td>
		<td>
			<img class="flag" src="<?php echo base_url('bootstrap/img/flags/png/'.$splash->iso_code.'.png')?>" />
			<?php echo $splash->english_iso_name; ?>
		</td>
		<td><?php echo $splash->title?></td>
		<td><?php echo character_limiter($splash->text,30);?></td>
		<td>
			<a href="<?php echo base_url('splash_content/add_edit/'.$splash->id)?>"><i class="icon-pencil"></i>Edit</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>