<ul class="breadcrumb">
  <li><a href="<?php echo base_url('languages/home');?>">Languages</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('languages/view');?>">View</a> <span class="divider">/</span> </li>
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
	<?php foreach($countries as $country):?>
	<tr>
		<td><?php echo $country->id?></td>
		<td><?php echo $country->english_iso_name?></td>
		<td>
			<a href="<?php echo base_url('countries/add_edit/'.$country->id)?>"><i class="icon-pencil"></i>Edit</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>