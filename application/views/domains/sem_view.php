<ul class="breadcrumb">
  <li><a href="<?php echo base_url('domains/view');?>">Domains</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('domains/view');?>">View</a> <span class="divider">/</span> </li>
</ul>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($domains as $domain):?>
	<tr>
		<td><?php echo $domain->id?></td>
		<td><?php echo $domain->host?></td>
		<td>
			<a href="<?php echo base_url('domains/add_edit/'.$domain->id)?>"><i class="icon-pencil"></i>Edit</a>
			<a href="<?php echo base_url('domains/add_edit/'.$domain->id)?>"><i class="icon-fire"></i>Landings</a>
			<a href="<?php echo base_url('domains/upload_template/'.$domain->id)?>"><i class="icon-arrow-up"></i>Upload Template</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>