<?php

/**
 * Plugin Name: Mauro Product Video
 * Description: This plugin allow you to create list products with video instead of images.
 * Version:     1.0.0
 * Author:      Gaetano Mauro
 * Author URI:  https://www.linkedin.com/in/gaetano-mauro/
 * Text Domain: gm-productvideo
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined('ABSPATH') or die('access denied.');

include( ABSPATH . 'wp-content/plugins/gm-productvideo/config/defines.php' );

require_once __DIR__ . '/vendor/autoload.php';

new \GMProductVideo\LoadHooks();

function installPlugin()
{
    Log::doLog("installPlugin");
    InstallDb::createTables();
}
register_activation_hook( __FILE__, 'installPlugin' );

/* TODO - Alla fine dei lavori legare la funzione uninstall() all'uninstall hook piuttosto
 * che il deactivate.
 *  register_uninstall_hook(__FILE__, 'delete_plugin_database_table');

function uninstallPlugin() {
    UninstallDb::deleteTables();
}
register_deactivation_hook( __FILE__, 'uninstallPlugin' );
*/


add_shortcode('njengah_contact_form', 'render_njengah_contact_form');
function render_njengah_contact_form() { ?>
    <form>
        First name:<br>
        <input type="text" name="firstname" value="Joe ">
        <br>
        Last name:<br>
        <input type="text" name="lastname" value="Njenga">
        <br>
        <input type="submit" value="Send">
    </form>
    <?php

}