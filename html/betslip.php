<?php
session_start();
$games=$_SESSION['betslip'];
$games_list=explode(",",$games);
include('../conn/conn.php');
$total=1;
?>
<script>
        $(document).ready(function(){
            $('.remove').click(function(e){
    e.preventDefault();
    var commarket=$(this).attr('id');
    $.get('../index.php').then(function (html){
        $("#"+commarket).removeClass('clicked');
        console.log("hello world");
        $('../index.php').reload();
    })
    
    $.ajax({
        url:'php_handlers/remove.php',
        type:'POST',
        data:{
            remove:commarket
        },success:function(data){
            $("#bettingbody").load('html/betslip.php');
            $("#float").html(data);
        }
    });
});
        });
    </script>
    <script>
$(document).ready(function(){
    $('#placebet').keyup(function(){
        var stake=$("#placebet").val();
        var odds=$('.betslip-total-odds-value').html()
        $('.betslip-total-stake-value').html("KSH "+parseFloat(stake).toFixed(2));
        $('.betslip-potential-payout-value').html("KSH "+(odds*stake).toFixed(2));
    });
});

    </script>
<div class="betslip-container" id="modal">
            <div class="betslip-header-container">
                <div class="betslip-type-container"><span class="betslip-type">MultiBet</span> <span class="betslip-bet-count">(<? echo count(array_filter($games_list));?>)</span> <span class="betslip-odds">@<?$_SESSION['total']?></span> </div></div>
                <div class="betslip-clear" id="close"><span><a href="#" onclick="myname()">Close betslip</a></span></div>
                <div class="betslip-pick-container">
                    <?php
                    if(count(array_filter($games_list))){
                    foreach($games_list as $key=>$marketid){
                    $sql="SELECT * FROM game_odds where fixture_id =?";
                    $markenewtid=substr($marketid,0,-1);
                    $value=substr($marketid,-1);
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$markenewtid]);
                        $row=$stmt->fetch();
                        if($value==1){
                        echo'<div class="betslip-pick">
                        <div class="pick-dismiss"><a href="#" class="remove" id="'.$marketid.'">
                            <i class="fa fa-minus-circle"></i>
                            </a>
                        </div>
                        <div class="pick-details">
                            <span>'.$row->home_team.'</span>
                            <br/>
                            <span>Home Win</span><br/>
                            <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                        </div>
                        <div class="pick-odds">'.$row->home_win.'</div>
                        </div>';
                    $total=$total*$row->home_win;}
                        elseif($value==2){
                            echo'<div class="betslip-pick">
                        <div class="pick-dismiss"><a href="#" class="remove" id="'.$marketid.'" >
                            <i class="fa fa-minus-circle"></i>
                            </a>
                        </div>
                        <div class="pick-details">
                            <span>Draw</span>
                            <br/>
                            <span>Draw</span><br/>
                            <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                        </div>
                        <div class="pick-odds">'.$row->draw.'</div>
                        </div>';
                        $total=$total*$row->draw;}elseif ($value==3) {
                            echo'<div class="betslip-pick">
                        <div class="pick-dismiss">
                        <a href="#" class="remove" id="'.$marketid.'">
                            <i class="fa fa-minus-circle"></i>
                        </a>
                            </div>
                        <div class="pick-details">
                            <span>'.$row->away_team.'</span>
                            <br/>
                            <span>Away Win</span><br/>
                            <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                        </div>
                        <div class="pick-odds">'.$row->away_win.'</div>
                        </div>';
                        $total=$total*$row->away_win;
                    
                }
                    $_SESSION['total']=round($total,2);    
                    }
                    echo'</div>
                    <form action="php_handlers/placebet.php" method="post">
                    <div class="betslip-accumulators">
                    
                        <div class="accumulator-name">Multibet</div>
                        <div class="accumulator-amount"><input id="placebet" name="placebet" required/></div>
                    </div>
                    <div>
                        <button class="betslip-cashout">CASH OUT</button>
                    </div>
                    <div class="betslip-details">
                        <div class="betslip-total-stake"><span>Total Stake</span>
                        <span class="betslip-total-stake-value">KSH 0</span>
                    </div>
                    <div class="betslip-total-odds">
                        <span>Total Odds</span>
                        <span class="betslip-total-odds-value" id="odds">'.$_SESSION['total'].'</span>
                    </div>
                    <div class="betslip-potential-payout">
                        <span>Potential Payout</span>
                        <span class="betslip-potential-payout-value" id="payout">KSH 0</span>
                    </div>
                    </div>
                    <div class="betslip-submit">
                        <button type="submit" class="betslip-submit-button">Place Bet</button>
                    </div>
                    
        </div>
                </form>
        ';
        
                }
                ?>
                