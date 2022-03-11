<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

class AdminMedia
{
    /** @var array
     * key => path to the style
     * value => array containing the name to assign to the style and an array of pages
     * in where to add the style
     */
    private $specificStyles = [
        '/wp-content/plugins/gm-productvideo/assets/css/admin/settings.css' => [
            'name' => 'settings_css',
            'pages' =>  [
                PARENT_SLUG_ADMIN_TAB,
            ],
        ],
        '/wp-content/plugins/gm-productvideo/assets/css/admin/product.css' => [
            'name' => 'admin_addproduct',
            'pages' =>  [
                PARENT_SLUG_ADMIN_TAB.'-pv-add-productvideo',
                PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo',
            ],
        ],
        '/wp-content/plugins/gm-productvideo/assets/css/admin/category.css' => [
            'name' => 'admin_addproduct',
            'pages' =>  [
                PARENT_SLUG_ADMIN_TAB.'-pv-add-category',
                PARENT_SLUG_ADMIN_TAB . '-pv-show-categoriesvideo',
            ],
        ],
        '/wp-content/plugins/gm-productvideo/assets/css/admin/showproducts.css' => [
            'name' => 'showproducts_css',
            'pages' =>  [
                PARENT_SLUG_ADMIN_TAB.'-pv-show-productsvideo',
            ],
        ],
    ];



    /** @var array
     * key => path to the script
     * value => array with the name of the style, the pages in where
     * to add the script
     */
    private $specificScripts = [
        '/wp-content/plugins/gm-productvideo/assets/js/admin/list-products.js' => [
            'name' => 'list-products',
            'localize_script' => true,
            'pages' => [
                PARENT_SLUG_ADMIN_TAB.'-pv-show-productsvideo',
            ],
            'in_footer' => false,
        ],
        '/wp-content/plugins/gm-productvideo/assets/js/admin/copy-shortcode.js' => [
            'name' => 'copy-shortcode',
            'pages' => [
                PARENT_SLUG_ADMIN_TAB . '-pv-show-categoriesvideo',
            ],
            'in_footer' => false,
        ],
        '/wp-content/plugins/gm-productvideo/assets/js/admin/validation.js' => [
            'name' => 'validation',
            'pages' => [
                PARENT_SLUG_ADMIN_TAB . '-pv-add-productvideo',
                PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo',
            ],
            'in_footer' => false,
        ],
        '/wp-content/plugins/gm-productvideo/assets/js/admin/settings.js' => [
            'name' => 'settings',
            'pages' => [
                PARENT_SLUG_ADMIN_TAB,
            ],
            'in_footer' => false,
        ],
    ];

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'call_loadAssets']);
    }

    public function call_loadAssets($hook)
    {
        $current_page = $_GET['page'];
        if (false !== strpos($current_page, PARENT_SLUG_ADMIN_TAB)) {
            $this->loadAssets($current_page);
        }
    }

    public function loadAssets($current_page)
    {
        $this->loadGeneralsStyles();
        $this->loadGeneralsScripts();

        $this->loadSpecificsStyles($current_page);
        $this->loadSpecificsScripts($current_page);
    }

    /**
     * Load general styles used on all pages of the plugin.
     */
    public function loadGeneralsStyles()
    {
        wp_register_style('pv_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        wp_enqueue_style('pv_bootstrap');

        //@todo load only in plugin's pages
        wp_register_style('gm_pv_adminglobal', '/wp-content/plugins/gm-productvideo/assets/css/admin/global.css');
        wp_enqueue_style('gm_pv_adminglobal');
    }

    /**
     * Load general scripts used on all pages of the plugin.
     */
    public function loadGeneralsScripts()
    {
        wp_register_script('pv_bootstrap2', 'https://code.jquery.com/jquery-3.4.1.slim.min.js');
        wp_register_script('pv_bootstrap3', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
        wp_register_script('pv_bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');
        wp_enqueue_script('pv_bootstrap2');
        wp_enqueue_script('pv_bootstrap3');
        wp_enqueue_script('pv_bootstrap4');
    }

    /**
     * Load styles to be applied on a specific page.
     *
     * @param mixed $current_page
     */
    public function loadSpecificsStyles($current_page)
    {
        foreach ($this->specificStyles as $path => $style) {
            if (in_array($current_page, $style['pages'])) {
                wp_register_style($style['name'], $path, [], rand(111, 9999), 'all');
                wp_enqueue_style($style['name']);
            }
        }
    }

    /**
     * Load scripts to be applied on a specific page.
     *
     * @param mixed $current_page
     */
    public function loadSpecificsScripts($current_page)
    {
        foreach ($this->specificScripts as $path => $script) {
            if (in_array($current_page, $script['pages'])) {
                wp_register_script($script['name'], $path, [], false, $script['in_footer']);
                wp_enqueue_script($script['name']);
                if ($script['localize_script']) {
                    $this->doLocalizeScript($script['name']);
                }
            }
        }
    }

    public function doLocalizeScript($localize)
    {
        switch ($localize) {
            case 'list-products':
                wp_localize_script(
                    'list-products',
                    'ajaxurl',
                    [
                        'ajaxurl' => admin_url('admin-ajax.php'),
                    ]
                );

                break;
        }
    }
}
