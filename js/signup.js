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
                        var access_key = "6df3b661f357fc77767c6b77120aa3c9";
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
                    } else if (result == "stop") {
                        alert("STOP!!!!!!");
                    } else {
                        alert('ana error occured.Please try again');
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
/*
$(document).ready(function() {
    $('#submit').click(function(e) {
        e.preventDefault();
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
                alert(result);
            }
        });
    })
});
/*
/*var number1 = document.getElementById("email-address");
number1= number1.value;
number = number1.substr(1, 10);
var access_key = "6df3b661f357fc77767c6b77120aa3c9";
var phone_number = "+254" + number;
var password = document.getElementById("password");
if (password.value.length < 6) {
  //password.classList.remove("border")
  pass1 = false;
} else {
  pass1 = true;
}
var password1 = document.getElementById("password1");
if (password1.value.length < 6) {
  pass2 = false;
} else {
  pass2 = true;
}

if ((pass1 == true) &$ (pass2 == true)) {
    alert("hello world");
$.ajax({
    url: "http://apilayer.net/api/validate?access_key=" +
        access_key +
        "&number=" +
        phone_number,
    dataType: "jsonp",
    success: function(json) {
        numberpass = json.valid;
        if (json.valid == "false") {
            number1.classList.replace("border-gray-300", "border-red-600");
        } else {}
    },
});
/*
if (pass1 == pass2) {
    $.ajax({
        url: "../php_handlers/signup_handle.php",
        type: "POST",
        data: {
            password: pass1,
            usernumber: number1
        },
        success: function(data) {
            var result = $.trim(data);
            alert(result);
        }
    });
}


}*/