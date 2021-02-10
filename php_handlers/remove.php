
<?php
session_start();
$items = $_SESSION['betslip'];
$cartitems = explode(",", $items);
if(isset($_POST['remove']) & !empty($_POST['remove'])){
    $pdid = $_POST['remove'];
    $delitem=array_search($pdid,$cartitems);
    
    unset($cartitems[$delitem]);
    
	$itemids = implode(",", $cartitems);
    $_SESSION['betslip'] = $itemids;
}
echo count(array_filter(explode(",",$_SESSION['betslip'])));