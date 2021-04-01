<?php
require('../conn/conn.php');
$_fixture=$_GET['game'];
$sql="SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time` AS 
`commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`odds_table`.`onex` AS `oneX`,`odds_table`.`one2` 
AS `one2` ,`odds_table`.`X2` as `X2`,`odds_table`.`gg`,`odds_table`.`ngg`,`odds_table`.`dnb1`,`odds_table`.`dnb2`,
`odds_table`.`ov25`,`odds_table`.`ov35`,`odds_table`.`ov15`,`odds_table`.`ov05`,`odds_table`.`un05`,`odds_table`.`un15`,`odds_table`.`un25`,`odds_table`.`un35` FROM (`markets_table`  join `odds_table` on(`markets_table`.`fixture_id` 
= `odds_table`.`fixture_id`)) where markets_table.fixture_id=? order by markets_table.commence_time asc";
$stmt=$conn->prepare($sql);
$stmt->execute([$_fixture]);
$row=$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/more.css">
    <title>More</title>
    <script src="../js/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="back-icon">
        <p>Back</p>
    </div>
    <div class="teams-info">

        <div class="teams-info-title">
            <div class="teams-info-left">
                <div class="teams-info-left__home-team uppercase">
                    <?php echo $row->home_team ?> </div>

            </div>
            <div class="teams-info-mid teams-info-title-vs">
                <div class="teams-info-mid__vs">
                    vs
                </div>
                <div class="teams-info-id">
                    <?php echo(gmdate("d/m/Y",$row->commence_time))?></div>
            </div>
            <div class="teams-info-right">
                <div class="teams-info-right__away-team uppercase">
                    <?php echo $row->away_team?> </div>

            </div>
        </div>
    </div>
    <div class="sidebet-header">1X2</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>1" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->home_win ?> </div>
            </div>
        </a>
        <div id="<?php echo $_fixture?>2" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
            <div class="outcome-title doublechance "><span>Draw</span></div>

            <div class="outcome-pricedecimal "><?php echo($row->draw) ?></div>
        </div>
        <div id="<?php echo $_fixture?>3" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
            <div class="outcome-title doublechance "><span>Away</span></div>

            <div class="outcome-pricedecimal"><?php echo $row->away_win ?></div>
        </div>
    </div>

    <!--double chance section-->
    <div class="sidebet-header">Double chance</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>1X</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->oneX ?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>12</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->one2?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>X2</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->X2 ?></div>
            </div>
        </a>
    </div>
    <!--Win to Nill Home-->
    <div class="sidebet-header">Win to Nill Home</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>YES</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>No</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
    </div>
    <!--Win to Nill away-->
    <div class="sidebet-header">Win to Nill away</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>YES</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>No</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
    </div>
    <!--Over and under section-->
    <div class="sidebet-header">Over/under</div>
    <div class="betdet" style="height: 18vh;">
        <a href="#" class="hello" >
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch"
            >
                <div class="outcome-title doublechance "><span>UN 0.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->un05?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 0.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->ov05?> </div>
            </div>
        </a>

        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 1.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->ov15?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>UN 1.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->un15?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 2.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->ov25?> </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>UN 2.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->un25?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>OV 3.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->ov35?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo $_fixture?>" style="flex-wrap: wrap" class="btn btn-group btn-bettingmatch  ">
                <div class="outcome-title doublechance "><span>UN 3.5</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->un35?></div>
            </div>
        </a>
    </div>

    <!--Drwa no bet-->
    <div class="sidebet-header">Draw no bet</div>
    <div style="height: 8vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->dnb1?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Away</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->dnb2?></div>
            </div>
        </a>
    </div>
    <!--Haltime result-->
    <div class="sidebet-header ">Halftime Result</div>
    <div style="height: 6vh;" class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Home</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Draw</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>Away</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
    </div>
    <!--Both team to score-->
    <div class="sidebet-header ">Both team to score</div>
    <div style="height: 8vh; " class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>YES</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->gg?></div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>No</span></div>

                <div class="outcome-pricedecimal"><?php echo $row->ngg?></div>
            </div>
        </a>
    </div>
    <!--Halftime Fulltime-->
    <div class="sidebet-header ">Halftime/Fulltime</div>
    <div class="betdet" style="height: 20vh;">
        <a href="#" class="hello" class="betdet">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1/1</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1/X</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1/2</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2/1</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2/X</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2/2</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>X/1</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>X/X</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>X/2</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
    </div>
    <!--Score-->
    <div class="sidebet-header">Exact Score</div>
    <div style="height: 50vh; " class="betdet">
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:0</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:0</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:1</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:0</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:1</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:2</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:3</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:0</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:1</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:2</span></div>

                <div class="outcome-pricedecimal">3.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:3</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>4:4</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:0</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:1</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:2</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:3</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:1</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:2</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>0:3</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:2</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>1:3</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:3</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>2:4</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>
        <a href="#" class="hello">
            <div id="<?php echo ($_fixture)?>" style="flex-wrap: wrap " class="btn btn-group btn-bettingmatch ">
                <div class="outcome-title doublechance "><span>3:4</span></div>

                <div class="outcome-pricedecimal">100.01 </div>
            </div>
        </a>

    </div>
    <script>
        $('.btn-bettingmatch').on("click", function(e) {
            e.preventDefault();
            if($(this).hasClass('clicked')){
                $(this).removeClass('clicked');
            }
            else{
            $(this).addClass('clicked');
            }
           var name=$(this).attr("id");
           alert(name)
            
        });
    </script>
</body>

</html>