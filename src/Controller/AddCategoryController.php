<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;

class AddCategoryController
{
    public static function addCategory(
        $titleCat = null,
        $products = null
    ): array {
        if (!isset($titleCat) && isset($_GET['name_category'])) {
            $titleCat = $_GET['name_category'];
        }

        if (!isset($products) && isset($_GET['products_select'])) {
            $products = $_GET['products_select'];
        }

        $hasError = false;

        if (!isset($titleCat)) {
            $hasError = true;
        }

        $catObj = new Category();
        $catObj->title_category = $titleCat;

        if (($idCat = Category::addCategory($catObj)) !== false && !$hasError) {
            if (!empty($products)) {
                $catObj->id = (int)$idCat;
                foreach ($products as $prod) {
                    $catProdObj = new CategoryProduct((int)$prod, $catObj->id);
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
                'alertMessage' => 'Category ' . $titleCat . ' added'
            ];
        } else {
            return [
                'alertType' => 'danger',
                'alertMessage' => 'Category not added. There was an error'
            ];
        }
    }
}
