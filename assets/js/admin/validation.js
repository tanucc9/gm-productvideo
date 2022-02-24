jQuery(document).ready(function () {
    jQuery("#submit-add_product-form").on('click', validateFields);
    jQuery("#submit-submit_edit-form").on('click', validateFields);
});

function validateFields(event) {
    event.preventDefault();
    let alertMessage = "There are errors.\n";

    const isValidUrlVideo = validateUrlVideo();
    if (!isValidUrlVideo)
        alertMessage += "The format of the url video has to be as the following: https://www.youtube.com/embed/jkjh \n";

    if (isValidUrlVideo)
        jQuery("#product_form").submit();
    else
        alert(alertMessage);
}

function validateUrlVideo() {
    const urlVideo = jQuery("#url_video");

    if (typeof urlVideo !== 'undefined') {
        const patternUrlVideo = /^https:\/\/www\.youtube\.com\/embed\/[^\n \/]+$/;
        if (patternUrlVideo.test(urlVideo.val())) {
            urlVideo.css("borderColor", "green");
            return true;
        } else {
            urlVideo.css("borderColor", "red");
            return false;
        }
    }
}