<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\Product;

class DeleteProductController
{
    public static function deleteProduct(int $idProduct = null): array
    {
        if (!isset($idProduct) && isset($_GET['id'])) {
            $idProduct = (int)$_GET['id'];
        }

        if (!isset($idProduct)) {
            $alertType = 'danger';
            $alertMessage = 'There was an erro on removing product';
        } else {
            if (Product::deleteProduct($idProduct) !== false) {
                $alertType = 'success';
                $alertMessage = 'Product ' . $idProduct . ' has been removed';
            } else {
                $alertType = 'danger';
                $alertMessage = 'There was an erro on removing product ' . $idProduct;
            }
        }

        return [
            'alertType' => $alertType,
            'alertMessage' => $alertMessage,
        ];
    }
}
