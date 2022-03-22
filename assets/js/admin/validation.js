jQuery(document).ready(function () {
    jQuery("#submit-add_product-form").on('click', validateFields);
    jQuery("#submit-submit_edit-form").on('click', validateFields);
});

function validateFields(event) {
    event.preventDefault();
    let alertMessage = "There are errors.\n";

    const isValidUrlVideo = validateUrlVideo();
    if (!isValidUrlVideo)
        alertMessage += "The format of the url video has to be one of the following: https://youtu.be/8VLTQUVCxbE\n" +
            "https://www.youtube.com/shorts/8VLTQUVCxbE\n" +
            "https://www.youtube.com/embed/5gxtRPyW4n0  \n";

    if (isValidUrlVideo)
        jQuery("#product_form").submit();
    else
        alert(alertMessage);
}

function validateUrlVideo() {
    const urlVideo = jQuery("#url_video");

    if (typeof urlVideo !== 'undefined') {

        // Examples string accepted by regex
        //https://youtu.be/8VLTQUVCxbE
        //https://www.youtube.com/shorts/8VLTQUVCxbE
        //https://www.youtube.com/embed/5gxtRPyW4n0
        const patternUrlVideo = /^(https:\/\/www\.youtube\.com\/embed\/|https:\/\/www\.youtube\.com\/shorts\/|https:\/\/youtu.be\/)[^\n \/]+$/;
        if (patternUrlVideo.test(urlVideo.val())) {
            urlVideo.css("borderColor", "green");
            return true;
        } else {
            urlVideo.css("borderColor", "red");
            return false;
        }
    }
}