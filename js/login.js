jQuery(function($) {
    var allpass = false;
    $("#submit").attr("disabled", true);
    var $fields = $("#email-address,#password");
    $fields.on("keyup", function() {
        var number = $('#email-address').val();
        var password = $('#password').val();
        var remember = $("#remember_me").val();
        if (number.length > 9 && password.length > 5) {
            allpass = true;
            $("#submit").attr("disabled", false);
            $("#submit")
                .removeClass("bg-gray-600", "hover:bg-gray-700")
                .addClass("bg-indigo-600", "hover:bg-indigo-700");
            $("#lock").addClass("hidden");
        } else {
            $("#submit").attr("disabled", true);
            $("#submit")
                .addClass("bg-gray-600", "hover:bg-gray-700")
                .removeClass("bg-indigo-600", "hover:bg-indigo-700");
            $("#lock").removeClass("hidden");
        }
    });
    $("#submit").click(function(e) {
        e.preventDefault();
        if (allpass == true) {
            $.ajax({
                type: "POST",
                url: "../php_handlers/login_handle.php",
                data: {
                    status: allpass,
                    usernumber: $('#email-address').val(),
                    password: $('#password').val(),
                    remember: $('#remember_me').is(":checked")
                },
                success: function(response) {
                    var drad = $.trim(response);
                    if (drad == 'login') {
                        window.location.replace("../index.php");
                    } else if (drad == 'nouser') {
                        alert('no user');
                    } else if (drad == "pwd") {
                        alert("wrong password");
                    } else if (drad == "on") {
                        alert("wheeeep")
                    } else if (drad == "off") {
                        alert("whoope")
                    } else {
                        alert(drad)
                    }
                }
            });
        }
    })
});