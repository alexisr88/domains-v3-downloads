<ul class="breadcrumb">
  <li><a href="<?php echo base_url('countries/home');?>">Countries</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('countries/view');?>">View</a> <span class="divider">/</span> </li>
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
	<?php foreach($categories as $category):?>
	<tr>
		<td><?php echo $category->id?></td>
		<td><?php echo $category->name?></td>
		<td><?php echo character_limiter($category->detail,30);?></td>
		<td>
			<a href="<?php echo base_url('categories/add_edit/'.$category->id)?>"><i class="icon-pencil"></i>Edit</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>