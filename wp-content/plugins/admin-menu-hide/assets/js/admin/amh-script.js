(function($){
    $(document).on( 'click', '#save-admin-menu-items', function(e){
        e.preventDefault();
        var idMenu, data;

        data = $('#amh-form').serialize();


        $("#amh-form input").each(function(){

            if( $(this).attr("checked") !== 'checked' ){
                idMenu = $(this).val();
                $('#adminmenu li#'+idMenu ).show();
            }else {
                idMenu = $(this).val();
                $('#adminmenu li#'+idMenu ).hide();
            }
        });

        ajaxData = {};
        ajaxData.data = data;
        ajaxData.action = amhObj.action;
        ajaxData.security = amhObj.security;

        $.post( amhObj.ajax_url, ajaxData, function(response){

            if( response.status === 1 ){
                console.log(response);
            } else {
                console.log(response);
            }

        });


    });
})(jQuery);