<?php

namespace GMProductVideo\Shortcodes;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Admin\AdminSettings;
use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;

class FrontShowCatogories
{
    public static $shortcodeName = 'gm_pv_showcategory';

    public function __construct()
    {
        add_shortcode(self::$shortcodeName, [$this, 'showCategories']);
    }

    public function showCategories($atts = [], $content = null, $tag = '')
    {
        if (empty($atts) || !isset($atts['id_category'])) {
            return '';
        }

        $idCategory = (int) $atts['id_category'];
        $currentPage = (int) ($_GET['page_to_show'] ?? 1);
        $limit = 10;

        if (!empty($atts['preview'])) {
            $preview = (int) $atts['preview'];
            $limit = $preview;
        }

        $products = Category::getAssociatedProducts(
            $idCategory,
            $currentPage,
            $limit
        );

        if (count($products) > 0) {
            if (!isset($preview)) { //Because if it is a preview we don't want to show the pagination
                $totPages = CategoryProduct::getTotNumPagesProductsAssociatedToCategory($idCategory);
                $isLastPage = $currentPage === $totPages;
                $isFirstPage = $currentPage === 1;
            }

            $nameCategory = Category::getTitleByIdCategory($idCategory);

            //options
            $hasShowStaticContent = (bool)get_option(AdminSettings::$optionShowStaticContent);
            if ($hasShowStaticContent) {
                $urlFb = get_option(AdminSettings::$optionUrlFb);
                $urlInsta = get_option(AdminSettings::$optionUrlInsta);

                if ($urlFb && $urlInsta) {
                    $extraContent = '<div class="gm_pv_description">
                            <p>Per info e prezzi:</p>
                            <a href="' . $urlFb . '" target="_blank">
<img src="' . get_site_url() . '/wp-content/plugins/gm-productvideo/assets/img/facebook-icon.png" />
</a>
<a href="' . $urlInsta . '" target="_blank">
    <img src="' . get_site_url() . '/wp-content/plugins/gm-productvideo/assets/img/insta-icon.png" />
</a>
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
