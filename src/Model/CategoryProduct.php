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

    /** @var table's name without prefix wordpress */
    private static $name_table = 'pv_category_product';

    public function __construct($id_product = null, $id_category = null)
    {
        if ($id_product != null) {
            $this->id_product = $id_product;
        }
        if ($id_category != null) {
            $this->id_category = $id_category;
        }
    }

    public static function addCategoryProduct(CategoryProduct $catProd):bool
    {
        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $data = array(
          "id_product" => $catProd->id_product,
          "id_category" => $catProd->id_category
        );

        if ($wpdb->insert($table, $data)) {
            return true;
        }

        return false;
    }

    /** Delete all records with that specific id Product.
     *  @var $idProduct int id product
     */
    public static function deleteAllRecordsByIdProduct(int $idProduct):bool
    {
        if (!isset($idProduct)) {
            return false;
        }

        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $where = ['id_product' => $idProduct];
        return $wpdb->delete($table, $where);
    }

    /** Delete all records with that specific id Category.
     * @param int $idCategory int id product
     */
    public static function deleteAllRecordsByIdCategory(int $idCategory):bool
    {
        if (!isset($idCategory)) {
            return false;
        }

        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $where = ['id_category' => $idCategory];
        return $wpdb->delete($table, $where);
    }

    /** Return the categories associated to product.
     * @var int $idProduct the id of the product
     * @return array the list containing the ids category
     */
    public static function getCategoriesProduct(int $idProduct): array
    {
        if (!isset($idProduct)) {
            return [];
        }

        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $sql = 'SELECT id_category FROM ' . $table . ' WHERE id_product = ' . $idProduct;
        $result = $wpdb->get_results($sql);

        $idsCat = [];
        if (count((array) $result) >= 1) {
            foreach ($result as $row) {
                $idsCat[] = $row->id_category;
            }
        }

        return $idsCat;
    }

    /** Return the products associated to category.
     * @var int $idCategory the id of the category
     * @return array the list containing the ids product
     */
    public static function getProductsCategory(int $idCategory): array
    {
        if (!isset($idCategory)) {
            return [];
        }

        global $wpdb;

        $table = $wpdb->prefix . self::$name_table;
        $sql = 'SELECT id_product FROM ' . $table . ' WHERE id_category = ' . $idCategory;
        $result = $wpdb->get_results($sql);

        $idsProd = [];
        if (count((array) $result) >= 1) {
            foreach ($result as $row) {
                $idsProd[] = $row->id_product;
            }
        }

        return $idsProd;
    }
}
