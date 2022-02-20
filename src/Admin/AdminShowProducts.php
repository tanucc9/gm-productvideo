<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Controller\DeleteProductController;
use GMProductVideo\Controller\EditProductController;
use GMProductVideo\Model\Product;
use GMProductVideo\Utilities\AdminListProducts;
use GMProductVideo\Utilities\CustomAdminListTable;

class AdminShowProducts
{
    public static $menuSlag = PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo';
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
            self::$menuSlag,
            [$this, 'admin_page_content_showProducts']
        );
    }

    public function admin_page_content_showProducts()
    {
        // Send request to admin edit product to show edit page
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            $editProductPage = new AdminEditProduct((int)$_GET['id']);
            $editProductPage->display();
        } elseif (isset($_GET['action']) && $_GET['action'] === 'view') { //view prod page
            $viewProductPage = new AdminViewProduct((int)$_GET['id']);
            $viewProductPage->display();
        } else {

            // Delete product
            if (
                isset($_GET['action']) && $_GET['action'] === 'delete' ||
                isset($_GET['action2']) && $_GET['action2'] === 'delete'
            ) {
                $alerts = DeleteProductController::deleteProduct();
                $alertType = $alerts['alertType'];
                $alertMessage = $alerts['alertMessage'];
            }

            // Update the datas on db
            if (isset($_GET['action']) && $_GET['action'] === 'submit_edit') {
                $alerts = EditProductController::editProduct();
                $alertType = $alerts['alertType'];
                $alertMessage = $alerts['alertMessage'];
            }

            //Check if there are some alerts in get params
            if (isset($_GET['type_alert'])) {
                $alertType = $_GET['type_alert'];
                $alertMessage = $_GET['message_alert'];
            }

            $listProductsObj = new AdminListProducts();
            $currPagePagination = $_GET['paged'] ?? 1;
            $listProductsObj->prepareProducts($currPagePagination);

            // vars admin header
            $urlNewElem = admin_url('admin.php?page=' . AdminAddProduct::$menuSlag);
            $textBtnNewElem = 'Add new Product';
            $titleHeader = 'Products';

            include GM_PV__PLUGIN_DIR.'views/admin/admin-products-view.php';
        }
    }
}
