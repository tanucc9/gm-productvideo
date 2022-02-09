<?php

namespace GMProductVideo\Logs;

defined('ABSPATH') or die('access denied.');

include(ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php');

class Log
{

    /* Funzione per la generazione del log */
    public static function doLog($text, $title = '')
    {
        if (IS_DEBUG) {
            $dir = ABSPATH . 'wp-content/plugins/gm-productvideo/src/Logs/output_logs';

            if (! file_exists($dir)) {
                mkdir($dir, 0775);
            }

            $timestamp = date("Ymd");
            $filename  = $dir.DIRECTORY_SEPARATOR."_debug_".$timestamp.".log";

            // open log file
            $fh = fopen($filename, "a");
            if (! empty($title)) {
                fwrite($fh, '*** '.$title.' ***'."\n");
            }
            fwrite($fh, date("Y-m-d, H:i"));
            fwrite($fh, " - ");
            fwrite($fh, print_r($text, true));
            fwrite($fh, "\r\n");
            fclose($fh);
        }
    }
}
