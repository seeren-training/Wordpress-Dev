console.log(redirection_list)

jQuery(document).ready(($) => {     

    $('body').click(() => {
        console.log(redirection_list);
        jQuery.ajax({
            url: redirection_list.ajax_url,
            
            data:{
                action: 'handle_request',
                _ajax_nonce: redirection_list.nonce
            },
            success: () => {
                console.log('success');
            },
            error: () => {
                console.log('error');
            },
        });
    });

});