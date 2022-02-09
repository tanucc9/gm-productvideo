<?php
/* Stub select option */
$options= ["Cl. 16", "Cl. 13", "Cl. 21", "Cl. 25", "Cl. 30"];

?>
<div class="container">
<h3 id="title-addproduct-form">Add New Product</h3>

<?php /* Alert */ if(isset($type_alert))
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
?>

<div class="wrapper-addproduct-form">
    <form action="<?php echo admin_url('admin.php?page=' . PARENT_SLUG_ADMIN_TAB . '-pv-add-productvideo', 'https'); ?>" method="post">
        <div class="row" id="first-row">
            <div class="col-sm-3">
                <input type="text" placeholder="Name Product*" name="name_product" required>
            </div>
            <div class="col-sm-2" id="select-category-col">
                <select name="category_select" id="category_select">
                    <option value="0">Choose category</option>
                    <?php foreach ($options as $key => $option) { ?>
                        <option value="<?php echo $key ?>"><?php echo $option ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <input type="text" placeholder="URL Video*" name="url_video" required>
            </div>
        </div>
        <div class="row">
            <div class="col-5" id="col-submit-form">
                <button type="submit" class="btn btn-primary" id="submit-addproduct-form">Save</button>
            </div>
        </div>
        <input type="hidden" name="action" value="add_product">
    </form>
</div>
</div>