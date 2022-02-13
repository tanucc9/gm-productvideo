<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Model\Product;

class DeleteProductAjaxController
{
    private $action = "delete_product";

    public function __construct()
    {
        add_action("wp_ajax_{$this->action}", array($this, "deleteProduct"));
    }

    public function deleteProduct()
    {
        if (!is_user_logged_in()) {
            wp_send_json(['message' => 'Error! You cannot access.']);
            wp_die();
        }

        if (!isset($_POST['idProd'])) {
            wp_send_json(['message' => 'Error! There is an error on the parameters.']);
            wp_die();
        }

        $result = Product::deleteProduct((int)$_POST['idProd']);

        wp_send_json(['res' => (bool)$result]);
        wp_die();
    }

}
