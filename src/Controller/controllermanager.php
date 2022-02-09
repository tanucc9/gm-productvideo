<?php

require(__DIR__ . '/productvideocontroller.php');

$controller = $_POST['controller'];

switch ($controller) {
    case "productvideocontroller":
        new ProductvideoController();
        break;
}
