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
                    isset($prod)
            ) { ?>
                <input type="hidden" name="id" value="<?php echo $prod->id ?>">
            <?php } ?>

            <div id="first-row-title-url">
                <div class="gm_pv_wrap_input gm_pv_wrap_input_title_prod">
                    <label>Product Name*
                    <input
                            type="text"
                            placeholder="Name Product"
                            name="name_product"
                            required
                            <?php if (isset($prod)) { ?>
                                value="<?php echo $prod->title_product ?>"
                            <?php } ?>
                            <?php if (isset($action) && $action === 'view_product') { ?>
                                readonly
                            <?php } ?>
                    >
                    </label>
                </div>
                <div class="gm_pv_wrap_input gm_pv_wrap_input_url">
                    <label>URL Video*
                    <input
                            type="text"
                            placeholder="URL Video"
                            name="url_video"
                            required
                            <?php if (isset($prod)) { ?>
                                value="<?php echo $prod->url_video ?>"
                            <?php } ?>
                            <?php if (isset($action) && $action === 'view_product') { ?>
                                readonly
                            <?php } ?>
                    >
                    </label>
                </div>
            </div>
            <?php if (isset($categories) && $categories > 0) { ?>
                <div class="second-row-multiselect">
                    <div class="gm_pv_wrap_multiselect">
                        <label>Associated Categories
                        <select name="categories_select[]" id="category_select" multiple>
                            <?php foreach ($categories as $cat) { ?>
                                <option
                                        value="<?php echo $cat->id ?>"
                                        <?php if (
                                                isset($selectedCategories) &&
                                                in_array($cat->id, $selectedCategories)
                                        ) { ?>
                                            selected
                                        <?php } ?>
                                        <?php if (isset($action) && $action === 'view_product') { ?>
                                            disabled = "true"
                                        <?php } ?>
                                >
                                    <?php echo $cat->title_category ?>
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