<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Admin\AdminShowProducts;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

class AddProductController
{
    public static function addProduct(
        $titleProd = null,
        $urlVideo = null,
        $categories = null
    ) {
        if (!isset($titleProd) && isset($_GET['name_product'])) {
            $titleProd = $_GET['name_product'];
        }

        if (!isset($urlVideo) && isset($_GET['url_video'])) {
            $urlVideo = $_GET['url_video'];
        }

        if (!isset($categories) && isset($_GET['categories_select'])) {
            $categories = $_GET['categories_select'];
        }

        if (!isset($urlVideo, $titleProd)) {
            self::forwardResponse('error');
        }

        $prodObj = new Product();

        $prodObj->title_product = $titleProd;
        $prodObj->url_video = $urlVideo;

        if (($idProd = Product::addProduct($prodObj)) !== false) {
            if (!empty($categories)) {
                $prodObj->id = (int)$idProd;
                foreach ($categories as $cat) {
                    $catProdObj = new CategoryProduct($prodObj->id, (int)$cat);
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
        $url = get_site_url().'/wp-admin/admin.php?page=' . AdminShowProducts::$menuSlag;
        $parameters = '';

        if ('success' == $result) {
            //parameters to send
            $parameters = '&type_alert=success&message_alert=The new product was successfully added.';
        } elseif ('error' == $result) {
            $parameters = '&type_alert=danger&message_alert=There was an error. Try again to add the product.';
        }

        wp_safe_redirect($url . $parameters);
        exit();

    }
}
