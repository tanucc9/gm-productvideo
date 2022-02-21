<div class="container">

    <?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/admin-header.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert_ajax.php');
    ?>

    <div class="wrapper-<?php echo $action ?? '' ?>-form">
        <form method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <input type="hidden" name="action" value="<?php echo $action ?? ''?>">

            <?php if (
                isset($action) &&
                $action === 'submit_edit' &&
                isset($cat)
            ) { ?>
                <input type="hidden" name="id" value="<?php echo $cat->id ?>">
            <?php } ?>

            <div id="first-row-title-url">
                <div class="gm_pv_wrap_input gm_pv_wrap_input_title_cat">
                    <label>Category Name*
                        <input
                            type="text"
                            placeholder="Category Name"
                            name="name_category"
                            required
                            <?php if (isset($cat)) { ?>
                                value="<?php echo $cat->title_category ?>"
                            <?php } ?>
                            <?php if (isset($action) && $action === 'view_category') { ?>
                                readonly
                            <?php } ?>
                        >
                    </label>
                </div>
            </div>
            <?php if (isset($products) && count($products) > 0) { ?>
                <div class="second-row-multiselect">
                    <div class="gm_pv_wrap_multiselect">
                        <label>Associated Products
                            <select name="products_select[]" id="products_select" multiple>
                                <?php foreach ($products as $prod) { ?>
                                    <option
                                        value="<?php echo $prod->id ?>"
                                        <?php if (
                                            isset($selectedProducts) &&
                                            in_array($prod->id, $selectedProducts)
                                        ) { ?>
                                            selected
                                        <?php } ?>
                                        <?php if (isset($action) && $action === 'view_category') { ?>
                                            disabled = "true"
                                        <?php } ?>
                                    >
                                        <?php echo $prod->title_product ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </label>
                    </div>
                </div>
            <?php } ?>

            <?php if (isset($textSubmitBtn)) { ?>
                <div class="gm_pv_wrap_submit">
                    <button type="submit" class="button" id="submit-<?php echo $action ?? '' ?>-form">
                        <?php echo $textSubmitBtn ?>
                    </button>
                </div>
            <?php } ?>

        </form>