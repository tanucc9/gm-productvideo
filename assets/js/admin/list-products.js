jQuery( document ).ready(function () {

    //edit product
    jQuery(".action_edit").on('click', function() {

        const idProd = parseInt(this.id.split("_")[1]);
        const selectedRow = jQuery("#row_" + idProd);

        showActions(selectedRow, true);
        showInputsToEdit(selectedRow, true);

    });

    //Save edit product
    jQuery(".save_edit button").on('click', function() {
        jQuery(this).text("Saving...");
        jQuery(this).attr("disabled","disabled");

        const idProd = parseInt(jQuery(this).parent().attr("id").split("_")[1]);
        const selectedRow = jQuery("#row_" + idProd);
        selectedRow.find(".title_field input").attr("readonly", "readonly");
        selectedRow.find(".url_field input").attr("readonly","readonly");

        const title = selectedRow.find(".title_field input").val();
        const url_video = selectedRow.find(".url_field input").val();

        jQuery.ajax({
            url: ajaxurl.ajaxurl,
            dataType: 'json',
            method: 'POST',
            data: {
                action: 'edit_product',
                idProd: idProd,
                title: title,
                url_video: url_video
            },
            success: function(result) {
                console.log(result);

                showActions(selectedRow, false);
                showInputsToEdit(selectedRow, false);
                selectedRow.find(".save_edit button").text("Save");
                selectedRow.find(".save_edit button").removeAttr("disabled");
                selectedRow.find(".title_field input").removeAttr("readonly");
                selectedRow.find(".url_field input").removeAttr("readonly");
                selectedRow.find(".title_field p").text(title);
                selectedRow.find(".url_field p").text(url_video);

                //Alert success
                setAlert("Done! Product " + idProd + " updated.");
            }
        });
    });
});

function showActions(selectedRow, isShowSaveButton) {
    if (isShowSaveButton) {
        selectedRow.find(".action_delete").css("display", "none");
        selectedRow.find(".action_edit").css("display", "none");
        selectedRow.find(".save_edit").css("display", "block");
    } else {
        selectedRow.find(".action_delete").css("display", "block");
        selectedRow.find(".action_edit").css("display", "block");
        selectedRow.find(".save_edit").css("display", "none");
    }
}

function showInputsToEdit(selectedRow, isShowInput) {
    if (isShowInput) {
        selectedRow.find(".title_field p").css("display", "none");
        selectedRow.find(".url_field p").css("display", "none");
        selectedRow.find(".title_field input").css("display", "block");
        selectedRow.find(".url_field input").css("display","block");
    } else {
        selectedRow.find(".title_field p").css("display", "block");
        selectedRow.find(".url_field p").css("display", "block");
        selectedRow.find(".title_field input").css("display", "none");
        selectedRow.find(".url_field input").css("display","none");
    }
}

function setAlert(textAlert) {
    jQuery("#alert_component strong").text(textAlert);

    fadeInAlert();
    fadeOutAlert();
}

function fadeInAlert() {
    jQuery("#alert_component").css("display", "block");
    setTimeout(function(){
        jQuery("#alert_component").addClass("m-fadeIn");
    }, 200);
}

function fadeOutAlert() {
    setTimeout(function() {
        jQuery("#alert_component").removeClass("m-fadeIn");
        jQuery("#alert_component").addClass("m-fadeOut");

        setTimeout(function() {
            jQuery("#alert_component").css("display", "none");
        }, 300);
    }, 3000);
}