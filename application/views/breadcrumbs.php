<ul class="breadcrumb">
<?php foreach($breadcrumbs as $link): ?>
	<li class="<?php echo $link['class'];?>"><a href="<?php echo $link['href'];?>"><?php echo $link['title'];?></a> <span class="divider">/</span></li>
<?php endforeach;?>
</ul>