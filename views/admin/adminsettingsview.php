<div class="container">

<?php
include(GM_PV__PLUGIN_DIR . 'views/parts/admin-header.php');
include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
include(GM_PV__PLUGIN_DIR . 'views/parts/alert_ajax.php');
?>

    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <input type="hidden" name="action" value="update_settings" />

        <label>HTML Static Description (leave empty if you don't want a description)
            <textarea rows="5" name="html_static_description" placeholder="<p>Add here you html...</p>"><?php if (isset($htmlStaticDescriptionVal) && $htmlStaticDescriptionVal) { echo $htmlStaticDescriptionVal; } ?></textarea>
        </label>

        <?php if (isset($textSubmitBtn)) { ?>
            <div class="gm_pv_wrap_submit">
                <button type="submit" class="button" id="submit-settings-form">
                    <?php echo $textSubmitBtn ?>
                </button>
            </div>
        <?php } ?>

    </form>


</div>
