<?php

namespace GMProductVideo\Model;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class CategoryProduct
{

    /** @var $id_product product's id added to category */
    public $id_product;

    /** @var $id_category category's id where you want to add the product */
    public $id_category;

    public function __construct($id_product = null, $id_category = null)
    {
        if ($id_product != null) {
            $this->id_product = $id_product;
        }
        if ($id_category != null) {
            $this->id_category = $id_category;
        }
    }

    public static function addCategoryProduct(CategoryProduct $catProd)
    {
        global $wpdb;

        $table = $wpdb->prefix . 'pv_category_product';
        $data = array(
          "id_product" => $catProd->id_product,
          "id_category" => $catProd->id_category
        );

        if ($wpdb->insert($table, $data)) {
            return true;
        }

        return false;
    }
}
