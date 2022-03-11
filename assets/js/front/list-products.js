jQuery(document).ready(function() {
    jQuery('.gm_pv_count_likes_container').on('click', function() {
        let likeElem = jQuery(this);
        if (likeElem.attr('data-status') === 'not_clicked') {
            const idProd = likeElem.parents('.gm_pv_product').attr('data-id-product');


            jQuery.ajax({
                url: ajaxurl.ajaxurl,
                dataType: 'json',
                method: 'POST',
                data: {
                    action: 'increment_likes',
                    idProd: idProd,
                },
                success: function(result) {
                    console.log(result);

                    if (result.res) {
                        likeElem.attr('data-status', 'checked');
                        likeElem.find('span').css('color', '#0c71c3');
                        const newCountLikes = parseInt(likeElem.find('.gm_pv_count_likes').text()) + 1;
                        likeElem.find('p').text('Piaciuto! | ' + newCountLikes);
                    }
                }
            });


            /*
            jQuery.get(
                ajaxurl.ajaxurl, {
                    'action': 'jp_ajax_test',
                    'nonce' : ajaxurl.nonce,
                },
                function( response ) {
                   console.log(response);
                }
            );
            */


        }
    });
});
