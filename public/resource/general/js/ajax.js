function ajaxGet(url, arg)
{
    return $.ajax({
        beforeSend: function(){
            $(arg).prop("disabled", true);
            $('.data-get').prop('disabled', true);
        },
        type: 'get',
        url: url,
        complete: function(){
            setTimeout(function(){
                $('.data-get').prop('disabled', false);
            }, 200);
        }
    });
}


$('body').on('click', '.data-get', function(e) {
    arg = this;
    get = $(arg).attr("data-get");
    ajaxGet(get).done(function(data){
        var json = $.parseJSON(data);
        messageManagement(json);
    });
});


$('body').on('click', '.data-del', function(e) {
    arg = this;
    get = $(arg).attr("data-get");

    alertify.confirm('Silmək istədiyinizə əminsiniz???', function(){ 
        ajaxGet(get, arg).done(function(data){
            $(arg).parents('table tr').hide();
            
            var json = $.parseJSON(data);
            messageManagement(json);
        });
    });
});