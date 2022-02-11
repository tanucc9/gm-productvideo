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