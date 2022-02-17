<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Model\Product;
use GMProductVideo\Utilities\AdminListProducts;
use GMProductVideo\Utilities\CustomAdminListTable;

class AdminShowProducts
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_submenu_ShowProducts']);
    }

    public function admin_submenu_ShowProducts()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Show Products',
            'Show Products',
            'manage_options',
            PARENT_SLUG_ADMIN_TAB.'-pv-show-productsvideo',
            [$this, 'admin_page_content_showProducts']
        );
    }

    public function admin_page_content_showProducts()
    {
        // Delete product
        if (isset($_GET['action']) && $_GET['action'] === 'delete') {
            if (Product::deleteProduct((int)$_GET['id']) !== false) {
                $alertType = 'success';
                $alertMessage = 'Product ' . $_GET['id'] . ' has been removed';
            } else {
                $alertType = 'danger';
                $alertMessage = 'There was an erro on removing product ' . $_GET['id'];
            }
        }

        $listProductsObj = new AdminListProducts();
        $listProductsObj->prepareProducts();

        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            include GM_PV__PLUGIN_DIR.'views/admin/admin-editproduct-view.php';
        } else {
            include GM_PV__PLUGIN_DIR.'views/admin/admin-products-view.php';
        }

        /*
        $currentPage = isset($_GET['page_to_show']) ? (int) $_GET['page_to_show'] : 1;
        $products = self::getProducts($currentPage);
        $totPages = Product::getTotNumPages();
        $isLastPage = $currentPage === $totPages;
        $isFirstPage = $currentPage === 1;

        /*
        if (isset($_GET['type_alert'])) {
            $type_alert = $_GET['type_alert'];
            $title_alert = $_GET['title_alert'];
            $message_alert = $_GET['message_alert'];
        }
        */

        //include GM_PV__PLUGIN_DIR.'views/admin/admin-products-view.php';
    }
}
