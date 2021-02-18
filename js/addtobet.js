$(document).ready(function() {
    $(".match-odd").click(function(e) {
        e.preventDefault();
        var commarket = $(this).attr("id");
        if ($(this).hasClass("clicked")) {
            $(this).removeClass("clicked");
        } else {
            $(this).addClass("clicked");
            localStorage.lang = this.getAttribute('lang');


        }
        $.ajax({
            url: "php_handlers/addtoslip.php",
            type: "POST",

            data: {
                market: commarket,
            },
            success: function(data) {
                var result = $.trim(data);
                if (result == "already") {
                    $("#" + commarket).removeClass("clicked");
                } else {
                    $("#float").html(result);
                }
            },
        });
    });
});
$(window).on('load', function() {
    var lang = localStorage.lang || "EN";
    $('a[lang="' + lang + '"]').addClass("clicked");
});

function myname() {
    modal.style.display = "none";
}
$(document).ready(function() {
    $("#float").click(function() {
        $("#bettingbody").load("html/betslip.php");
    });
});