<?php
    session_start();
    include('../conn/conn.php');
    if(empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])){
      list($selector,$authenticator)=explode(":",$_COOKIE['remember']);
      $sql="SELECT * from auth_tokes where selector= ?";
      $stmt=$conn->prepare($sql);
      $stmt->execute([$selector]);
      $row=$stmt->fetch();
      if(hash_equals($row->token,hash('sha256',base64_decode($authenticator)))){
          $_SESSION['usernumber']=$row->userid;
      }
  
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mybets</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
    function hideandshow(){
    var avatar=document.getElementById('avatar');
        avatar.classList.toggle('hidden')}
    function showmobile(){
        var mobile=document.getElementById('mobile');
        mobile.classList.toggle('hidden')
    }    
</script>
    <style>
    body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
    </style>
</head>
<body>
<?php
if(isset($_SESSION['usernumber'])){
  echo'
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button onclick="showmobile()"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
              
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
              
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-strech sm:justify-start">
                <a href="../index.php"><div class="flex-shrink-0 flex ">
                    <p class="block lg:hidden h-8 w-auto text-3xl font-sans font-bold md:text-1xl "
                        src="freeLogo.jpeg">Betpoa<p>
                    <p class="hidden lg:block h-8 w-auto text-3xl font-sans font-bold"
                    >Betpoa</p>
                </div></a>';'
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        
                        <a href="../index.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Deposit</a>
                        
                    </div>
                </div>
            </div>{
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a class="gg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <span class="sr-only">View notifications</span>
                    
                    ';
                    $sql="SELECT account_balance from users_table where user__id= ? ";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$_SESSION['usernumber']]);
                    $row=$stmt->fetch();
                    echo("KSH ".$row->account_balance);
                    
                    echo'
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
                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Deposit</a>
                <a href="../php_handlers/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mobile" class="hidden sm:hidden">
    <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="../index.php" class="bg-gray text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
        <div class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Deposit</div>
        
    </div>
</div>
</nav>
<table>
  <caption>My bets</caption>
  <thead>
    <tr>
      <th scope="col">Be1 id</th>
      <th scope="col">Status</th>
      <th scope="col">Possible win</th>
      <th scope="col">Date Placed</th>
    </tr>
  </thead>
  <tbody>
  ';
  $sql="SELECT * from bets_table where user__id=? order by time_placed desc";
  $stmt=$conn->prepare($sql);
  $stmt->execute([$_SESSION['usernumber']]);
  while($row=$stmt->fetch()){
    echo'
    
    <tr>
    
      <td data-label="Bet id"><a href="betresult.php?bet='.$row->bet_id.'">'.$row->bet_id.'</a></td>
      <td data-label="Status">'.$row->bet_status.'</td>
      <td data-label="Possible Win">ksh'.$row->possiblewin.'</td>
      <td data-label="Date Placed">'.gmdate('D, d M Y G:h:i',$row->time_placed).'</td>
      
      </tr>
      
    ';
  }
  
    
    echo'
  </tbody>
</table>
</body>
</html>';}else{
  header("location:../html/login.php");
}