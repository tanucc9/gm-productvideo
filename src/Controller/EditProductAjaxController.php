<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Product;

class EditProductAjaxController
{
    private $action = "edit_product";

    public function __construct()
    {
        add_action("wp_ajax_{$this->action}", array($this, "editProduct"));
    }

    public function editProduct()
    {
        if (!is_user_logged_in()) {
            wp_send_json(['message' => 'Error! You cannot access.']);
            wp_die();
        }

        if (!isset($_POST['idProd'])) {
            wp_send_json(['message' => 'Error! There is an error on the parameters.']);
            wp_die();
        }

        $datasToUpdate = [];

        if (isset($_POST['title'])) {
            $datasToUpdate['title_product'] = $_POST['title'];
        }

        if (isset($_POST['url_video'])) {
            $datasToUpdate['url_video'] = $_POST['url_video'];
        }

        $result = Product::updateProduct(
            $datasToUpdate,
            ['id_product' => $_POST['idProd']]
        );

        wp_send_json(['res' => (bool)$result]);
        wp_die();
    }

}
