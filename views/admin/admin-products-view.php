<div class="container">
<div>
    <h3 id="title-showproducts">Products</h3>
    <?php if (isset($urlNewProd)) { ?>
    <a href="<?php echo $urlNewProd ?>" class="button">Add new product</a>
    <?php } ?>
</div>

<?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert_ajax.php');
?>

    <form id="events-filter" method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php isset($listProductsObj) ? $listProductsObj->display() : 'Nothing to show' ?>
    </form>
</div>