<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Admin\AdminShowCategories;
use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;

class AddCategoryController
{
    public static function addCategory(
        $titleCat = null,
        $products = null
    ) {
        if (!isset($titleCat) && isset($_GET['name_category'])) {
            $titleCat = $_GET['name_category'];
        }

        if (!isset($products) && isset($_GET['products_select'])) {
            $products = $_GET['products_select'];
        }

        if (!isset($titleCat)) {
            self::forwardResponse('error');
        }

        $catObj = new Category();

        $catObj->title_category = $titleCat;

        if (($idCat = Category::addCategory($catObj)) !== false) {
            if (!empty($products)) {
                $catObj->id = (int)$idCat;
                foreach ($products as $prod) {
                    $catProdObj = new CategoryProduct((int)$prod, $catObj->id);
                    if (CategoryProduct::addCategoryProduct($catProdObj) === false) {
                        self::forwardResponse('error');
                    }
                }
            }

            self::forwardResponse('success');
        }

        self::forwardResponse('error');
    }

    protected static function forwardResponse($result)
    {
        $url = get_site_url().'/wp-admin/admin.php?page=' . AdminShowCategories::$menuSlag;
        $parameters = '';

        if ('success' == $result) {
            //parameters to send
            $parameters = '&type_alert=success&message_alert=The new category was successfully added.';

        } elseif ('error' == $result) {
            $parameters = '&type_alert=danger&message_alert=There was an error. Try again to add the category.';
        }

        wp_safe_redirect($url . $parameters);
        exit();
    }
}
