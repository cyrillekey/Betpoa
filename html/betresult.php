<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betresult</title>
    <link rel="stylesheet" href="../css/style2.css">
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
        <div class="betslip-clear" id="close"><span><a href="mybets.php">Close betslip</a></span></div>
        <div class="betslip-pick-container">
            <?php
            $sql = "SELECT * FROM betsplaced WHERE /*user__id=? and */bet_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(/*$_SESSION['usernumber'], */$betid));

            while ($row = $stmt->fetch()) {
                $value = $row->bet_value;

                if (
                    $row->gamestatus == "NS" || $row->gamestatus == "TBD"
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
                    if (($value == 1 && $row->result == "home") || ($value == 2 && $row->result == "draw") || ($value == 3 && $row->result == "away")) {
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
            $sql = "SELECT * FROM betsplaced WHERE /*user__id=? and*/ bet_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(/*$_SESSION['usernumber'], */$betid));
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