<?php

namespace GMProductVideo\Shortcodes;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Admin\AdminSettings;
use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Product;

class FrontShowProducts
{
    public static $shortcodeName = 'gm_pv_show_products';

    public function __construct()
    {
        add_shortcode(self::$shortcodeName, [$this, 'showProducts']);
    }

    public function showProducts($atts = [], $content = null, $tag = '')
    {
        if (empty($atts) || !isset($atts['type'])) {
            return '';
        }

        $orderBy = 'id_product';

        if ($atts['type'] === 'newest') {
            $orderBy = 'id_product';
        } elseif ($atts['type'] === 'most_liked') {
            $orderBy = 'count_likes';
        }

        $limit = 9;
        if (isset($atts['num_products'])) {
            $limit = (int) $atts['num_products'];
        }

        $products = Product::doRetrieveAll(
            1,
            $limit,
            $orderBy,
            'desc'
        );

        if (isset($products) && count($products) > 0) {

            if ($atts['type'] === 'newest') {
                $nameCategory = get_option(AdminSettings::$optionTitleNewestProd) ?? '';
            } elseif ($atts['type'] === 'most_liked') {
                $nameCategory = get_option(AdminSettings::$optionTitleMostLikedProd) ?? '';
            }

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
