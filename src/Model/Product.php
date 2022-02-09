<?php

namespace GMProductVideo\Model;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

use GMProductVideo\Logs\Log;

class Product
{

    /** @var id product id */
    public $id;

    /** @var last_edit last product modification */
    public $last_edit;

    /** @var title_product title */
    public $title_product;

    /** @var url video of the product */
    public $url_video;

    /** @var $name_table table's name without prefix wordpress */
    private static $name_table = "pv_products";

    public function __construct($id = null, $last_edit = null, $title_product = null, $url_video = null)
    {
        if ($id != null) {
            $this->id = $id;
        }
        if ($last_edit != null) {
            $this->last_edit = $last_edit;
        }
        if ($title_product != null) {
            $this->title_product = $title_product;
        }
        if ($url_video != null) {
            $this->url_video = $url_video;
        }
    }

    public static function addProduct(Product $prod)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $data = array(
            "title_product" => $prod->title_product,
            "url_video" => $prod->url_video
        );

        if ($wpdb->insert($table, $data)) {
            return true;
        }

        Log::doLog($wpdb->last_error);

        return false;
    }

    public static function updateProduct(array $data, array $where)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        return $wpdb->update($table, $data, $where);
    }

    public static function doRetrieveAll()
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $sql = 'SELECT * FROM ' . $table;

        $result = $wpdb->get_results($sql);

        if (count((array)$result) >= 1) {
            $products = array();
            foreach ($result as $row) {
                $prod = new Product($row->id_product, $row->last_edit, $row->title_product, $row->url_video);
                array_push($products, $prod);
            }
            Log::doLog($products);

            return $products;
        }

        return null;
    }
}
