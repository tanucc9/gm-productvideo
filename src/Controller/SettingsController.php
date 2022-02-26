<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Admin\AdminSettings;

class SettingsController
{
    public static function processSettings(
        $html_description = '',
        $hasShowStaticContent = null,
        $urlInsta = '',
        $urlFacebook = ''
    ) {
        if (empty($html_description) && isset($_GET['html_static_description'])) {
            $html_description = $_GET['html_static_description'];
        }

        if (!isset($hasShowStaticContent) && isset($_GET['show_static_content'])) {
            $hasShowStaticContent = true;
        } elseif (!isset($hasShowStaticContent) && !isset($_GET['show_static_content'])) {
            //The value is false
            $hasShowStaticContent = false;
        }

        if ($hasShowStaticContent) {
            if (empty($urlFacebook) && isset($_GET['facebook_url'])) {
                $urlFacebook = $_GET['facebook_url'];
            }
            if (empty($urlInsta) && isset($_GET['instagram_url'])) {
                $urlInsta = $_GET['instagram_url'];
            }

            if (isset($urlFacebook)) {
                $resUrlFb = update_option(AdminSettings::$optionUrlFb, $urlFacebook);
            } else {
                $resUrlFb = false;
            }

            if (isset($urlInsta)) {
                $resUrlInsta = update_option(AdminSettings::$optionUrlInsta, $urlInsta);
            } else {
                $resUrlInsta = false;
            }
        }

        if (isset($hasShowStaticContent)) {
            $resHasShowStaticContent = update_option(AdminSettings::$optionShowStaticContent, $hasShowStaticContent);
        } else {
            $resHasShowStaticContent = false;
        }

        if (isset($html_description)) {
            $resHtmlDesc = update_option(AdminSettings::$optionHtmlStaticDescription, $html_description);
        } else {
            $resHtmlDesc = false;
        }
        if (
            $resHtmlDesc ||
            $resHasShowStaticContent ||
            (isset($resUrlFb) && $resUrlFb) ||
            (isset($resUrlInsta) && $resUrlInsta)
        ) {
            return [
                'alertType' => 'success',
                'alertMessage' => 'Settings were updated!',
            ];
        }

        return [];
    }
}
