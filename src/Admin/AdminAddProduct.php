<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

use GMProductVideo\Model\Product;
use GMProductVideo\Model\CategoryProduct;

class AdminAddProduct
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_submenu_addProduct'));
    }

    public function admin_submenu_addProduct()
    {
        add_submenu_page(
            PARENT_SLUG_ADMIN_TAB,
            'Add new product',
            'Add new product',
            'manage_options',
            PARENT_SLUG_ADMIN_TAB.'-pv-add-productvideo',
            array($this, 'admin_page_content_addProduct')
        );
    }

    public function admin_page_content_addProduct()
    {
        if (isset($_POST['action']) && $_POST['action'] == "add_product") {
            $this->addProduct();
        }

        if (isset($_GET['type_alert'])) {
            $type_alert = $_GET['type_alert'];
            $title_alert = $_GET['title_alert'];
            $message_alert = $_GET['message_alert'];
        }

        include(GM_PV__PLUGIN_DIR.'views/admin/admin-addproduct-view.php');
    }

    public function addProduct()
    {
        $prodObj = new Product();

        $prodObj->title_product = $_POST['name_product'];
        $prodObj->url_video = $_POST['url_video'];
        $category = $_POST['category_select'];

        if (Product::addProduct($prodObj)) {
            if ((int)$category != 0) {
                $catProdObj = new CategoryProduct($prodObj->id, $category);
                if (CategoryProduct::addCategoryProduct($catProdObj)) {
                    self::forwardResponse("success");
                }
            } else {
                self::forwardResponse("success");
            }
        }

        self::forwardResponse("error");
    }

    public static function forwardResponse($result)
    {
        if ($result == "success") {
            //parameters to send
            $parameters = "&type_alert=alert-success&title_alert=Done!&message_alert=The new product was successfully added.";
            $url = get_site_url() ."/wp-admin/admin.php?page=gm-prodotti-pv-show-productsvideo" . $parameters;

            wp_safe_redirect($url);
        } elseif ($result == "error") {
            $parameters = "&type_alert=alert-danger&title_alert=Error!&message_alert=There was an error. Try again to add the product.";
            $url = get_site_url() ."/wp-admin/admin.php?page=gm-prodotti-pv-add-productvideo" . $parameters;

            wp_safe_redirect($url);
        }
    }
}
