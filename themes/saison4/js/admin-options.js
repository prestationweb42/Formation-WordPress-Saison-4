// alert("toto");
jQuery(document).ready(function ($) {
    // Create a new media frame
    const frame = wp.media({
        title: "Select or Upload Media",
        button: {
            text: "Use this media",
        },
        multiple: false, // Set to true to allow multiple files to be selected
    });

    // Open media with Btn
    $("#btn_img_01").click(function (e) {
        e.preventDefault();
        // Open media
        frame.open();
    });

    // Get media attachment details from the frame state
    frame.on("select", function () {
        let objImg = frame.state().get("selection").first().toJSON();
        let img_url = objImg.sizes.medium_large.url;
        // console.log();
        $("img#img_preview_01").attr("src", img_url);
        $("input#dvmac_img_01").attr("value", img_url);
        // Hidden input for submit in BDD
        $("input#dvmac_hidden_img_01").attr("value", img_url);
    });
});
