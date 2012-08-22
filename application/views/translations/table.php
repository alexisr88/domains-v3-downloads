<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>Key</th>
			<th>Source <a>(<?php echo $lang_src->english_iso_name;?>)</a></th>
			<th>Dest <a>(<?php echo $lang_dst->english_iso_name;?>)</a></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($translations as $source):?>
		<tr>
			<td><?php echo $source->key;?></td>
			<td><?php echo $source->text;?></td>
			<td>
				<?php if($source->translation !== False):?>
				<?php echo $source->translation->text?>
				<?php endif;?>
			</td>
			<td>
				<a class="show-translation-form" href="<?php echo base_url("translations/translate/{$source->key}/{$id_source}/{$id_dest}")?>"><i class="icon-pencil"></i>Edit</a>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>