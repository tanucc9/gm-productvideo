<?php

namespace GMProductVideo\Admin;

use GMProductVideo\Controller\SettingsController;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class AdminSettings
{
    public static $optionHtmlStaticDescription = 'gm_pv_html_static_description';

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu()
    {
        add_menu_page(
            __('Product Video Configuration', 'config-products-video'),
            __(' GM Products', PARENT_SLUG_ADMIN_TAB),
            'manage_options',
            PARENT_SLUG_ADMIN_TAB,
            array($this, 'admin_page_contents'),
            'dashicons-format-video',
            3
        );
    }

    public static function admin_page_contents()
    {
        if (isset($_GET['action']) && $_GET['action'] === 'update_settings') {
            $alerts = SettingsController::processSettings();
            if (!empty($alerts)) {
                $alertType = $alerts['alertType'];
                $alertMessage = $alerts['alertMessage'];
            }
        }

        $htmlStaticDescriptionVal = get_option(self::$optionHtmlStaticDescription);
        $titleHeader = 'Settings GM Products';
        $textSubmitBtn = 'Save';

        include(GM_PV__PLUGIN_DIR.'views/admin/adminsettingsview.php');
    }
}
