$(document).ready(function() {
    $('.withdraw-confirm-popup__cancel').on('click', function() {

        window.location.href = "../index.php";
    });

    $('.withdraw-confirm-popup__submit').on('click', () => {

        var money = $('#money').val();
        var pnumber = $('#pnum').val();
        if (money < 100) {
            alert("Cannot withdraw less than 100");
        } else {
            $('.withdraw-confirm-popup__submit').text("Processing")
            $.ajax({
                type: "POST",
                url: "../php_handlers/withdrawhandle.php",

                data: {
                    "money": money,
                    "number": pnumber
                },
                success: function(response) {
                    var result = $.trim(response);
                    if (result == "0")
                        window.location.replace("../index.php");


                }
            });
        }

    });
});