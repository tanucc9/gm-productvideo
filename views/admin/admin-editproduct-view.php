<div class="container">

    <?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/admin-header.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert_ajax.php');
    ?>

    <?php if (isset($prod)) { ?>
        <form id="events-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <input type="hidden" name="action" value="submit_edit">
            <input type="hidden" name="id" value="<?php echo $prod->id ?>">
            <input type="text" name="title_product" value="<?php echo $prod->title_product ?>">
            <input type="text" name="url_video" value="<?php echo $prod->url_video ?>">
            <input class="button" type="submit" value="Update">
        </form>
    <?php } ?>
</div>