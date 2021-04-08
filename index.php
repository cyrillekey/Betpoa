<?php

session_start();
require("conn/conn.php");
$games = $_SESSION['betslip'];
$games_list = explode(",", $games);
if (empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])) {
    list($selector, $authenticator) = explode(":", $_COOKIE['remember']);
    $sql = "SELECT * from auth_tokes where selector= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$selector]);
    $row = $stmt->fetch();
    if (hash_equals($row->token, hash('sha256', base64_decode($authenticator)))) {
        $_SESSION['usernumber'] = $row->userid;
    }
}
//date_default_timezone_set('Africa/Nairobi');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">

    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <title>Betpoa</title>
    <script src="js/jquery-3.5.1.min.js"></script>
 
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4M2S2XBJ16"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4M2S2XBJ16');
    </script>
    <script>
        function hideandshow() {
            var avatar = document.getElementById('avatar');
            avatar.classList.toggle('hidden')
        }

        function showmobile() {
            var mobile = document.getElementById('mobile');
            mobile.classList.toggle('hidden')
        }
    </script>

<style>
* {
  box-sizing: border-box;
}
.searchre{
    display: none;
    background-color: #222;
    height: 100vh;
}
/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 12px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #222;
  color: white;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 12px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button onclick="showmobile()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-strech sm:justify-start">
                <a href="index.php">
                    <div class="flex-shrink-0 flex items-center ">
                        <p class="block lg:hidden h-8 w-auto text-3xl font-sans font-bold md:text-1xl mr-20">Betpoa
                        <p>
                        <p class="hidden lg:block h-8 w-auto text-3xl font-bold font-sans">Betpoa</p>
                    </div>
                </a>
                <?php
                if (isset($_SESSION['usernumber'])) {
                    echo '<div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="html/mybets.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">My bets</a>
                        <a href="html/deposit.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Deposit</a>
                        <a href="html/withdraw.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Withdraw</a>
                        
                    </div>
                </div>';
                } else {
                    echo '
                    <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="html/mybets.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">My Bets</a>
                        <a href="html/login.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="html/signup.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Signup</a>
                        
                    </div>
                </div>';
                }
                ?>

            </div><?php
                    if (isset($_SESSION['usernumber'])) {
                        echo '
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a class="gg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <span class="sr-only">View notifications</span>
                    KSH 
                    ';
                        $sql = "SELECT account_balance from users_table where user__id= ? ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$_SESSION['usernumber']]);
                        $row = $stmt->fetch();
                        echo ($row->account_balance);
                        echo '
                    
                    </a>
                <div class="ml-3 relative">
                 <div>
                        <button id="avatarimage" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gry-800 focus:ring-white" id="user-menu" aria-haspopup="true" onclick="hideandshow()">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                    </div>
                
                
                    <div class=" hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black rinng-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="avatar" >
                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">My profile</a>
                <a href="html/deposit.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Deposit</a>
                <a href="php_handlers/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                </div>
            </div>
        </div>';
                    } ?>
        </div>
    </div>
    <?php if (isset($_SESSION['usernumber'])) {
        echo '<div id="mobile" class="hidden sm:hidden">
    <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="html/mybets.php" class="bg-gray text-white block px-3 py-2 rounded-md text-base font-medium">My bets</a>
        <a href="html/deposit.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Deposit</div></a>
        <a href="html/withdraw.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Withdraw</div></a>
        
    </div>
</div>';
    } else {
        echo '<div id="mobile" class="hidden sm:hidden">
    <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="html/mybets.php" class="bg-gray text-white block px-3 py-2 rounded-md text-base font-medium">My bets</a>
        <a href="html/deposit.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Deposit</div></a>
        <a href="html/login.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Login</div><a>
        <a href="html/signup.php"><div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Signup</div></a>
    </div>
</div>';
    }  ?>

</nav>
<form class="example">
  <input type="text" placeholder="Search.." id="search" name="search" autocomplete="OFF">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
