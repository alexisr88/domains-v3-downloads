<ul class="breadcrumb">
  <li><a href="<?php echo base_url('news/view');?>">News</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('news/view');?>">View</a> <span class="divider">/</span> </li>
</ul>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Short text</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($news as $new):?>
	<tr>
		<td><?php echo $new->id?></td>
		<td><?php echo $new->title?></td>
		<td><?php echo ellipsize($new->short_text,32,.5);?></td>
		<td>
			<a href="<?php echo base_url('news/add_edit/'.$new->id)?>"><i class="icon-pencil"></i>Edit</a>
			<a href="<?php echo base_url('news/screenshots/'.$new->id)?>"><i class="icon-picture"></i>Screenshots</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>