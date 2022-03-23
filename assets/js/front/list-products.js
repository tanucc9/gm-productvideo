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
                        likeElem.find('.gm_pv_text_count_likes.desktop p').text('Piaciuto! | ' + newCountLikes);
                        likeElem.find('.gm_pv_count_likes_mobile').text(newCountLikes);
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

    if (iOS())
        jQuery(".gm_pv_container_video").addClass('gm_pv_container_video_ios');
});

function iOS() {
    return [
            'iPad Simulator',
            'iPhone Simulator',
            'iPod Simulator',
            'iPad',
            'iPhone',
            'iPod'
        ].includes(navigator.platform)
        // iPad on iOS 13 detection
        || (navigator.userAgent.includes("Mac") && "ontouchend" in document)
}