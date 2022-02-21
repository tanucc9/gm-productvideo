<?php

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

use GMProductVideo\Logs\Log;
use GMProductVideo\Model\Category;
use GMProductVideo\Model\Product;
use GMProductVideo\Model\CategoryProduct;

class InstallDb
{
    public static function createTables()
    {
        self::createCategoriesTable();
        self::createProductsTable();
        self::createCategoryProductTable();
    }

    public static function createProductsTable()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate() . ' engine = innoDB';
        $table_name = $wpdb->prefix . Product::$name_table;

        /* Controllo se la tabella è stata già creata */
        if ($wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") != $table_name) {
            $sql = "CREATE TABLE " .$table_name. " (
                id_product mediumint(9) NOT NULL AUTO_INCREMENT,
                last_edit datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                title_product varchar(255) NOT NULL,
                url_video varchar(500) NOT NULL,
                PRIMARY KEY  (id_product)
                ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            Log::doLog($wpdb->last_error, "createProductVideoTable");
        }
    }

    public static function createCategoriesTable()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate() . ' engine = innoDB';
        $table_name = $wpdb->prefix . Category::$name_table;

        /* Controllo se la tabella è stata già creata */
        if ($wpdb->get_var("SHOW TABLES LIKE '". $table_name ."'") != $table_name) {
            $sql = "CREATE TABLE ". $table_name ." (
                id_category mediumint(9) NOT NULL AUTO_INCREMENT,
                last_edit datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                title_category varchar(255) NOT NULL,
                PRIMARY KEY  (id_category)
                ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);

            Log::doLog($wpdb->last_error, "createCategoryTable");
        }
    }

    public static function createCategoryProductTable()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate() . ' engine = innoDB';
        $table_name = $wpdb->prefix . CategoryProduct::$name_table;

        /* Controllo se la tabella è stata già creata */
        if ($wpdb->get_var("SHOW TABLES LIKE '" .$table_name. "'") != $table_name) {
            $sql = "CREATE TABLE " .$table_name. " (
                id_product mediumint(9) NOT NULL,
                id_category mediumint(9) NOT NULL,
                FOREIGN KEY (id_product) REFERENCES " . $wpdb->prefix . Product::$name_table . "(id_product)
                ON DELETE CASCADE,
                FOREIGN KEY (id_category) REFERENCES " . $wpdb->prefix . Category::$name_table . "(id_category)
                ON DELETE CASCADE,
                CONSTRAINT category_product UNIQUE  (id_product, id_category)
                ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            Log::doLog($wpdb->last_error, "createCategoryProductTable");
        }
    }
}
