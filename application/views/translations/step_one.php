<div class="row-fluid">

	<?php include(APPPATH.'views/breadcrumbs.php');?>

	<div class="row-fluid chose_lang" id="source">
		<strong>Del:</strong>
		<?php foreach($languages as $lang):?>
		<span class="label" rel="<?php echo $lang->id?>"><?php echo $lang->english_iso_name?></span>
		<?php endforeach;?>
	</div>
	
	<div class="row-fluid chose_lang" id="dest">
		<strong>Al:</strong>
		<?php foreach($languages as $lang):?>
		<span class="label" rel="<?php echo $lang->id?>"><?php echo $lang->english_iso_name?></span>
		<?php endforeach;?>
	</div>
	
	<br />

	<ul class="nav nav-tabs">
		<li><a href="#general" data-toggle="tab" rel="get_general">General <img id='loader-general' class="t_loader" src="/bootstrap/img/tiniy-ajax-loader.gif" /></a></li>
	</ul>
	
	<div class="tab-content">
	  <div class="tab-pane" id="general"></div>
	</div>
	
</div>

<!-- Ratings -->
<div class="modal" id="translationModal">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Translation</h3>
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	$('.show-translation-form').live('click',function(){
		
		$("#translationModal .modal-body").load(this.href,function(){
			$('#translationModal').modal('show');
		});
		
		return false;
	});

	function check_filter()
	{
		id_source	= $('#source .label-info').attr('rel');
		id_dest		= $('#dest .label-info').attr('rel');

		if(id_source == 'undefined' || id_dest == 'undefined') {
			return false;
		} else if(id_source == id_dest) {
			$('span.label-important').remove();
			$('#source').append('<span class="label label-important">Traducir de un idioma al mimsmo idioma .. no tiene sentido</span>');
		} else if(id_source > 0 && id_dest > 0) {
			$('span.label-important').remove();
			return true;
		}

		return false;	
	}

	$('.nav-tabs a').click(function(){
		action = $(this).attr('rel');
		
		if(true == check_filter())
		{
			
			if(action == 'get_general')
			{
				$(this).children('img').css('display','inline-block');
				$('#general').load('/translations/render_general_by_source_dest/'+id_source+'/'+id_dest+'',function(){
					$('#loader-general').hide();
				});			
			}
		}
		
	});

	$('#source .label').click(function(){
		rel = $(this).attr('rel');
		$('#source span[rel!='+rel+']').removeClass('label-info');
		$(this).addClass('label-info');
		check_filter();
	});

	$('#dest .label').click(function(){
		rel = $(this).attr('rel');
		$('#dest span[rel!='+rel+']').removeClass('label-info');
		$(this).addClass('label-info');
		check_filter();
	});
	
		
});
</script>