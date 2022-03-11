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
    ): array {
        if (!isset($titleProd) && isset($_GET['name_product'])) {
            $titleProd = $_GET['name_product'];
        }

        if (!isset($urlVideo) && isset($_GET['url_video'])) {
            $urlVideo = $_GET['url_video'];
        }

        if (!isset($categories) && isset($_GET['categories_select'])) {
            $categories = $_GET['categories_select'];
        }

        $hasError = false;

        if (!isset($urlVideo, $titleProd)) {
            $hasError = true;
        }

        $prodObj = new Product();
        $prodObj->title_product = $titleProd;
        $prodObj->url_video = $urlVideo;

        if (($idProd = Product::addProduct($prodObj)) !== false && !$hasError) {
            if (!empty($categories)) {
                $prodObj->id = (int)$idProd;
                foreach ($categories as $cat) {
                    $catProdObj = new CategoryProduct($prodObj->id, (int)$cat);
                    if (CategoryProduct::addCategoryProduct($catProdObj) === false) {
                        $hasError = true;
                    }
                }
            }
        } else {
            $hasError = true;
        }

        if (!$hasError) {
            return [
                'alertType' => 'success',
                'alertMessage' => 'Product ' . $titleProd . ' added'
            ];
        } else {
            return [
                'alertType' => 'danger',
                'alertMessage' => 'Product not added. There was an error'
            ];
        }
    }
}
