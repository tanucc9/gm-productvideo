<?php if (isset($totPages) && $totPages > 1) {
    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    ?>
    <nav>
        <ul class="gm_pv_pagination">
            <li class="gm_pv_page-item gm_pv_previous_pag">
                <a
                    class="page-link"
                    <?php if (isset($currentPage) && $currentPage > 1) { ?>
                        href="<?php echo $current_url ?>?page_to_show=<?php echo($currentPage - 1) ?>"
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
                <li class="gm_pv_page-item <?php if (($isFirstPage && $i === 1) || ($isLastPage && $i === $numButtons) || (!$isFirstPage && !$isLastPage && $i === 2)) {?> active <?php } ?>">
                    <a
                        class="page-link"
                        href="<?php echo $current_url ?>?page_to_show=<?php echo $pageValue ?>"
                    >
                        <?php echo $pageValue ?>
                    </a>
                </li>
            <?php } ?>

            <li class="gm_pv_page-item gm_pv_next_pag">
                <a
                    class="page-link"
                    <?php if (isset($isLastPage) && !$isLastPage) { ?>
                        href="<?php echo $current_url ?>?page_to_show=<?php echo($currentPage + 1) ?>"
                    <?php } ?>
                    aria-label="Next"
                >
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>

    <style>
        .gm_pv_pagination {
            display: flex;
            justify-content: center;
        }

        .gm_pv_previous_pag a {
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
        }

        .gm_pv_next_pag a {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .gm_pv_page-item a {
            padding: 5px 10px;
            border: 1px solid #dee2e6
        }

        .gm_pv_page-item {
            list-style-type: none;
        }

        .gm_pv_page-item.active {
            background-color: #007bff;
        }

        .gm_pv_page-item.active a {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff
        }
    </style>
<?php } ?>