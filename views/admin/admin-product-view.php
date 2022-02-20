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
                    <input
                            type="text"
                            placeholder="Name Product*"
                            name="name_product"
                            required
                            <?php if (
                                    isset($action) &&
                                    $action === 'submit_edit'
                                    && isset($prod)
                            ) { ?>
                                value="<?php echo $prod->title_product ?>"
                            <?php } ?>
                    >
                </div>
                <div class="gm_pv_wrap_input gm_pv_wrap_input_url">
                    <input
                            type="text"
                            placeholder="URL Video*"
                            name="url_video"
                            required
                            <?php if (
                                isset($action) &&
                                $action === 'submit_edit'
                                && isset($prod)
                            ) { ?>
                                value="<?php echo $prod->url_video ?>"
                            <?php } ?>
                    >
                </div>
            </div>
            <?php if (isset($categories) && $categories > 0) { ?>
                <div class="second-row-multiselect">
                    <div class="gm_pv_wrap_multiselect">
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
                                >
                                    <?php echo $cat->title_category ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <div class="gm_pv_wrap_submit">
                <?php if (isset($textSubmitBtn)) { ?>
                    <button type="submit" class="button" id="submit-<?php echo $action ?? '' ?>-form">
                        <?php echo $textSubmitBtn ?>
                    </button>
                <?php } ?>
            </div>
        </form>