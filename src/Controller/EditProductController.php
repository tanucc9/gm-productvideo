<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

class EditProductController
{
    /**
     * Perform the update if all datas are corrects.
     * @param string|null $titleProd
     * @param string|null $urlProd
     * @var int|null $idProd
     * @return array the type and message of the alert
     */
    public static function editProduct(
        string $titleProd = null,
        string $urlProd = null,
        int $idProd = null,
        string $idsCategory = null
    ): array {
        $hasError = false;

        if (!isset($idProd) && isset($_GET['id'])) {
            $idProd = $_GET['id'];
        }
        if (!isset($titleProd) && isset($_GET['name_product'])) {
            $titleProd = $_GET['name_product'];
        }
        if (!isset($urlProd) && isset($_GET['url_video'])) {
            $urlProd = $_GET['url_video'];
        }
        if (!isset($idsCategory) && !empty($_GET['categories_select'])) {
            $idsCategory = $_GET['categories_select'];
        }

        if (isset($titleProd, $urlProd, $idProd)) {
            $datasToUpdate = [
                'title_product' => $titleProd,
                'url_video' => $urlProd,
            ];

            $result = Product::updateProduct(
                $datasToUpdate,
                ['id_product' => $idProd]
            );
            if ($result === false) {
                $hasError = true;
            }

            // associations categories / product
            CategoryProduct::deleteAllRecordsByIdProduct($idProd);
            foreach ($idsCategory as $idCat) {
                $catProd = new CategoryProduct($idProd, $idCat);
                if (CategoryProduct::addCategoryProduct($catProd) === false) {
                    $hasError = true;
                }
            }
        } else {
            $hasError = true;
        }

        if (!$hasError) {
            return [
                'alertType' => 'success',
                'alertMessage' => 'Product ' . $idProd . ' updated'
            ];
        } else {
            return [
                'alertType' => 'danger',
                'alertMessage' => 'Product not updated. There was an error'
            ];
        }
    }
}
