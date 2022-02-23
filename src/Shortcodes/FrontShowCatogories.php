<?php

namespace GMProductVideo\Shortcodes;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

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
        if (empty($atts) && isset($atts['id_category'])) {
            return '';
        }

        $idCategory = (int) $atts['id_category'];
        $currentPage = (int) ($_GET['page_to_show'] ?? 1);
        $products = Category::getAssociatedProducts($idCategory, $currentPage);

        if (count($products) > 0) {
            $totPages = CategoryProduct::getTotNumPagesProductsAssociatedToCategory($idCategory);
            $isLastPage = $currentPage === $totPages;
            $isFirstPage = $currentPage === 1;
            $nameCategory = Category::getTitleByIdCategory($idCategory);

            include GM_PV__PLUGIN_DIR.'views/front/front-list-products-view.php';
        }
    }
}
