<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Controller\AddProductController;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

class AdminAddProduct
{
    public static $menuSlag = PARENT_SLUG_ADMIN_TAB.'-pv-add-productvideo';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_submenu_addProduct']);
    }

    public function admin_submenu_addProduct()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Add new product',
            'Add new product',
            'manage_options',
            self::$menuSlag,
            [$this, 'admin_page_content_addProduct']
        );
    }

    public function admin_page_content_addProduct()
    {
        if (isset($_POST['action']) && 'add_product' == $_POST['action']) {
            AddProductController::addProduct();
        }

        if (isset($_GET['type_alert'])) {
            $alertType = $_GET['type_alert'];
            $alertMessage = $_GET['message_alert'];
        }

        // vars admin header
        $titleHeader = 'Add new product';

        include GM_PV__PLUGIN_DIR.'views/admin/admin-addproduct-view.php';
    }
}
