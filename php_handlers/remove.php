
<?php
session_start();
$items = $_SESSION['betslip'];
$cartitems = explode(",", $items);
$games=$_SESSION['betslip_games'];
$games_array2 = explode(",", $_SESSION['betslip_games']);
if(isset($_POST['remove']) & !empty($_POST['remove'])){
    /********** */
    $pdid = $_POST['remove'];
    $marketspec = substr($pdid, 0, -1);
    $delitem = array_search($pdid, $cartitems);
            $delitem2 = array_search($marketspec, $games_array2);
            unset($cartitems[$delitem]);
            unset($games_array2[$delitem2]);
            $itemids = implode(",", $cartitems);
            $itemids2 = implode(",", $games_array2);
            $_SESSION['betslip'] = $itemids;
            $_SESSION['betslip_games'] = $itemids2;
    /*** *
    $pdid = $_POST['remove'];
    $marketspec = substr($pdid, 0, -1);
    echo($marketspec);
    $delitem=array_search($pdid,$cartitems);
    $delitem2=array_search($marketspec,$games_array2);
    unset($cartitems[$delitem]);
    unset($games_array2[$delitem2]);
    if(!empty($delitem2)){
    echo("1way");
    }
    print_r($games_array2);
	$itemids = implode(",", $cartitems);
    $_SESSION['betslip'] = $itemids;
    $itemids2=implode(",",$games_array2);
    $_SESSION['beslip_games']=$itemids2;*/
}
echo count(array_filter(explode(",",$_SESSION['betslip'])));