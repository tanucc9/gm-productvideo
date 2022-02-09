<?php

namespace GMProductVideo\Model;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Logs\Log;

class Product
{
    /** @var id id_product */
    public $id;

    /** @var last_edit last product modification */
    public $last_edit;

    /** @var title_product title */
    public $title_product;

    /** @var url video of the product */
    public $url_video;

    /** @var table's name without prefix wordpress */
    private static $name_table = 'pv_products';

    public function __construct($id = null, $last_edit = null, $title_product = null, $url_video = null)
    {
        if (null != $id) {
            $this->id = $id;
        }
        if (null != $last_edit) {
            $this->last_edit = $last_edit;
        }
        if (null != $title_product) {
            $this->title_product = $title_product;
        }
        if (null != $url_video) {
            $this->url_video = $url_video;
        }
    }

    public static function addProduct(Product $prod)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $data = [
            'title_product' => $prod->title_product,
            'url_video' => $prod->url_video,
        ];

        if ($wpdb->insert($table, $data)) {
            return true;
        }

        Log::doLog($wpdb->last_error);

        return false;
    }

    public static function updateProduct(array $data, array $where)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;

        return $wpdb->update($table, $data, $where);
    }

    public static function doRetrieveAll($page, $limit = 10)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT * FROM '.$table;

        if (isset($limit, $page)) {
            $page--;
            $elemToSkip = $limit * $page;
            $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $elemToSkip;
        }

        Log::doLog($sql, 'sql_pagination');

        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            $products = [];
            foreach ($result as $row) {
                $prod = new Product($row->id_product, $row->last_edit, $row->title_product, $row->url_video);
                array_push($products, $prod);
            }
            Log::doLog($products, 'products');

            return $products;
        }

        return null;
    }

    public static function getNumProducts()
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT COUNT(id_product) AS num_products FROM '.$table;

        $result = json_decode(
            json_encode($wpdb->get_results($sql)),
            true
        );

        if (!empty($result)) {
            return $result[0]['num_products'];
        }

        return 0;
    }

    public static function getTotNumPages($rowPerPage = 10): int
    {
        if (isset($rowPerPage)) {
            $page = (int) (self::getNumProducts() / $rowPerPage);
            $decimal = self::getNumProducts() % $rowPerPage;
            if ($decimal > 0) {
                ++$page;
            }

            return $page;
        }

        return 0;
    }
}
