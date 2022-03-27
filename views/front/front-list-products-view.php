<link rel="stylesheet" type="text/css" href="<?php echo get_site_url(null, 'wp-content/plugins/gm-productvideo/assets/css/front/list-products.css') ?>">
<div class="gm_pv_container_list_products">
    <div class="gm_pv_header">
        <h2><?php echo $nameCategory ?? '' ?></h2>
    </div>
    <div class="gm_pv_container_products">
        <?php if(isset($products) && count($products) > 0) {
            foreach ($products as $product) {

                $splittedUrl = explode("/", $product->url_video);
                $embedCodeYT = $splittedUrl[count($splittedUrl) - 1];
            ?>
                <div class="gm_pv_product" id="product_<?php echo $product->id ?>" data-id-product="<?php echo $product->id ?>">
                    <div class="gm_pv_container_video" id="gm_pv_container_video_<?php echo $product->id ?>">
                        <div class="gm_pv_video" id="gm_pv_video_<?php echo $product->id ?>"></div>
                        <div class="gm_pv_preview_video" data-embed-code="<?php echo $embedCodeYT ?>">
                            <img src="<?php echo get_site_url() ?>/wp-content/plugins/gm-productvideo/assets/img/player-start.png" />
                        </div>
                        <style>
                            #gm_pv_container_video_<?php echo $product->id ?> {
                                background: url(https://img.youtube.com/vi/<?php echo $embedCodeYT ?>/mqdefault.jpg);
                            }
                        </style>
                    </div>
                    <div class="gm_pv_container_info">
                        <div class="gm_pv_container_title">
                            <?php if (strlen($product->title_product) > 40) { ?>
                                <h4 class="gm_pv_title_desktop"><?php echo substr($product->title_product, 0, 40) . '...' ?></h4>
                                <h4 class="gm_pv_title_mobile"><?php echo $product->title_product ?></h4>
                            <?php } else { ?>
                                <h4><?php echo $product->title_product ?></h4>
                            <?php } ?>
                        </div>
                        <div class="gm_pv_extra_content">
                            <?php if (isset($extraContent)) { echo $extraContent; } ?>
                            <div class="gm_pv_count_likes_container" data-status="not_clicked">
                                <span class="dashicons dashicons-heart"></span>
                                <div class="gm_pv_text_count_likes desktop"><p>Mi piace | <span class="gm_pv_count_likes"><?php echo $product->count_likes ?></span></p></div>
                                <div class="gm_pv_text_count_likes mobile"><p><span class="gm_pv_count_likes_mobile"><?php echo $product->count_likes ?></span></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
         } else { ?>
            <p class="gm_pv_no_products">There are no products yet.</p>
        <?php } ?>
    </div>
</div>

<?php
include(GM_PV__PLUGIN_DIR . 'views/parts/pagination.php');
?>