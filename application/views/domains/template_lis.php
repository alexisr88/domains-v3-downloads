<ul>
<?php foreach($templates as $tem):?>
	<li><a href="<?php echo base_url('domains/load_template/'.$tem)?>"><?php echo $tem;?></a></li>
<?php endforeach;?>
</ul>