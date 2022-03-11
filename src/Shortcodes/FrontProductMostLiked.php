<?php

namespace GMProductVideo\Shortcodes;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Admin\AdminSettings;
use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

class FrontProductMostLiked
{
    public static $shortcodeName = 'gm_pv_most_liked_products';

    public function __construct()
    {
        add_shortcode(self::$shortcodeName, [$this, 'mostLikedProducts']);
    }

    public function mostLikedProducts()
    {
        $products = Product::doRetrieveAll(
            1,
            9,
            'count_likes',
            'desc'
        );

        if (count($products) > 0) {

            $nameCategory = 'Made in Italy';

            //options
            $hasShowStaticContent = (bool)get_option(AdminSettings::$optionShowStaticContent);
            if ($hasShowStaticContent) {
                $urlFb = get_option(AdminSettings::$optionUrlFb);
                $urlInsta = get_option(AdminSettings::$optionUrlInsta);

                if ($urlFb && $urlInsta) {
                    $extraContent = '<div class="gm_pv_description">
                            <p>Per info e prezzi:</p>
                            <div class="gm_pv_container_icons_social"><a href="' . $urlFb . '" target="_blank">
<img src="' . get_site_url() . '/wp-content/plugins/gm-productvideo/assets/img/facebook-icon.png" />
</a>
<a href="' . $urlInsta . '" target="_blank">
    <img src="' . get_site_url() . '/wp-content/plugins/gm-productvideo/assets/img/insta-icon.png" />
</a></div>
</div>';

                    $extraContent = apply_filters("gm_pv_edit_static_content", $extraContent);
                }
            }

            ob_start();
            include GM_PV__PLUGIN_DIR.'views/front/front-list-products-view.php';
            $output = ob_get_clean();
            return $output;
        }
    }
}
