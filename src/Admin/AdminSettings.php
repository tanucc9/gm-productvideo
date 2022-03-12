<?php

namespace GMProductVideo\Admin;

use GMProductVideo\Controller\SettingsController;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class AdminSettings
{
    public static $optionShowStaticContent = 'gm_pv_show_static_content';
    public static $optionUrlFb = 'gm_pv_url_fb';
    public static $optionUrlInsta = 'gm_pv_url_insta';
    public static $optionTitleMostLikedProd = 'gm_pv_title_most_liked_prod';
    public static $optionTitleNewestProd = 'gm_pv_title_newest_prod';

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

        $hasShowStatiContent = (bool)get_option(self::$optionShowStaticContent);
        $urlInsta = get_option(self::$optionUrlInsta);
        $urlFb = get_option(self::$optionUrlFb);
        $titleMostLiked = get_option(self::$optionTitleMostLikedProd);
        $titleNewestProd = get_option(self::$optionTitleNewestProd);
        
        $titleHeader = 'Settings GM Products';
        $textSubmitBtn = 'Save';

        include(GM_PV__PLUGIN_DIR.'views/admin/adminsettingsview.php');
    }
}
