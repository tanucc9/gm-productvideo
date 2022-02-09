<?php

class ProductvideoController {
    function __construct ()
    {
        echo 'ciao';
        die();
        $this->prova();
    }

    public function prova() {
        header("Location: https://fireworksbrothersmauro.altervista.org/wp-admin/admin.php?page=pv-add-productvideo");
    }
}