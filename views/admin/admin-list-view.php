<div class="container">

<?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/admin-header.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
?>

    <form id="events-filter" method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php isset($listTableObj) ? $listTableObj->display() : 'Nothing to show' ?>
    </form>
</div>