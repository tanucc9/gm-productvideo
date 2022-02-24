<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Admin\AdminSettings;

class SettingsController
{
    public static function processSettings(
        $html_description = ''
    ) {
        if (empty($html_description) && isset($_GET['html_static_description'])) {
            $html_description = $_GET['html_static_description'];
        }
        $resHtmlDesc = update_option(AdminSettings::$optionHtmlStaticDescription, $html_description);

        if ($resHtmlDesc) {
            return [
                'alertType' => 'success',
                'alertMessage' => 'Settings were updated!',
            ];
        }

        return [];
    }
}
