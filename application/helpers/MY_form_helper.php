<?php
function open_control ()
{
	return '<div class="control-group"><div class="controls">';	
}

function close_control()
{
	return '<span class="help-inline"></span></div></div>';
}

function format_error($ci_form_error)
{
	$errors = explode('|',$ci_form_error);
	unset($errors[count($errors)-1]);

	foreach($errors as $fail):
		if($fail != ''):
			$tag_attr_name = preg_match('/{(.*)}/', $fail,$matches);
			$tag_attr_name = @$matches[1];
			$f_errors[$tag_attr_name] = str_replace(@$matches[0],'',$fail);
		endif;
	endforeach;

	return $f_errors;
}