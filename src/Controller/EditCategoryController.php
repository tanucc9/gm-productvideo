<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

class EditCategoryController
{
    /**
     * Perform the update if all datas are corrects.
     * @param string|null $titleCat
     * @param int|null $idCat
     * @return array the type and message of the alert
     */
    public static function editCategory(
        string $titleCat = null,
        int $idCat = null,
        string $idsProduct = null
    ): array {
        $hasError = false;

        if (!isset($idCat) && isset($_GET['id'])) {
            $idCat = $_GET['id'];
        }
        if (!isset($titleCat) && isset($_GET['name_category'])) {
            $titleCat = $_GET['name_category'];
        }

        if (!isset($idsProduct) && !empty($_GET['products_select'])) {
            $idsProduct = $_GET['products_select'];
        }

        if (isset($titleCat, $idCat)) {
            $datasToUpdate = [
                'title_category' => $titleCat,
            ];

            $result = Category::updateCategory(
                $datasToUpdate,
                ['id_category' => $idCat]
            );
            if ($result === false) {
                $hasError = true;
            }

            // associations categories / product
            CategoryProduct::deleteAllRecordsByIdCategory($idCat);
            foreach ($idsProduct as $idProd) {
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
