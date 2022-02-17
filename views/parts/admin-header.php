<div class="gm_pv_admin_header">
    <h3 id="title-header"><?php echo $titleHeader ?? '' ?></h3>
    <?php if (isset($urlNewElem, $textBtnNewElem)) { ?>
        <div class="wrap_btn_new_elem">
            <a href="<?php echo $urlNewElem ?>" class="button"><?php echo $textBtnNewElem ?></a>
        </div>
    <?php } ?>
</div>