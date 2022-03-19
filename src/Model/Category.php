<?php

namespace GMProductVideo\Model;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Logs\Log;

class Category
{
    /** @var id id_category */
    public $id;

    /** @var last_edit last cat modification */
    public $last_edit;

    /** @var title_category title */
    public $title_category;


    /** @var table's name without prefix wordpress */
    public static $name_table = 'gm_pv_categories';

    public function __construct($id = null, $title_category = null, $last_edit = null)
    {
        if (null !== $id) {
            $this->id = $id;
        }
        if (null !== $last_edit) {
            $this->last_edit = $last_edit;
        }
        if (null !== $title_category) {
            $this->title_category = $title_category;
        }
    }

    public static function addCategory(Category $cat)
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $data = [
            'title_category' => $cat->title_category,
        ];

        if ($wpdb->insert($table, $data)) {
            return $wpdb->insert_id;
        }

        return false;
    }

    public static function updateCategory(array $data, array $where)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;

        return $wpdb->update($table, $data, $where);
    }


    public static function deleteCategory(int $id)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $where = ["id_category" => $id];

        return $wpdb->delete($table, $where);
    }

    public static function doRetrieveById(int $idCategory)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $sql = 'SELECT * FROM ' . $table . ' WHERE id_category = ' . $idCategory;
        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            foreach ($result as $row) {
                return new Category($row->id_category, $row->title_category, $row->last_edit);
            }
        }

        return null;
    }

    public static function doRetrieveAll(
        $page = null,
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
            $categories = [];
            foreach ($result as $row) {
                $cat = new Category($row->id_category, $row->title_category, $row->last_edit);
                array_push($categories, $cat);
            }

            return $categories;
        }

        return null;
    }

    public static function getNumCategories(): int
    {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT COUNT(id_category) AS num_categories FROM ' . $table;

        $result = json_decode(
            json_encode($wpdb->get_results($sql)),
            true
        );

        if (!empty($result)) {
            return (int) $result[0]['num_categories'];
        }

        return 0;
    }

    public static function getTotNumPages($rowPerPage = 10): int
    {
        if (isset($rowPerPage)) {
            $page = (int) (self::getNumCategories() / $rowPerPage);
            $decimal = self::getNumCategories() % $rowPerPage;
            if ($decimal > 0) {
                ++$page;
            }

            return $page;
        }

        return 0;
    }

    /** Return the products associated to category
     * @param int $idCategory
     * @return array|null
     */
    public static function getAssociatedProducts(
        int $idCategory,
        $page,
        $limit = 10,
        $orderBy = 'id_product',
        $orderWay = 'desc'
    ) {
        global $wpdb;

        $sql = 'SELECT product.*, catProd.id_category FROM ' . $wpdb->prefix . Product::$name_table . ' AS product' .
            ' LEFT JOIN ' . $wpdb->prefix . CategoryProduct::$name_table . ' catProd ON (product.id_product = catProd.id_product)' .
            ' WHERE catProd.id_category = ' . $idCategory;

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
            $prods = [];
            foreach ($result as $product) {
                $prodObj = new Product(
                    $product->id_product,
                    $product->last_edit,
                    $product->title_product,
                    $product->url_video,
                    $product->count_likes
                );
                $prods[] = $prodObj;
            }

            return $prods;
        }

        return null;
    }

    public static function getTitleByIdCategory(int $idCategory)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $sql = 'SELECT title_category FROM ' . $table . ' WHERE id_category = ' . $idCategory;
        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            foreach ($result as $row) {
                return $row->title_category;
            }
        }

        return null;
    }
}
