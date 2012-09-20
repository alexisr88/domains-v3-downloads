<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Host</th>
			<th>Program Name</th>
			<th>Template Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($templates as $template):?>
	<tr>
		<td><?php echo $template->id?></td>
		<td><?php echo $template->host?></td>
		<td><?php echo $template->program_name;?></td>
		<td><?php echo $template->template_name;?></td>
		<td>
			<a href="<?php echo base_url('domains/generate_landing/'.$template->id)?>"><i class="icon-pencil"></i>Generate Landing</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>