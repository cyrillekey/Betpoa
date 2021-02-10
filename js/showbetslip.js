/*var modal=document.getElementById("modal");
var btn=document.getElementById("float");
var close=document.getElementById("close");
function myname () {
    modal.style.display="none";
}*/
$(document).ready(function(){
    $("#float").click(function(){
        $('#bettingbody').load("html/betslip.php");

    });
});
/*btn.onclick=function() {modal.style.display="block";}
window.onclick=function(event){
    if(event.target==modal){
        modal.style.display="none"
    }
}
*/