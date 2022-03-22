<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Controller\DeleteCategoryController;
use GMProductVideo\Controller\EditCategoryController;
use GMProductVideo\Utilities\AdminListCategories;

class AdminShowCategories
{
    public static $menuSlag = PARENT_SLUG_ADMIN_TAB . '-pv-show-categoriesvideo';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_submenu_ShowCategories']);
    }

    public function admin_submenu_ShowCategories()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Show Categories',
            'Show Categories',
            'manage_options',
            self::$menuSlag,
            [$this, 'admin_page_content_showCategories']
        );
    }

    public function admin_page_content_showCategories()
    {
        // Send request to admin edit product to show edit page
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            $editCatPage = new AdminEditCategory((int)$_GET['id']);
            $editCatPage->display();
        } elseif (isset($_GET['action']) && $_GET['action'] === 'view') { //view prod page
            $viewCatPage = new AdminViewCategory((int)$_GET['id']);
            $viewCatPage->display();
        } else {

            // Delete product
            if (
                isset($_GET['action']) && $_GET['action'] === 'delete' ||
                isset($_GET['action2']) && $_GET['action2'] === 'delete'
            ) {
                $alerts = DeleteCategoryController::deleteCategory();
                $alertType = $alerts['alertType'];
                $alertMessage = $alerts['alertMessage'];
            }

            // Update the datas on db
            if (isset($_GET['action']) && $_GET['action'] === 'submit_edit') {
                $alerts = EditCategoryController::editCategory();
                $alertType = $alerts['alertType'];
                $alertMessage = $alerts['alertMessage'];
            }

            //Check if there are some alerts in get params
            if (isset($_GET['type_alert'])) {
                $alertType = $_GET['type_alert'];
                $alertMessage = $_GET['message_alert'];
            }

            $listTableObj = new AdminListCategories();
            $currPagePagination = $_GET['paged'] ?? 1;
            $listTableObj->prepareCategories($currPagePagination);

            // vars admin header
            $urlNewElem = admin_url('admin.php?page=' . AdminAddCategory::$menuSlag);
            $textBtnNewElem = 'Add new Category';
            $titleHeader = 'Categories';

            include GM_PV__PLUGIN_DIR.'views/admin/admin-list-view.php';
        }
    }
}

