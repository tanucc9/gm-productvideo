<?php

namespace GMProductVideo\Model;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Logs\Log;

class Product
{
    /** id_product */
    public $id;

    /** last_edit last product modification */
    public $last_edit;

    /** title_product title */
    public $title_product;

    /** url video of the product */
    public $url_video;

    /** count likes of the product */
    public $count_likes;

    /** @var table's name without prefix wordpress */
    public static $name_table = 'gm_pv_products';

    public function __construct(
        $id = null,
        $last_edit = null,
        $title_product = null,
        $url_video = null,
        $count_likes = null
    ) {
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
        if (null != $count_likes) {
            $this->count_likes = $count_likes;
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
            return $wpdb->insert_id;
        }

        return false;
    }

    public static function updateProduct(array $data, array $where)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;

        return $wpdb->update($table, $data, $where);
    }

    public static function deleteProduct(int $id)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $where = ["id_product" => $id];

        return $wpdb->delete($table, $where);
    }

    public static function doRetrieveAll(
        $page,
        $limit = 10,
        $orderBy = 'id_product',
        $orderWay = 'asc'
    ) {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT * FROM '.$table;

        if (isset($orderBy, $orderWay)) {
            $sql .= ' ORDER BY ' . $orderBy . ' ' . $orderWay;
        }

        if (isset($limit, $page)) {
            $page--;
            $elemToSkip = $limit * $page;
            $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $elemToSkip;
        }

        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            $products = [];
            foreach ($result as $row) {
                $prod = new Product(
                    $row->id_product,
                    $row->last_edit,
                    $row->title_product,
                    $row->url_video,
                    $row->count_likes
                );
                array_push($products, $prod);
            }
            Log::doLog($products, 'products');

            return $products;
        }

        return null;
    }

    public static function doRetrieveById(int $idProduct)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT * FROM ' . $table . ' WHERE id_product = ' . $idProduct;
        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            foreach ($result as $row) {
                return new Product(
                    $row->id_product,
                    $row->last_edit,
                    $row->title_product,
                    $row->url_video,
                    $row->count_likes
                );
            }
        }

        return null;
    }

    /** Return the number of likes of a product
     * @param int $idProduct the id of the product
     * @return int the number of likes
     */
    public static function getCountLikesById(int $idProduct): int
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT count_likes FROM ' . $table . ' WHERE id_product = ' . $idProduct;
        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            foreach ($result as $row) {
                return (int) $row->count_likes;
            }
        }

        return 0;
    }

    public static function incrementLikesById(int $idProd): bool
    {
        if (!isset($idProd)) {
            return false;
        }

        global $wpdb;
        $table = $wpdb->prefix.self::$name_table;
        $sql = 'UPDATE ' . $table . ' 
                SET count_likes = count_likes + 1 
                WHERE id_product = ' . $idProd;

        $result = $wpdb->query(
            $wpdb->prepare($sql)
        );

        if (!empty($result) && count($result) > 0) {
            return true;
        }
        return false;
    }

    public static function getNumProducts(): int
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT COUNT(id_product) AS num_products FROM '.$table;

        $result = json_decode(
            json_encode($wpdb->get_results($sql)),
            true
        );

        if (!empty($result)) {
            return (int) $result[0]['num_products'];
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
