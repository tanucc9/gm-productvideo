<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\Product;

class DeleteCategoryController
{
    /** Delete an element or a group of elements
     * @var int | array $idCategory
     * @return array contains the info about alerts
     */
    public static function deleteCategory($idCategory = null): array
    {
        if (!isset($idCategory) && isset($_GET['id'])) {
            $idCategory = $_GET['id'];
        }

        if (!is_array($idCategory)) {
            $idCategory = [$idCategory];
        }

        if (empty($idCategory)) {
            $alertType = 'danger';
            $alertMessage = 'There was an erro on removing category';
        } else {
            $alertMessage = '';
            foreach ($idCategory as $idCat) {
                if (Category::deleteCategory($idCat) !== false) {
                    $alertType = 'success';
                    $alertMessage .= 'Category ' . $idCat . ' has been removed <br/>';
                } else {
                    $alertType = 'danger';
                    $alertMessage .= 'There was an error on removing category ' . $idCat . ' <br/>';
                }
            }
        }

        return [
            'alertType' => $alertType,
            'alertMessage' => $alertMessage,
        ];
    }
}
