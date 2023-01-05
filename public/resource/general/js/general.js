function messageManagement(code)
{
	if(code.code <= 206)
	{
		alertify.success(code.message, code.time);
	}
	else if(code.code >= 300 && code.code <= 305)
	{
        alertify.warning(code.message, code.time);
	}
    else if(code.code >= 400 && code.code <= 415)
	{
        alertify.error(code.message, code.time);
	}
    else if(code.code >= 500 && code.code <= 515)
    {
        alertify.notify(code.message, code.time);
    }
}

function dataGetDisabled(){
    $('.data-get').prop('disabled', true);
    $('.loader').css("opacity", '1');
}

function dataGetEnabled(){
    $('.data-get').prop('disabled', false);
    $('.loader').css("opacity", '0');
}

function disabledForm(form){
    $(form).find('button').prop('disabled', true);
}

function enabledForm(form){
    $(form).find('button').prop('disabled', false);
    $(form).trigger('reset');
}
