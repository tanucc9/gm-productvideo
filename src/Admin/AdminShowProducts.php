<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

use GMProductVideo\Model\Product;
use GMProductVideo\Model\CategoryProduct;

class AdminShowProducts
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_submenu_ShowProducts'));
    }
    public function admin_submenu_ShowProducts()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Show Products',
            'Show Products',
            'manage_options',
            PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo',
            array($this, 'admin_page_content_showProducts')
        );
    }

    public function admin_page_content_showProducts()
    {
        $products = self::getProducts();

        if (isset($_GET['type_alert'])) {
            $type_alert = $_GET['type_alert'];
            $title_alert = $_GET['title_alert'];
            $message_alert = $_GET['message_alert'];
        }

        include(GM_PV__PLUGIN_DIR . 'views/admin/admin-products-view.php');
    }

    public static function getProducts()
    {
        return Product::doRetrieveAll();
    }
}
