<div class="gm_pv_container_list_products">
    <div class="gm_pv_header">

    </div>
    <div class="gm_pv_container_products">
        <?php if(isset($products) && count($products) > 0) {
            foreach ($products as $product) {
                $embedCodeYT = explode("https://www.youtube.com/embed/", $product->url_video)[1];
            ?>
                <div class="gm_pv_product" id="product_<?php echo $product->id ?>" data-id-product="<?php echo $product->id ?>">
                    <div class="gm_pv_container_video">
                        <div class="gm_pv_video" id="gm_pv_video_<?php echo $product->id ?>"></div>
                        <div class="gm_pv_preview_video" data-embed-code="<?php echo $embedCodeYT ?>">
                            <img src="<?php echo get_site_url() ?>/wp-content/plugins/gm-productvideo/assets/img/player-start.png" />
                        </div>
                        <style>
                            .gm_pv_container_video {
                                background: url(https://img.youtube.com/vi/<?php echo $embedCodeYT ?>/sddefault.jpg);
                            }
                        </style>
                    </div>
                    <div class="gm_pv_container_info">
                        <div class="gm_pv_container_title">
                            <h4><?php echo $product->title_product ?></h4>
                        </div>
                    </div>
                </div>
            <?php }
         } else { ?>
            <p class="gm_pv_no_products">There are no products yet.</p>
        <?php } ?>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo get_site_url(null, 'wp-content/plugins/gm-productvideo/assets/css/front/list-products.css') ?>">
<script type="application/javascript" src="<?php echo get_site_url(null, 'wp-content/plugins/gm-productvideo/assets/js/front/lazy-load-video-yt.js') ?>"></script>

<?php
include(GM_PV__PLUGIN_DIR . 'views/parts/pagination.php');
?>