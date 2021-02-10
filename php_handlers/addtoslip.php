<?php
session_start();
$marketid = $_POST['market'];
$marketspec = substr($marketid, 0, -1);
if (isset($_SESSION['betslip']) & !empty($_SESSION['betslip']) & isset($_SESSION['betslip_games']) & !empty($_SESSION['betslip_games'])) {
    $games = $_SESSION['betslip'];
    $games2 = $_SESSION['betslip_games'];
    $games_array = explode(",", $games);
    $games_array2 = explode(",", $games2);

    if (in_array($marketid, $games_array)) {
        $delitem = array_search($marketid, $games_array);
            $delitem2 = array_search($marketspec, $games_array2);
            unset($games_array[$delitem]);
            unset($games_array2[$delitem2]);
            $itemids = implode(",", $games_array);
            $itemids2 = implode(",", $games_array2);
            $_SESSION['betslip'] = $itemids;
            $_SESSION['betslip_games'] = $itemids2;
            //we have removed game id now add new id
            
            echo count(array_filter(explode(",", $_SESSION['betslip'])));
        
    } else {
        if (in_array($marketspec, $games_array2)) {/*
            $delitem = array_search($marketid, $games_array);
            $delitem2 = array_search($marketspec, $games_array2);
            unset($games_array[$delitem]);
            unset($games_array2[$delitem2]);
            $itemids = implode(",", $games_array);
            $itemids2 = implode(",", $games_array2);
            $_SESSION['betslip'] = $itemids;
            $_SESSION['betslip_games'] = $itemids2;
            //we have removed game from id now add new
            $games .= "," . $marketid;
            $_SESSION['betslip'] = $games;*/
            echo"already";
            //echo count(array_filter(explode(",", $_SESSION['betslip'])));
        } else {
            $games .= "," . $marketid;
            $games2 .= "," . $marketspec;
            $_SESSION['betslip'] = $games;
            $_SESSION['betslip_games'] = $games2;
            
            echo count(array_filter(explode(",", $_SESSION['betslip'])));
            
            
        
        }
    }
} else {

    $games = $marketid;
    $_SESSION['betslip'] = $games;
    $_SESSION['betslip_games'] = $marketspec;
    echo count(array_filter(explode(",", $_SESSION['betslip'])));
}
?>


