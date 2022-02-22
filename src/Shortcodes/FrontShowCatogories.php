<?php

namespace GMProductVideo\Shortcodes;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Category;

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
        $products = Category::getAssociatedProducts($idCategory);

        //@todo template to show
    }
}
