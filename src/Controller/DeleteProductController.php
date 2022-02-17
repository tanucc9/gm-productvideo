<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\Product;

class DeleteProductController
{
    /** Delete an element or a group of elements
     * @var int | array $idProduct
     * @return array contains the info about alerts
     */
    public static function deleteProduct($idProduct = null): array
    {
        if (!isset($idProduct) && isset($_GET['id'])) {
            $idProduct = $_GET['id'];
        }

        if (!is_array($idProduct)) {
            $idProduct = [$idProduct];
        }

        if (empty($idProduct)) {
            $alertType = 'danger';
            $alertMessage = 'There was an erro on removing product';
        } else {
            $alertMessage = '';
            foreach ($idProduct as $idProd) {
                if (Product::deleteProduct($idProd) !== false) {
                    $alertType = 'success';
                    $alertMessage .= 'Product ' . $idProd . ' has been removed <br/>';
                } else {
                    $alertType = 'danger';
                    $alertMessage .= 'There was an error on removing product ' . $idProd . ' <br/>';
                }
            }
        }

        return [
            'alertType' => $alertType,
            'alertMessage' => $alertMessage,
        ];
    }
}
