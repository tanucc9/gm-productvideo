<?php

defined( 'ABSPATH' ) or die( 'access denied.' );

require_once( GM_PV__PLUGIN_DIR . 'logs/log.php' );

class UninstallDb {
    private static $table_name_product = "pv_products";
    private static $table_name_category = "pv_categories";
    private static $table_name_categoryproduct = "pv_category_product";


    public static function deleteTables () {
        self::deleteCategoryProductTable();
        self::deleteCategoriesTable();
        self::deleteProductsTable();
    }

    public static function deleteCategoriesTable() {
        global $wpdb;

        $table_name=$wpdb->prefix.self::$table_name_category;

        if ( $wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") == $table_name ) {
            $sql = "DROP TABLE IF EXISTS " .$table_name;
            $wpdb->query($sql);
        }
        Log::doLog("deleteCategoryTable");
    }

    public static function deleteProductsTable() {
        global $wpdb;

        $table_name = $wpdb->prefix.self::$table_name_product;
        if ( $wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") == $table_name ) {
            $sql = "DROP TABLE IF EXISTS " .$table_name;
            $wpdb->query($sql);
        }
        Log::doLog("deleteProductVideoTable");
    }

    public static function deleteCategoryProductTable() {
        global $wpdb;

        $table_name=$wpdb->prefix.self::$table_name_categoryproduct;

        if ( $wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") == $table_name ) {
            $sql = "DROP TABLE IF EXISTS " .$table_name;
            $wpdb->query($sql);
        }
        Log::doLog("deleteCategoryProductTable");
    }
}