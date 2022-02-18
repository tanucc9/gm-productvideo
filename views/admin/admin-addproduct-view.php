<?php
/* Stub select option */
$options= ["Cl. 16", "Cl. 13", "Cl. 21", "Cl. 25", "Cl. 30"];

?>
<div class="container">

    <?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/admin-header.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
    ?>

<div class="wrapper-addproduct-form">
    <form action="<?php echo admin_url('admin.php?page=' . PARENT_SLUG_ADMIN_TAB . '-pv-add-productvideo', 'https'); ?>" method="post">
        <div id="first-row-title-url">
            <div class="gm_pv_wrap_input gm_pv_wrap_input_title_prod">
                <input type="text" placeholder="Name Product*" name="name_product" required>
            </div>
            <div class="gm_pv_wrap_input gm_pv_wrap_input_url">
                <input type="text" placeholder="URL Video*" name="url_video" required>
            </div>
        </div>
        <div class="second-row-multiselect">
            <div class="gm_pv_wrap_multiselect">
                <select name="category_select" id="category_select" multiple>
                    <option value="0">Choose category</option>
                    <?php foreach ($options as $key => $option) { ?>
                        <option value="<?php echo $key + 1 ?>"><?php echo $option ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="gm_pv_wrap_submit">
            <button type="submit" class="button" id="submit-addproduct-form">Save</button>
        </div>
        <input type="hidden" name="action" value="add_product">
    </form>