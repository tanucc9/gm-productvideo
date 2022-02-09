<?php

namespace GMProductVideo\Admin;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class AdminSettings
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu()
    {
        add_menu_page(
            __('Product Video Configuration', 'config-prodotti-video'),
            __(' GM Products', 'gm-prodotti'),
            'manage_options',
            PARENT_SLUG_ADMIN_TAB,
            array($this, 'admin_page_contents'),
            'dashicons-format-video',
            3
        );
    }

    public static function admin_page_contents()
    {
        $tanucc="tanu si fort";
        include(GM_PV__PLUGIN_DIR.'views/admin/adminsettingsview.php');
    }
}
