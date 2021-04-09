
<?php
session_start();
$games=$_SESSION['betslip'];
$games_list=explode(",",$games);
include('../conn/conn.php');
$total=1;
//To do
 //haltime result
 // win to nill
 //haltime fulltime
 //correct score
 //retrive from api

?>
<script>
        $(document).ready(function(){
            $('.remove').click(function(e){
    e.preventDefault();
    var commarket=$(this).attr('id');
    $.get('../index.php').then(function (html){
        
        if (sessionStorage.getItem("names") === null) {
                var ids = []
            } else {
                var ids = JSON.parse(sessionStorage.getItem("names"))
            }
            const index=ids.indexOf(commarket)
            if(index>-1){
                ids.splice(index,1);
            }
            sessionStorage.setItem("names", JSON.stringify(ids))
            //location.href="../index.php";
            //location.reload();
            $("#"+commarket).removeClass('clicked');
    })
    
    $.ajax({
        url:'php_handlers/remove.php',
        type:'POST',
        data:{
            remove:commarket
        },success:function(data){
            console.log(data);
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
                        $sql="SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time` AS 
                        `commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`odds_table`.`onex` AS `oneX`,`odds_table`.`one2` 
                        AS `one2` ,`odds_table`.`X2` as `X2`,`odds_table`.`gg`,`odds_table`.`ngg`,`odds_table`.`dnb1`,`odds_table`.`dnb2`,
                        `odds_table`.`ov25`,`odds_table`.`ov35`,`odds_table`.`ov15`,`odds_table`.`ov05`,`odds_table`.`un05`,`odds_table`.`un15`,`odds_table`.`un25`,`odds_table`.`un35` FROM (`markets_table`  join `odds_table` on(`markets_table`.`fixture_id` 
                        = `odds_table`.`fixture_id`)) where markets_table.fixture_id=? ";
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
                    
                }elseif($value==4){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Double Chance</span>
                        <br/>
                        <span>1/X</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->oneX.'</div>
                    </div>';
                    $total=$total*$row->oneX;
                }elseif($value==5){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Double Chance</span>
                        <br/>
                        <span>1/2</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->one2.'</div>
                    </div>';
                    $total=$total*$row->one2;
                }elseif($value==6){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Double Chance</span>
                        <br/>
                        <span>X/2</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->X2.'</div>
                    </div>';
                    $total=$total*$row->X2;
                }elseif($value==7){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 0.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->un05.'</div>
                    </div>';
                    $total=$total*$row->un05;
                }
                elseif($value==8){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 0.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->ov05.'</div>
                    </div>';
                    $total=$total*$row->ov05;
                }
                elseif($value==9){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 1.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->ov15.'</div>
                    </div>';
                    $total=$total*$row->ov15;
                }
                elseif($value==0){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 1.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->un15.'</div>
                    </div>';
                    $total=$total*$row->un15;
                }
                elseif($value=="a"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 2.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->un15.'</div>
                    </div>';
                    $total=$total*$row->ov25;
                }
                elseif($value=="b"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 2.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->un25.'</div>
                    </div>';
                    $total=$total*$row->un25;
                }

                elseif($value=="c"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Over 3.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->ov35.'</div>
                    </div>';
                    $total=$total*$row->ov35;
                }
                elseif($value=="d"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Under/Over</span>
                        <br/>
                        <span>Under 3.5</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->un35.'</div>
                    </div>';
                    $total=$total*$row->un35;
                }
                elseif($value=="e"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Draw no Bet</span>
                        <br/>
                        <span>Home</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->dnb1.'</div>
                    </div>';
                    $total=$total*$row->dnb1;
                }
                elseif($value=="e"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Draw no Bet</span>
                        <br/>
                        <span>Away</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->dnb2.'</div>
                    </div>';
                    $total=$total*$row->dnb2;
                }elseif($value=="j"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Both Teams To Score</span>
                        <br/>
                        <span>Yes</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->gg.'</div>
                    </div>';
                    $total=$total*$row->gg;
                }elseif($value=="e"){
                    echo'<div class="betslip-pick">
                    <div class="pick-dismiss">
                    <a href="#" class="remove" id="'.$marketid.'">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                        </div>
                    <div class="pick-details">
                        <span>Both Teams To Score</span>
                        <br/>
                        <span>No</span><br/>
                        <span>'.$row->home_team.' vs '.$row->away_team.'</span>
                    </div>
                    <div class="pick-odds">'.$row->ngg.'</div>
                    </div>';
                    $total=$total*$row->ngg;
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
                