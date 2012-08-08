var redirect_delay_time = 5

function do_redirect()
{
	
}

function clear_form_elements(ele) {

    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}


$(document).ready(function(){
	
	/*
	 * Ajax form,  generic
	 */
	$('.ajax_form').live('submit',function(){
		
		action_type = $("input[name=action_type]").val();
		data = $(this).serialize();	
		
		submit_initial_val = $('.ajax_form input[type=submit]').attr('value');
		$('.ajax_form .help-inline').empty();
		$('.ajax_form .control-group').removeClass('error');
		
		$("#result").empty();	
		
		$('.ajax_form *').attr("disabled", "disabled");
		$('.ajax_form input[type=submit]').attr('value','Loading stuff ...');

		var jqxhr = $.ajax({
			  url: 		this.action,
			  type: 	this.method,
			  data: 	data,
		});

		jqxhr.done(function(data) {
			
			if(data.status == 'win') {
				$("#result").append('<div class="alert alert-success"><strong>Success:</strong> '+data.message+'</div>');
				
				if(action_type != 'update')
					clear_form_elements('.ajax_form');
				
				if(data.redirect) {
					window.setTimeout (function() {window.location = data.redirect;},5000);
				}
			}

			if(data.status == 'fail') {
				$("#result").append('<div class="alert alert-error"><strong>Error:</strong> '+data.message+'</div>');
				
				$.each(data.fileds,function(x,y){
					root_element = $('input[name='+x+']').parent().parent();
					root_element.addClass('error');
					root_element.children().children('.help-inline').append(y);
					
					root_element = $('textarea[name='+x+']').parent().parent();
					root_element.addClass('error');
					root_element.children().children('.help-inline').append(y);
					
					root_element = $('select[name='+x+']').parent().parent();
					root_element.addClass('error');
					root_element.children().children('.help-inline').append(y);
				});
			}
			
		});

		jqxhr.fail(function(jqXHR, textStatus) {
			  $("#result").append('<div class="alert alert-error"><strong>Request Error: '+textStatus+'</strong></div>');
		});

		jqxhr.always(function(){ 
			$('.ajax_form *').removeAttr('disabled');
			$('.ajax_form input[type=submit]').attr('value',submit_initial_val);
		});

		return false;

	});
	
});