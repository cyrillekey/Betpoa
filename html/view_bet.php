<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betresult</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4M2S2XBJ16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4M2S2XBJ16');
</script>
</head>

<body>
    <?php
    session_start();
    require('../php_handlers/get_cookie.php');
    mango();
    $betid = $_GET['bet'];
    include('../conn/conn.php');
    $total = 1;
    if(!isset($_SESSION['usernumber'])){
        header('location:../index.php');
        exit();
        
    }
    
    ?>
    <script>
        $(document).ready(function() {
            $('#placebet').keyup(function() {
                var stake = $("#placebet").val();
                var odds = $('.betslip-total-odds-value').html()
                $('.betslip-total-stake-value').html("KSH " + parseFloat(stake).toFixed(2));
                $('.betslip-potential-payout-value').html("KSH " + (odds * stake).toFixed(2));
            });
        });
    </script>
    <div class="betslip-container" id="modal">
        <div class="betslip-header-container">
            <div class="betslip-type-container"><span class="betslip-type">MultiBet</span> <span class="betslip-bet-count">(
                    )
                </span> <span class="betslip-odds">@
                    <?$_SESSION['total']?>
                </span> </div>
        </div>
        <div class="betslip-clear" id="close"><span><a href="">Close betslip</a></span></div>
        <div class="betslip-pick-container">
            <?php
            //$sql = "SELECT * FROM betsplaced WHERE user__id=? and bet_id=?";
            $sql="SELECT `bets_table`.`bet_id` AS `bet_id`, `bets_table`.`user__id` AS `user__id`, `bets_table`.`bet_status` AS `bet_status`, `bets_table`.`bet_amount` AS `bet_amount`, `bets_table`.`possiblewin` AS `possiblewin`, `bets_table`.`total_odds` AS `total_odds`, `betslip_table`.`bet_value` AS `bet_value`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`gamestatus` AS `gamestatus`, `markets_table`.`result` AS `result`,`markets_table`.`total_goals`,`markets_table`.`halftime`,`markets_table`.`gg` FROM ((`bets_table` join `betslip_table` on(`bets_table`.`bet_id` = `betslip_table`.`bet_id`)) join `markets_table` on(`markets_table`.`fixture_id` = `betslip_table`.`fixture_id`)) WHERE bets_table.bet_id= ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($betid));

            while ($row = $stmt->fetch()) {
                $value = $row->bet_value;

                if (
                    $row->gamestatus == "NS" || $row->gamestatus == "TBD" || $row->gamestatus == "1H" ||  $row->gamestatus == "PST" ||  $row->gamestatus == "CAN" ||  $row->gamestatus == "HT" ||  $row->gamestatus == "SUS" ||  $row->gamestatus == "2H"
                ) {
                    echo '<div class="betslip-pick">
                                <div class="pick-dismiss" style="color:blue;">
                                    <i class="fa fa-minus"></i>
                                    
                                </div>
                                <div class="pick-details">
                                    <span>Your Pick:';
                    if ($value == "1") {
                        echo ($row->home_team);
                    } elseif ($value == "3") {
                        echo ($row->away_team);
                    } elseif ($value == "2") {
                        echo ("Draw");
                    }elseif($value=="4"){
                        echo("Home/Draw");
                    }elseif($value=="5"){
                        echo("Home/Away");
                    }elseif($value=="6"){
                        echo("Away/Draw");
                    }elseif($value=="l"){
                        echo("Home Win to nill-Yes");
                    }elseif($value=="m"){
                        echo("Home Win to Nill-No");
                    }elseif($value=="n"){
                        echo("Away Win To Nill-yes");
                    }elseif($value=="o"){
                        echo("Away Win To Nill-No");
                    }elseif($value=="7"){
                        echo("Under 0.5");
                    }elseif($value=="8"){
                        echo("Over 0.5");
                    }elseif($value=="9"){
                        echo("Over 1.5");
                    }elseif($value=="0"){
                        echo("Under 1.5");
                    }elseif($value=="a"){
                        echo("Over 2.5");
                    }elseif($value=="b"){
                        echo("Under 2.5");
                    }elseif($value=="c"){
                        echo("Over 3.5");
                    }elseif($value=="d"){
                        echo("Under 3.5");
                    }elseif($value=="e"){
                        echo("Draw no Bet Home");
                    }elseif($value=="f"){
                        echo("Draw no Bet Away");
                    }elseif($value=="g"){
                        echo("Haltime - Home");
                    }elseif($value=="h"){
                        echo("Haltime - Draw");
                    }elseif($value=="i"){
                        echo("Haltime - Away");
                    }elseif($value=="j"){
                        echo("Both Team To Score");
                    }elseif($value=="k"){
                        echo("Both Teams To Score No");
                    }
                    echo '</span>
                                    <br/>
                                    <span>Stasus: pending </span>
                                    </br>
                                    <span>' . $row->home_team . ' vs ' . $row->away_team . '</span>
                                </div>
                                <div class="pick-odds"> Result: ' . $row->result . '</div>
                                </div>';
                } else {
                    if ($row->bet_value == 1 & $row->result == "home" || $row->bet_value == 2 & $row->result == "draw" || $row->bet_value == 3 & $row->result == "away" || 
                    $row->bet_value=="g" && $row->halftime == "home" || $row->bet_value=="h" && $row->halftime == "draw" || $row->bet_value=="i" && $row->halftime == "away" || 
                    $row->bet_value=="j" && $row->gg == 1 || $row->bet_value=="k" && $row->gg == 2 || ($row->bet_value=="4" && 
($row->result == "home" || $row->result=="draw")) || 
                    ($row->bet_value=="5" && ($row->result == "home" || $row->result=="away")) 
                    || ($row->bet_value=="6" && ($row->result == "away" || $row->result=="draw")) || ($row->bet_value=="l" && ($row->result=="home" && $row->gg==1)) || 
                    ($row->bet_value=="m" && ($row->result=="home" && $row->gg==2)) || ($row->bet_value=="n" && ($row->result=="away" && $row->gg==1)) || ($row->bet_value=="o" && ($row->result=="away" && $row->gg==2))
                    ||($row->bet_value==7 && $row->total_goals < 1) ||($row->bet_value==8 && $row->total_goals > 1) ||($row->bet_value==9 && $row->total_goals >1) || 
                    ($row->bet_value==0 && $row->total_goals<2) ||($row->bet_value=="a" && $row->total_goals>2) ||
                    ($row->bet_value=="b" && $row->total_goals<3) ||($row->bet_value=="c" && $row->total_goals>3) ||($row->bet_value=="d" && $row->total_goals<4) 
                    || ($row->bet_value == "e" && $row->result == "home") || ($row->bet_value == "f" && $row->result == "away") 
                    || ($row->bet_value == "e" && $row->result == "draw") || ($row->bet_value == "e" && $row->result == "draw")
                    ) 
                     {
                        echo '<div class="betslip-pick">
                                <div class="pick-dismiss" style="color:green;">
                                    <i class="fa fa-check"></i>
                                    
                                </div>
                                <div class="pick-details">
                                    <span>Your Pick:';
                        if ($value == "1") {
                            echo ($row->home_team);
                        } elseif ($value == "3") {
                            echo ($row->away_team);
                        } elseif ($value == "2") {
                            echo ("Draw");
                        }elseif($value=="4"){
                            echo("Home/Draw");
                        }elseif($value=="5"){
                            echo("Home/Away");
                        }elseif($value=="6"){
                            echo("Away/Draw");
                        }elseif($value=="l"){
                            echo("Home Win to nill-Yes");
                        }elseif($value=="m"){
                            echo("Home Win to Nill-No");
                        }elseif($value=="n"){
                            echo("Away Win To Nill-yes");
                        }elseif($value=="o"){
                            echo("Away Win To Nill-No");
                        }elseif($value=="7"){
                            echo("Under 0.5");
                        }elseif($value=="8"){
                            echo("Over 0.5");
                        }elseif($value=="9"){
                            echo("Over 1.5");
                        }elseif($value=="0"){
                            echo("Under 1.5");
                        }elseif($value=="a"){
                            echo("Over 2.5");
                        }elseif($value=="b"){
                            echo("Under 2.5");
                        }elseif($value=="c"){
                            echo("Over 3.5");
                        }elseif($value=="d"){
                            echo("Under 3.5");
                        }elseif($value=="e"){
                            echo("Draw no Bet Home");
                        }elseif($value=="f"){
                            echo("Draw no Bet Away");
                        }elseif($value=="g"){
                            echo("Haltime - Home");
                        }elseif($value=="h"){
                            echo("Haltime - Draw");
                        }elseif($value=="i"){
                            echo("Haltime - Away");
                        }elseif($value=="j"){
                            echo("Both Team To Score");
                        }elseif($value=="k"){
                            echo("Both Teams To Score No");
                        }
                        echo '</span>
                                    <br/>
                                    <span>Stasus: Won </span>
                                    </br>
                                    <span>' . $row->home_team . ' vs ' . $row->away_team . '</span>
                                </div>
                                <div class="pick-odds"> Result: ' . $row->result . '</div>
                                </div>';
                    } else {
                        echo '<div class="betslip-pick">
                    <div class="pick-dismiss" style="color:red;">
                        <i class="fa fa-times"></i>
                        
                    </div>
                    <div class="pick-details">
                        <span>Your Pick:';
                        if ($value == "1") {
                            echo ($row->home_team);
                        } elseif ($value == "3") {
                            echo ($row->away_team);
                        } elseif ($value == "2") {
                            echo ("Draw");
                        }elseif($value=="4"){
                            echo("Home/Draw");
                        }elseif($value=="5"){
                            echo("Home/Away");
                        }elseif($value=="6"){
                            echo("Away/Draw");
                        }elseif($value=="l"){
                            echo("Home Win to nill-Yes");
                        }elseif($value=="m"){
                            echo("Home Win to Nill-No");
                        }elseif($value=="n"){
                            echo("Away Win To Nill-yes");
                        }elseif($value=="o"){
                            echo("Away Win To Nill-No");
                        }elseif($value=="7"){
                            echo("Under 0.5");
                        }elseif($value=="8"){
                            echo("Over 0.5");
                        }elseif($value=="9"){
                            echo("Over 1.5");
                        }elseif($value=="0"){
                            echo("Under 1.5");
                        }elseif($value=="a"){
                            echo("Over 2.5");
                        }elseif($value=="b"){
                            echo("Under 2.5");
                        }elseif($value=="c"){
                            echo("Over 3.5");
                        }elseif($value=="d"){
                            echo("Under 3.5");
                        }elseif($value=="e"){
                            echo("Draw no Bet Home");
                        }elseif($value=="f"){
                            echo("Draw no Bet Away");
                        }elseif($value=="g"){
                            echo("Haltime - Home");
                        }elseif($value=="h"){
                            echo("Haltime - Draw");
                        }elseif($value=="i"){
                            echo("Haltime - Away");
                        }elseif($value=="j"){
                            echo("Both Team To Score");
                        }elseif($value=="k"){
                            echo("Both Teams To Score No");
                        }
                        echo '</span>
                        <br/>
                        <span>Stasus: Lost </span>
                        </br>
                        <span>' . $row->home_team . ' vs ' . $row->away_team . '</span>
                    </div>
                    <div class="pick-odds"> Result: ' . $row->result . '</div>
                    </div>';
                    }
                }
            }
            $sql = "SELECT * FROM bets_table WHERE user__id=? and bet_id=?";

            
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($_SESSION['usernumber'], $betid));
            $row = $stmt->fetch();
            echo '</div>
                            <form method="post">
                            <div class="betslip-accumulators">
                            
                                <div class="accumulator-name">Multibet</div>
                                <div class="accumulator-amount"></div>
                            </div>
                            
                            <div class="betslip-details">
                                <div class="betslip-total-stake"><span>Total Stake</span>
                                <span class="betslip-total-stake-value">KSH ' . $row->bet_amount . '</span>
                            </div>
                            <div class="betslip-total-odds">
                                <span>Total Odds</span>
                                <span class="betslip-total-odds-value" id="odds">' . $row->total_odds . '</span>
                            </div>
                            <div class="betslip-potential-payout">
                                <span>Potential Payout</span>
                                <span class="betslip-potential-payout-value" id="payout">KSH ' . $row->possiblewin . '</span>
                            </div>
                            </div>';
            if ($row->bet_status == "Won") {
                echo '
                            <div class="betslip-submit">
                                <button disabled type="submit" class="betslip-submit-button" style="background-color:green;">' . $row->bet_status . '</button>
                            </div>
                            
                </div>
                        </form>
                ';
            } elseif ($row->bet_status == "Lost") {
                echo '
                    <div class="betslip-submit">
                        <button disabled type="submit" class="betslip-submit-button" style="background-color:red;">' . $row->bet_status . '</button>
                    </div>
                    
        </div>
                </form>
        ';
            } elseif ($row->bet_status == "pending") {
                echo '
                    <div class="betslip-submit">
                        <button disabled type="submit" class="betslip-submit-button" style="background-color:teal;">' . $row->bet_status . '</button>
                    </div>
                    
        </div>
                </form>
        ';
            }







            ?>

</body>

</html>