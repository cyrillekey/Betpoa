jQuery(function($) {
    var all_pass = false;
    $("#submit").attr("disabled", true);
    var $fields = $("#email-address,#password,#password1");

    $fields.on("keyup", function(event) {
        if (allFilled($fields)) {
            var number = $("#email-address").val();
            var pass = $("#password").val();
            var pass2 = $("#password1").val();
            if (pass == pass2) {
                if (pass.length > 5 && pass2.length > 5) {
                    $("#password")
                        .removeClass("border-red-600", "focus:border-red-600")
                        .addClass("focus:border-indigo-600");
                    $("#password1")
                        .removeClass("border-red-600", "focus:border-red-600")
                        .addClass("focus:border-indigo-600");
                    var number1;
                    if (number.length > 9) {
                        $("#email-address")
                            .removeClass("border-red-600", "focus:border-red-600")
                            .addClass("focus:border-indigo-600");

                        number1 = number.substr(1, 10);
                        var access_key = ""//your numverify access key;
                        var phone_number = "+254" + number1;

                        $.ajax({
                            url: "http://apilayer.net/api/validate?access_key=" +
                                access_key +
                                "&number=" +
                                phone_number,
                            dataType: "jsonp",
                            success: function(json) {
                                var numberpass = json.valid;
                                //var numberpass = true;
                                if (numberpass) {
                                    all_pass = true;
                                    $("#email-address").removeClass(
                                        "border-red-600",
                                        "focus:border-red-600"
                                    );
                                    $("#submit").attr("disabled", false);
                                    $("#submit")
                                        .removeClass("bg-gray-600", "hover:bg-gray-700")
                                        .addClass("bg-indigo-600", "hover:bg-indigo-700");
                                    $("#lock").addClass("hidden");
                                } else {
                                    all_pass = false;
                                    $("#email-address")
                                        .addClass("border-red-600", "focus:border-red-600")
                                        .removeClass("focus:border-indigo-600");
                                    $("#submit").attr("disabled", true);
                                    $("#submit")
                                        .addClass("bg-gray-600", "hover:bg-gray-700")
                                        .removeClass("bg-indigo-600", "hover:bg-indigo-700");
                                    $("#lock").removeClass("hidden");
                                }
                            },
                        });
                    } else {

                        $("#email-address")
                            .addClass("border-red-600", "focus:border-red-600")
                            .removeClass("focus:border-indigo-600");
                        $("#submit").attr("disabled", true);
                        $("#submit")
                            .addClass("bg-gray-600", "hover:bg-gray-700")
                            .removeClass("bg-indigo-600", "hover:bg-indigo-700");
                        $("#lock").removeClass("hidden");

                    }
                } else {
                    alert('short pass');
                }
            } else {

                $("#password")
                    .addClass("border-red-600", "focus:border-red-600")
                    .removeClass("focus:border-indigo-600");
                $("#password1")
                    .addClass("border-red-600", "focus:border-red-600")
                    .removeClass("focus:border-indigo-600");
                $("#submit").attr("disabled", true);
                $("#submit")
                    .addClass("bg-gray-600", "hover:bg-gray-700")
                    .removeClass("bg-indigo-600", "hover:bg-indigo-700");
                $("#lock").removeClass("hidden");
            }
        }
    });
    $('#submit').click(function(e) {
        e.preventDefault();
        $(this).text('Signing up');
        if (all_pass) {

            var number = $('#email-address').val();
            var pass = $('#password').val();
            var pass2 = $('#password1').val();
            $.ajax({
                url: "../php_handlers/signup_handle.php",
                type: "POST",
                data: {
                    password: pass2,
                    usernumber: number
                },
                success: function(data) {
                    var result = $.trim(data);
                    if (result == "success") {
                        window.location.replace("../index.php");
                    } else if (result == 'regis') {
                        alert("number registered try a different number");
                        $("submit").text('Sign up');
                    } else if (result == "stop") {
                        alert("STOP!!!!!!");
                        $("#submit").text('Sign up');
                    } else if (result == "work") {
                        alert('ana error occured.Please try again');
                        $("#submit").text('Sign up');
                    }
                }
            });
        }
    });
});

function allFilled($fields) {
    return (
        $fields.filter(function() {
            return this.value === "";
        }).length == 0
    );
}