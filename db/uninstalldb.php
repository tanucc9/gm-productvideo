<?php

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

use GMProductVideo\Logs\Log;

//@todo use name tables from model
class UninstallDb
{
    public static function deleteTables()
    {
        self::deleteCategoryProductTable();
        self::deleteCategoriesTable();
        self::deleteProductsTable();
    }

    public static function deleteCategoriesTable()
    {
        global $wpdb;

        $table_name=$wpdb->prefix . GM_TABLE_NAME_CATEGORY;

        if ($wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") == $table_name) {
            $sql = "DROP TABLE IF EXISTS " .$table_name;
            $wpdb->query($sql);
        }
        Log::doLog("deleteCategoryTable");
    }

    public static function deleteProductsTable()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . GM_TABLE_NAME_PRODUCT;
        if ($wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") == $table_name) {
            $sql = "DROP TABLE IF EXISTS " .$table_name;
            $wpdb->query($sql);
        }
        Log::doLog("deleteProductVideoTable");
    }

    public static function deleteCategoryProductTable()
    {
        global $wpdb;

        $table_name=$wpdb->prefix . GM_TABLE_NAME_CATEGORYPRODUCT;

        if ($wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") == $table_name) {
            $sql = "DROP TABLE IF EXISTS " .$table_name;
            $wpdb->query($sql);
        }
        Log::doLog("deleteCategoryProductTable");
    }
}
