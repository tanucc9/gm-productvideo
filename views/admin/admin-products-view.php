<div class="container">
<h3 id="title-showproducts">Products</h3>

<?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
?>

<?php
    if (isset($products)) { ?>
        <table class="table table-hover">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name Product</th>
                <th scope="col">URL Video</th>
                <th scope="col">Last Edit</th>
                <th scope="col">Actions</th>
            </tr>
        <?php foreach ($products as $product) { ?>
            <tr id="row_<?php echo $product->id ?>">
                <td scope="row"><p><?php echo $product->id ?></p></td>
                <td class="title_field">
                    <p><?php echo $product->title_product ?></p>
                    <input type="text" value="<?php echo $product->title_product ?>">
                </td>
                <td class="url_field">
                    <p><?php echo $product->url_video ?></p>
                    <input type="text" value="<?php echo $product->url_video ?>">
                </td>
                <td><p><?php echo $product->last_edit ?></p></td>
                <td class="icons">
                    <ul>
                        <li id="delete_<?php echo $product->id ?>" class="action_delete">
                            <a href="#"><span class="dashicons dashicons-trash"></span></a>
                        </li>
                        <li id="edit_<?php echo $product->id ?>" class="action_edit">
                            <a href="#"><span class="dashicons dashicons-edit-page"></span></a>
                        </li>

                        <li id="save_<?php echo $product->id ?>" class="save_edit">
                            <button type="button" class="btn btn-primary btn-sm">Save</button>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php } ?>
        </table>
<?php } else { ?>
    <h6>You haven't inserted products yet.</h6>
<?php } ?>

    <!--- Pagination --->
    <?php if (isset($totPages) && $totPages > 0) { ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item">
                <a
                    class="page-link"
                    <?php if (isset($currentPage) && $currentPage > 1) { ?>
                        href="<?php echo admin_url('admin.php?page=' . PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo'); ?>&page_to_show=<?php echo($currentPage - 1) ?>"
                    <?php } ?>
                    aria-label="Previous"
                >
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>

            <?php
                $numButtons = $totPages < 3 ? $totPages : 3;

                //If there are at least 3 pages
                if ($numButtons >= 3) {
                    if (isset($isFirstPage) && $isFirstPage) {
                        $centerValuePag = 2;
                    } elseif (isset($isLastPage) && $isLastPage) {
                        $centerValuePag = $currentPage - 1;
                    } else {
                        $centerValuePag = $currentPage;
                    }
                }
                for ($i = 1; $i <= $numButtons; $i++) {

                    //If there are at least 3 pages
                    if ($numButtons >= 3) {
                        if ($i === 1) {
                            $pageValue = $centerValuePag - 1;
                        } elseif ($i  === 2) {
                            $pageValue = $centerValuePag;
                        } else {
                            $pageValue = $centerValuePag + 1;
                        }
                    } else {
                        $pageValue = $i;
                    } ?>
                    <li class="page-item <?php if (($isFirstPage && $i === 1) || ($isLastPage && $i === $numButtons) || (!$isFirstPage && !$isLastPage && $i === 2)) {?> active <?php } ?>">
                        <a
                            class="page-link"
                            href="<?php echo admin_url('admin.php?page=' . PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo'); ?>&page_to_show=<?php echo $pageValue ?>"
                        >
                            <?php echo $pageValue ?>
                        </a>
                    </li>
                <?php } ?>

            <li class="page-item">
                <a
                    class="page-link"
                    <?php if (isset($isLastPage) && !$isLastPage) { ?>
                        href="<?php echo admin_url('admin.php?page=' . PARENT_SLUG_ADMIN_TAB . '-pv-show-productsvideo'); ?>&page_to_show=<?php echo($currentPage + 1) ?>"
                    <?php } ?>
                    aria-label="Next"
                >
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php } ?>
</div>