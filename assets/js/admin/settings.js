jQuery(document).ready(function () {

    if (document.getElementById("gm_pv_show_static_content").checked)
        showUrls();
    else
        hideUrls();

    jQuery("#gm_pv_show_static_content").on("change", function() {
        if (this.checked)
            showUrls();
        else
            hideUrls();
    });
});

function hideUrls() {
    let urls = jQuery("#gm_pv_urls_static_content");

    urls.find("#gm_pv_instagram_url").removeAttr("required");
    urls.find("#gm_pv_facebook_url").removeAttr("required");

    urls.hide();
}

function showUrls() {
    let urls = jQuery("#gm_pv_urls_static_content");

    urls.find("#gm_pv_instagram_url").attr("required", "required");
    urls.find("#gm_pv_facebook_url").attr("required", "required");

    urls.show();
}