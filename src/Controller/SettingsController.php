<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Admin\AdminSettings;

class SettingsController
{
    public static function processSettings(
        $hasShowStaticContent = null,
        $urlInsta = '',
        $urlFacebook = '',
        $titleMostLiked = ''
    ) {
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

        if (empty($titleMostLiked) && isset($_GET['most_liked_prod_title'])) {
            $titleMostLiked = $_GET['most_liked_prod_title'];
        }

        $resTitleMostLiked = false;
        if (!empty($titleMostLiked)) {
            $resTitleMostLiked = update_option(AdminSettings::$optionTitleMostLikedProd, $titleMostLiked);
        }


        if (
            $resHasShowStaticContent ||
            $resTitleMostLiked ||
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
