<div class="container">

<?php
include(GM_PV__PLUGIN_DIR . 'views/parts/admin-header.php');
include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
?>

    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <input type="hidden" name="action" value="update_settings" />

        <label>Title most liked products
            <input
                    type="text"
                    name="most_liked_prod_title"
                    placeholder="Insert title here..."
                    <?php if (isset($titleMostLiked)) { ?>
                    value = "<?php echo $titleMostLiked; ?>"
                    <?php } ?>
                    id="gm_pv_title_most_liked_prod"/>
        </label>

        <label>Title newest products
            <input
                    type="text"
                    name="newest_prod_title"
                    placeholder="Insert title here..."
                <?php if (isset($titleNewestProd)) { ?>
                    value = "<?php echo $titleNewestProd; ?>"
                <?php } ?>
                    id="gm_pv_title_newest_prod"/>
        </label>

        <label>Starting likes
            <input
                    type="number"
                    name="num_starting_likes"
                <?php if (isset($numStartingLikes)) { ?>
                    value = "<?php echo $numStartingLikes; ?>"
                <?php } else { ?>
                    value="0"
                <?php } ?>
                    id="gm_pv_num_starting_likes"/>
        </label>

        <label>Show static description product
            <input
                    type="checkbox"
                    name="show_static_content"
                    id="gm_pv_show_static_content"
                    <?php if (isset($hasShowStatiContent) && $hasShowStatiContent) { ?>
                    checked
                    <?php } ?>
            />
        </label>

        <div id="gm_pv_urls_static_content">
            <label>Instagram URL where you want to redirect*
                <input
                        type="text"
                        name="instagram_url"
                        <?php if (isset($urlInsta) && $urlInsta) { ?>
                            value="<?php echo $urlInsta ?>"
                        <?php } ?>
                        id="gm_pv_instagram_url"/>
            </label>

            <label>Facebook URL where you want to redirect*
                <input
                        type="text"
                        name="facebook_url"
                        <?php if (isset($urlFb) && $urlFb) { ?>
                            value="<?php echo $urlFb ?>"
                        <?php } ?>
                        id="gm_pv_facebook_url"/>
            </label>
        </div>

        <?php if (isset($textSubmitBtn)) { ?>
            <div class="gm_pv_wrap_submit">
                <button type="submit" class="button" id="submit-settings-form">
                    <?php echo $textSubmitBtn ?>
                </button>
            </div>
        <?php } ?>

    </form>


</div>
