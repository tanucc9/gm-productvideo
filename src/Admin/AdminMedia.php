<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class AdminMedia
{

    /** @var string[]
     * key => name of the page
     * value => respective url of the style css' page
     */
    private static $styles_pages = array(
        PARENT_SLUG_ADMIN_TAB => '/wp-content/plugins/gm-productvideo/assets/css/admin/settings.css',
        PARENT_SLUG_ADMIN_TAB.'-pv-add-productvideo' => '/wp-content/plugins/gm-productvideo/assets/css/admin/addproduct.css',
        PARENT_SLUG_ADMIN_TAB.'-pv-show-productsvideo' => '/wp-content/plugins/gm-productvideo/assets/css/admin/showproducts.css',
    );

    /** @var string[]
     * key => name of the page
     * value => respective url of the script's page
     */
    private static $scripts_pages = array(
        PARENT_SLUG_ADMIN_TAB.'-pv-show-productsvideo' => [
            'name' => 'list-products',
            'path' => '/wp-content/plugins/gm-productvideo/assets/js/admin/list-products.js',
            'localize_script' => true,
        ],
    );

    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'call_loadAssets'));
    }

    public function call_loadAssets($hook)
    {
        $current_page = $_GET['page'];
        if (strpos($current_page, PARENT_SLUG_ADMIN_TAB) !== false) {
            self::loadAssets($current_page);
        }
    }

    public static function loadAssets($current_page)
    {
        self::loadGeneralsStyles();
        self::loadGeneralsScripts();

        self::loadSpecificsStyles($current_page);
        self::loadSpecificsScripts($current_page);
    }

    /**
     * Load general styles used on all pages of the plugin.
     */
    public static function loadGeneralsStyles()
    {
        wp_register_style('pv_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        wp_enqueue_style('pv_bootstrap');
    }

    /**
     * Load general scripts used on all pages of the plugin.
     */
    public static function loadGeneralsScripts()
    {
        //wp_register_script('pv_bootstrap2', 'https://code.jquery.com/jquery-3.4.1.slim.min.js');
        wp_register_script('pv_bootstrap3', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
        wp_register_script('pv_bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');
        wp_enqueue_script('pv_bootstrap2');
        wp_enqueue_script('pv_bootstrap3');
        wp_enqueue_script('pv_bootstrap4');
    }

    /**
     * Load styles to be applied on a specific page.
     */
    public static function loadSpecificsStyles($current_page)
    {
        wp_register_style('pv_admin_addproduct', self::$styles_pages[$current_page], array(), rand(111, 9999), 'all');
        wp_enqueue_style('pv_admin_addproduct');
    }

    /**
     * Load scripts to be applied on a specific page.
     */
    public static function loadSpecificsScripts($current_page)
    {
        wp_register_script(self::$scripts_pages[$current_page]['name'], self::$scripts_pages[$current_page]['path']);
        wp_enqueue_script(self::$scripts_pages[$current_page]['name']);
        if (
            isset(self::$scripts_pages[$current_page]['localize_script']) &&
            self::$scripts_pages[$current_page]['localize_script']
        ) {
            self::doLocalizeScript(self::$scripts_pages[$current_page]['name']);
        }
    }

    public static function doLocalizeScript($localize)
    {
        switch ($localize) {
            case 'list-products':

                wp_localize_script(
                    'list-products',
                    'ajaxurl',
                    array(
                        'ajaxurl' => admin_url('admin-ajax.php'),
                    )
                );
                break;
        }
    }
}
