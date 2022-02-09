<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class AdminProduct
{
    /*
    public static function admin_submenu_addProduct()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Aggiungi nuovo prodotto',
            'Aggiungi nuovo prodotto',
            'manage_options',
            PARENT_SLUG_ADMIN_TAB.'-pv-add-productvideo',
            'call_admin_page_content_addProduct'
        );
    }

    public static function admin_page_content_addProduct()
    {
        $tanucc="tanu si fort";



        if (isset($_POST['action'])) {
            self::addProduct();
        }

        include(GM_PV__PLUGIN_DIR.'views/admin/admin-addproduct-view.php');
    }

    public static function addProduct()
    {
        $name_prod = $_POST['name_product'];
        $category = $_POST['category_select'];
        $url_video = $_POST['url_video'];
    }
    */
}
