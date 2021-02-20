$(document).ready(function() {
    var searchresult = null;

    $("#search").on("keyup", function() {
        var search = $(this).val()
        var that = this;
        if (search.length > 2) {
            if (searchresult != null) searchresult.abort();
            $.ajax({
                type: "POST",
                url: "html/result.php",
                data: {
                    name: search
                },
                success: function(response) {
                    $('.bettingbody').css("display", "none");
                    $('.searchre').css("display", "block");
                    $('.searchre').html(response);

                }
            });



        } else {
            $('.searchre').css("display", "none");
            $('.bettingbody').css("display", "block");
            if (search.length == 0) {
                location.reload();
            }
        }
    });
});