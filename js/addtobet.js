$(document).ready(function() {
    $(".match-odd").click(function(e) {
        e.preventDefault();
        var commarket = $(this).attr("id");
        if ($(this).hasClass("clicked")) {
            var ids = JSON.parse(sessionStorage.getItem("names"));

            const index = ids.indexOf(commarket);
            if (index > -1) {
                ids.splice(index, 1);
            }
            sessionStorage.setItem("names", JSON.stringify(ids));
            $(this).removeClass("clicked");
        } else {
            $(this).addClass("clicked");
            if (sessionStorage.getItem("names") === null) {
                var ids = [];
            } else {
                var ids = JSON.parse(sessionStorage.getItem("names"));
            }
            ids.push(commarket);
            sessionStorage.setItem("names", JSON.stringify(ids));
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
                    console.log("in array");
                    var ids = JSON.parse(sessionStorage.getItem("names"));

                    const index = ids.indexOf(commarket);
                    if (index > -1) {
                        ids.splice(index, 1);
                    }
                    sessionStorage.setItem("names", JSON.stringify(ids));
                    $(this).removeClass("clicked");
                    $("#" + commarket).removeClass("clicked");
                } else {
                    $("#float").html(result);
                }
            },
        });
    });
});

function myname() {
    $("#modal").css("display", "none");
    location.reload();
}

$(document).ready(function() {
    if (sessionStorage.getItem("names") != null) {
        var stored = JSON.parse(sessionStorage.getItem("names"));
        for (i = 0; i < stored.length; i++) {
            $("#" + stored[i]).addClass("clicked");
        }
    }
    $("#float").click(function() {
        $("#bettingbody").load("html/betslip.php");
    });
});