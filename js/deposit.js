   $('.payment-entity').on('click', function() {
       // Set active class
       $('.payment-selection .payment-entity').removeClass('selected');
       $(this).addClass('selected');

       // Show correct info
       $('.provider-section').addClass('hide');
       $('.' + $(this).data('payment')).removeClass('hide');
   });
   $('#pay').on('click', function() {

       var number = $("#pnumber").val()
       var amount = $("#amount").val();
       if (amount == "") {
           alert("hello");
       } else {
           $(this).text("Loading...");
           $.ajax({
               type: "POST",
               url: "../php_handlers/mpesatransact.php",
               data: {
                   "amount": amount,
                   "number": number
               },
               success: function(response) {
                   var response = $.trim(response);
                   if (response == "0") {
                       $("#pay").text("Success")
                   } else {
                       alert("did not work")
                   }
               }
           });
       }
   });