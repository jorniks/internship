

(function($) {

    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    $('.back-to-top').click(function(e) {
        e.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

})(jQuery);


// FUNCTION TO DISPLAY ERROR MESSAGE WHEN ANY TEXTBOX IS EMPTY AND GIVE FOCUS TO THAT TEXTBOX
function emptiness(label, field, message) {
    $("."+label).html("Fill the "+ message +" field");
    $("#"+field).focus();
}

function successMessage(label, message) {
    $("."+label).html("<div class='alert alert-success'>" + message + "</div>");
}

function errorMessage(label, message) {
    $("."+label).html("<div class='alert alert-danger'>" + message + "</div>");
}