<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Utilities\CustomAdminListTable;

class AdminShowCategories
{
    public static $menuSlag = PARENT_SLUG_ADMIN_TAB.'-pv-show-categoriesvideo';

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
        /*$myListTable = new CustomAdminListTable();
        echo '<div class="wrap"><h2>My List Table Test</h2>';
        $myListTable->prepare_items();
        echo '<form id="events-filter" method="get">
    <input type="hidden" name="page" value="' .$_REQUEST['page']. '" />';
        $myListTable->display();
        echo '</form>';
        echo '</div>';*/

        //include GM_PV__PLUGIN_DIR.'views/admin/admin-products-view.php';
    }
}

