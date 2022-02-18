<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

class AddProductController
{
    public static function addProduct(
        $titleProd = null,
        $urlVideo = null,
        $categories = null
    ) {
        if (!isset($titleProd) && isset($_POST['name_product'])) {
            $titleProd = $_POST['name_product'];
        }

        if (!isset($urlVideo) && isset($_POST['url_video'])) {
            $urlVideo = $_POST['url_video'];
        }

        if (!isset($categories) && isset($_POST['categories_select'])) {
            $categories = $_POST['categories_select'];
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
                    if (CategoryProduct::addCategoryProduct($catProdObj)) {
                        self::forwardResponse('success');
                    }
                }
            } else {
                self::forwardResponse('success');
            }
        }

        self::forwardResponse('error');
    }

    protected static function forwardResponse($result)
    {
        if ('success' == $result) {
            //parameters to send
            $parameters = '&type_alert=success&message_alert=The new product was successfully added.';
            $url = get_site_url().'/wp-admin/admin.php?page=gm-prodotti-pv-show-productsvideo'.$parameters;

            wp_safe_redirect($url);
            exit();
        } elseif ('error' == $result) {
            $parameters = '&type_alert=danger&message_alert=There was an error. Try again to add the product.';
            $url = get_site_url().'/wp-admin/admin.php?page=gm-prodotti-pv-add-productvideo'.$parameters;

            wp_safe_redirect($url);
            exit();
        }
    }
}
