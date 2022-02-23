jQuery(document).ready(function() {
    jQuery("#copy_shortcode").on("click", function() {
        const shortcode = jQuery(this).attr("data-shortcode");
        navigator.clipboard.writeText(shortcode);

        alert(shortcode + " copied!");
    });
});