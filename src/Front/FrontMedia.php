<?php

namespace GMProductVideo\Front;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

class FrontMedia
{
    /** @var array
     * key => path to the style
     * value => array containing the name to assign to the style
     */
    private $specificStyles = [];


    /** @var array
     * key => path to the script
     * value => array with the name of the style
     */
    private $specificScripts = [
        '/wp-content/plugins/gm-productvideo/assets/js/front/list-products.js' => [
            'name' => 'list-products',
            'localize_script' => true,
            'in_footer' => false,
        ],
    ];

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'loadAssets']);
    }

    public function loadAssets()
    {
        $this->loadGeneralsStyles();
        $this->loadGeneralsScripts();
    }

    /**
     * Load general styles used on all pages of the plugin.
     */
    public function loadGeneralsStyles()
    {
        foreach ($this->specificStyles as $path => $style) {
            wp_register_style($style['name'], $path, [], rand(111, 9999), 'all');
            wp_enqueue_style($style['name']);
        }
    }

    /**
     * Load general scripts used on all pages of the plugin.
     */
    public function loadGeneralsScripts()
    {
        foreach ($this->specificScripts as $path => $script) {
            wp_register_script($script['name'], $path, [], false, $script['in_footer']);
            wp_enqueue_script($script['name']);
            if ($script['localize_script']) {
                $this->doLocalizeScript($script['name']);
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
                        'nonce' => wp_create_nonce( 'nonce' ),
                    ]
                );

                break;
        }
    }
}