<div class="searchre">
</div>
<div class="bettingbody">

    <div id="bettingbody"></div>

    <div>
        <div class="teams-info-vert" style="padding-top: 0;">
            <div class="teams-info-vert-left odds-title-left" style="margin-right: 4px;">
                1x2 / Winner

            </div>
            <div class="teams-info-vert-right">
                <div class="teams-info-vert-right odds-title-right">
                    <div class="odds__display">
                        1</div>
                    <div class="odds__display">
                        X</div>
                    <div class="odds__display">
                        2</div>
                    <span class="more-markets" style="background-color: inherit; flex: 1;border: 0;"></span>
                </div>
            </div>
        </div>
    </div>
    <?php


    // use your default timezone to work correctly with unix timestamps
    // and in line with other parts of your application

    $current_time = time();
    //$sql = "SELECT * from game_odds /* where commence_time > ? and gamestatus= ? ORDER BY commence_time ASC*/";
    $sql="SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time` AS `commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win` FROM (`markets_table`  join `odds_table` on(`markets_table`.`fixture_id` = `odds_table`.`fixture_id`)) where markets_table.commence_time>? and markets_table.gamestatus=? order by markets_table.commence_time asc";
    $stmt = $conn->prepare($sql);

$stmt->execute([$current_time,"NS"]);
    while ($row = $stmt->fetch()) {
        $dateold=strtotime("+180 minutes",$row->commence_time);

    $date = gmdate("d D, F,Y,g:i a", $dateold);
        echo '
        <div class="betmarket">
            <div class="teams-info-meta big-screen">
                <div class="teams-info-meta-left">Soccer, Premier League, English </div>
                <div class="teams-info-meta-right">' . $date . '
                </div>
            </div>
            <div class="teams-info-vert big-screen">
                <div class="teams-info-vert-left">
                    <a href="#">
                        <div class="teams-info-vert-top">' . $row->home_team . '
                        </div>
                        <div class="teams-info-vert-top">' . $row->away_team . '
                        </div>
                    </a>
                </div>
                <div class="teams-info-vert-right">
                <div class="odds__container num3" number-of-odds="3">
                    <a href="#" class="match-odd odd1 odd1of3" id="' . $row->fixture_id . '1">
                        <div class="odds__value bold">'
            . $row->home_win . '
                        </div>
                        </a>
                        <a href="#" class="match-odd odd2 odd2of3" id="' . $row->fixture_id . '2">
                            <div class="odds__value bold">
                        ' . $row->draw . '
                        </div>
                        </a>
                        <a href="#" class="match-odd odd3 odd3of3" id="' . $row->fixture_id . '3">
                            <div class="odds__value bold">
                        ' . $row->away_win . '
                        </div>
                        </a>
                        <a class="more-markets " href="html/markets.php?game='.$row->fixture_id.'">+30</a>
                    </div>
                </div>
            </div>
        </div>
                        ';
    }

    ?>
    <button id="float">
        <?php echo count(array_filter(explode(",", $_SESSION['betslip']))); ?>
    </Button>

</div>
<footer>
  <div class="row inner">
    <span class="copyright">
       &copy; <span id="year">     </span>Betpoa
    </span>
    
    <span class="meta">
      <ul class="links">
        <li><a href="index.php/.searchre">Home</a></li>
        <li><a href="html/login.php">Login</a></li>
        <li><a href="html/signup.php">Signup</a></li>
        <li><a href="html/deposit.php">Deposit</a></li>
        <li><a href="https://www.gamblinghelponline.org.au/making-a-change/gambling-responsibly">Gamble Responsiblys</a></li>
      </ul>
      <ul class="icons">
        <li>
        <a href="https://github.com/cyrillekey">
          <span class="fab fa-2x fa-github-square"></span>
          </a>
        </li>
        <li>
        <a href="https://wa.me/+254708073370" target="_blank">
          <span class="fab fa-2x fa-whatsapp"></span></a>
        </li>
        <li>
          <a hreft="https://twitter.com/cyrile_keith"><span class="fab fa-2x fa-twitter"></span></a>
        </li>
        <li>
         <a href="https://www.linkedin.com/in/cyrill-otieno-032602169/" target="_blank" rel="noopener noreferrer"><span class="fab fa-2x fa-linkedin-square"></span></a>
        </li>
      </ul>
    </span>
  </div>
</footer>

<script src="js/search.js"></script>
<script src="js/addtobet.js"></script>
<script>$("#year").html(new Date().getFullYear());</script> 
</body>

</html>