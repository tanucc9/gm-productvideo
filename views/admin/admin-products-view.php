<div class="container">
<h3 id="title-showproducts">Products</h3>

<?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert_ajax.php');
?>

    <form id="events-filter" method="get">
        <input type="hidden" name="page" value="' .$_REQUEST['page']. '" />
        <?php isset($listProductsObj) ? $listProductsObj->display() : 'Nothing to show' ?>
    </form>
</div>