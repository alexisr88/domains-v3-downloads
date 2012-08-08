<ul class="breadcrumb">
  <li><a href="<?php echo base_url('licenses/home');?>">Licenses</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('licenses/view');?>">View</a> <span class="divider">/</span> </li>
</ul>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Detail</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($licenses as $license):?>
	<tr>
		<td><?php echo $license->id?></td>
		<td><?php echo $license->name?></td>
		<td><?php echo character_limiter($license->detail,30);?></td>
		<td>
			<a href="<?php echo base_url('licenses/add_edit/'.$license->id)?>"><i class="icon-pencil"></i>Edit</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>