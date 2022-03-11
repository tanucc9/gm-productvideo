<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Product;

class CountLikesProductAjaxController
{
    private $action = "increment_likes";

    public function __construct()
    {
        add_action("wp_ajax_{$this->action}", array($this, "increment_likes"));
        add_action("wp_ajax_nopriv_{$this->action}", array($this, "increment_likes"));
    }

    public function increment_likes()
    {
        if (!isset($_POST['idProd'])) {
            wp_send_json([
                'res' => false,
                'message' => 'Error! There is an error on the parameters.'
            ]);
            wp_die();
        }

        $result = Product::incrementLikesById((int) $_POST['idProd']);

        wp_send_json(['res' => $result]);
        wp_die();
    }

}