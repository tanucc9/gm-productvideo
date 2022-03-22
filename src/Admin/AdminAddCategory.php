<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Controller\AddCategoryController;
use GMProductVideo\Model\Product;

class AdminAddCategory
{
    public static $menuSlag = PARENT_SLUG_ADMIN_TAB.'-pv-add-category';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_submenu_addCategory']);
    }

    public function admin_submenu_addCategory()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Add new category',
            'Add new category',
            'manage_options',
            self::$menuSlag,
            [$this, 'admin_page_content_addCategory'],
            2
        );
    }

    public function admin_page_content_addCategory()
    {
        if (isset($_GET['action']) && 'add_category' === $_GET['action']) {
            $alerts = AddCategoryController::addCategory();
            $alertType = $alerts['alertType'];
            $alertMessage = $alerts['alertMessage'];
        }

        // vars admin header
        $titleHeader = 'Add new category';

        $products = Product::doRetrieveAll(null, null, 'title_product');

        $action = 'add_category';
        $textSubmitBtn = 'Save';

        include GM_PV__PLUGIN_DIR.'views/admin/admin-category-view.php';
    }
}
