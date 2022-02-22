<div class="gm_pv_container_list_products">
    <div class="gm_pv_header">

    </div>
    <div class="gm_pv_container_products">
        <?php if(isset($products) && count($products) > 0) {
            foreach ($products as $product) { ?>
                <div class="gm_pv_product" id="product_<?php echo $product->id ?>">
                    <div class="gm_pv_container_video">
                        <iframe width="420" height="315"
                                src="https://www.youtube.com/embed/3chV1zYSj24">
                        </iframe>
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

<?php
include(GM_PV__PLUGIN_DIR . 'views/parts/pagination.php');
?>