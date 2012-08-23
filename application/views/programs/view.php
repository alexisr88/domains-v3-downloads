<ul class="breadcrumb">
  <li><a href="<?php echo base_url('programs/home');?>">Programs</a> <span class="divider">/</span> </li>
  <li class="active"><a href="<?php echo base_url('programs/view');?>">View</a> <span class="divider">/</span> </li>
</ul>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Official Url</th>
			<th>Our Rank</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($programs as $program):?>
	<tr>
		<td><?php echo $program->id?></td>
		<td><?php echo $program->name?> <a href="<?php echo $program->official_download; ?>">Download</a></td>
		<td><?php echo character_limiter($program->official_site_url,30);?></td>
		<td>
			<i class="<?php echo ($program->our_valuation >= 1) ? 'icon-star' : 'icon-star-empty'?>"></i>
			<i class="<?php echo ($program->our_valuation >= 2) ? 'icon-star' : 'icon-star-empty'?>"></i>
			<i class="<?php echo ($program->our_valuation >= 3) ? 'icon-star' : 'icon-star-empty'?>"></i>
			<i class="<?php echo ($program->our_valuation >= 4) ? 'icon-star' : 'icon-star-empty'?>"></i>
			<i class="<?php echo ($program->our_valuation >= 5) ? 'icon-star' : 'icon-star-empty'?>"></i>
		</td>
		<td>
			<a href="<?php echo base_url('programs/add_edit/'.$program->id)?>"><i class="icon-pencil"></i>Edit</a>
			<a href="<?php echo base_url('programs/upload_icon/'.$program->id)?>"><i class="icon-pencil"></i>Upload Icon</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>