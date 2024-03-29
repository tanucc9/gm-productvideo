<?php

namespace GMProductVideo\Controller;

use GMProductVideo\Admin\AdminSettings;

class SettingsController
{
    public static function processSettings(
        $hasShowStaticContent = null,
        $urlInsta = '',
        $urlFacebook = '',
        $titleMostLiked = '',
        $titleNewestProd = '',
        $numStartingLikes = null
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

        if (empty($titleNewestProd) && isset($_GET['newest_prod_title'])) {
            $titleNewestProd = $_GET['newest_prod_title'];
        }
        $resTitleNewestProd = false;
        if (!empty($titleNewestProd)) {
            $resTitleNewestProd = update_option(AdminSettings::$optionTitleNewestProd, $titleNewestProd);
        }

        if (!isset($numStartingLikes) && isset($_GET['num_starting_likes'])) {
            $numStartingLikes = $_GET['num_starting_likes'];
        }
        $resStartingLikes = false;
        if (isset($numStartingLikes)) {
            $resStartingLikes = update_option(AdminSettings::$optionStartingLikes, $numStartingLikes);
        }

        if (
            $resTitleNewestProd ||
            $resHasShowStaticContent ||
            $resTitleMostLiked ||
            $numStartingLikes ||
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
