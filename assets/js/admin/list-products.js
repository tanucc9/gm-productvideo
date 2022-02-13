jQuery( document ).ready(function () {

    //edit product
    jQuery(".action_edit").on('click', function() {

        const idProd = parseInt(this.id.split("_")[1]);
        const selectedRow = jQuery("#row_" + idProd);

        showActions(selectedRow, true);
        showInputsToEdit(selectedRow, true);
    });

    // Delete product
    jQuery(".action_delete").on('click', function() {

        const idProd = parseInt(this.id.split("_")[1]);
        const selectedRow = jQuery("#row_" + idProd);

        if (isDeleteConfirmed(idProd)) {
            jQuery.ajax({
                url: ajaxurl.ajaxurl,
                dataType: 'json',
                method: 'POST',
                data: {
                    action: 'delete_product',
                    idProd: idProd
                },
                success: function(result) {
                    if (result.res) {
                        selectedRow.remove();

                        //Alert success
                        setAlert("Done! Product " + idProd + " deleted.", "success");
                    } else {
                        //Alert error
                        setAlert("There was an error on deleting product " + idProd + ".", "danger");
                    }
                }
            });
        }
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
                setAlert("Done! Product " + idProd + " updated.", "success");
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

function setAlert(textAlert, typeAlert) {
    jQuery("#alert_component strong").text(textAlert);
    if (typeAlert === "success") {
        jQuery("#alert_component").removeClass("alert-danger");
        jQuery("#alert_component").addClass("alert-success");
    } else if (typeAlert === 'danger') {
        jQuery("#alert_component").removeClass("alert-success");
        jQuery("#alert_component").addClass("alert-danger");
    }

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

function isDeleteConfirmed(idProd) {
    return confirm("Do you want to delete the product " + idProd + "?");
}