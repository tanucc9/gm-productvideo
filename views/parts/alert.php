<?php if (isset($alertType, $alertMessage)) { ?>
<div
        id="alert_component"
        class="alert alert-<?php echo $alertType ?> alert-dismissible fade show"
        role="alert"
>
    <?php echo $alertMessage ?>
</div>
<?php } ?>