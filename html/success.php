<?php
$error=$_GET['message'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300|Montserrat' rel='stylesheet' type='text/css'>
  <title>Success</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4M2S2XBJ16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4M2S2XBJ16');
</script>
  <style>
    html,
    body {
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    body {
      overflow: hidden;
    }

    .background {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.5)), url("https://images.unsplash.com/photo-1504279807002-09854ccc9b6c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80");
      background-size: cover;
      background-position: center;
    }

    .modalbox.success,
    .modalbox.error {
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      -webkit-border-radius: 2px;
      -moz-border-radius: 2px;
      border-radius: 2px;
      background: #fff;
      padding: 25px 25px 15px;
      text-align: center;
    }

    .modalbox.success.animate .icon,
    .modalbox.error.animate .icon {
      -webkit-animation: fall-in 0.75s;
      -moz-animation: fall-in 0.75s;
      -o-animation: fall-in 0.75s;
      animation: fall-in 0.75s;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .modalbox.success h1,
    .modalbox.error h1 {
      font-family: 'Montserrat', sans-serif;
    }

    .modalbox.success p,
    .modalbox.error p {
      font-family: 'Open Sans', sans-serif;
    }

    .modalbox.success button,
    .modalbox.error button,
    .modalbox.success button:active,
    .modalbox.error button:active,
    .modalbox.success button:focus,
    .modalbox.error button:focus {
      -webkit-transition: all 0.1s ease-in-out;
      transition: all 0.1s ease-in-out;
      -webkit-border-radius: 30px;
      -moz-border-radius: 30px;
      border-radius: 30px;
      margin-top: 15px;
      width: 80%;
      background: transparent;
      color: #4caf50;
      border-color: #4caf50;
      outline: none;
    }

    .modalbox.success button:hover,
    .modalbox.error button:hover,
    .modalbox.success button:active:hover,
    .modalbox.error button:active:hover,
    .modalbox.success button:focus:hover,
    .modalbox.error button:focus:hover {
      color: #fff;
      background: #4caf50;
      border-color: transparent;
    }

    .modalbox.success .icon,
    .modalbox.error .icon {
      position: relative;
      margin: 0 auto;
      margin-top: -75px;
      background: #4caf50;
      height: 100px;
      width: 100px;
      border-radius: 50%;
    }

    .modalbox.success .icon span,
    .modalbox.error .icon span {
      postion: absolute;
      font-size: 4em;
      color: #fff;
      text-align: center;
      padding-top: 20px;
    }

    .modalbox.error button,
    .modalbox.error button:active,
    .modalbox.error button:focus {
      color: #f44336;
      border-color: #f44336;
    }

    .modalbox.error button:hover,
    .modalbox.error button:active:hover,
    .modalbox.error button:focus:hover {
      color: #fff;
      background: #f44336;
    }

    .modalbox.error .icon {
      background: #f44336;
    }

    .modalbox.error .icon span {
      padding-top: 25px;
    }

    .center {
      float: none;
      margin-left: auto;
      margin-right: auto;
      /* stupid browser compat. smh */
    }

    .center .change {
      clearn: both;
      display: block;
      font-size: 10px;
      color: #ccc;
      margin-top: 10px;
    }

    @-webkit-keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @-moz-keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @-o-keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @-webkit-keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 25%;
      }
    }

    @-moz-keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 25%;
      }
    }

    @-o-keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 25%;
      }
    }

    @-moz-keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @-webkit-keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @-o-keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @keyframes fall-in {
      0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
      }

      50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
      }

      60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
      }

      100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
      }
    }

    @-moz-keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 15%;
      }
    }

    @-webkit-keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 15%;
      }
    }

    @-o-keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 15%;
      }
    }

    @keyframes plunge {
      0% {
        margin-top: -100%;
      }

      100% {
        margin-top: 15%;
      }
    }
  </style>
</head>

<body>
  <div class="background"></div>
  <div class="container">
  <?php
if($error=="success"){
  echo'
    <div class="row">

      <div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
        <div class="icon">
          <span class="glyphicon glyphicon-ok"></span>
        </div>

        <h1>Success!</h1>
        <p>Bet has been placed successfully
          <br>Good luck!</p>
        <a href="../index.php"><button type="button" class="redo btn">Ok</button></a>
        <span class="change">-- Click to advance to home --</span>
      </div>

    </div>';}else if($error=='balance'){
      echo'
    <div class="row">
      <div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate">
        <div class="icon">
          <span class="glyphicon glyphicon-thumbs-down"></span>
        </div>
        <h1>Oh no!</h1>
        <p>Oops! Low account balance,
          <br> you should try again.</p>
        <a href="../index.php#bettingbody"><button type="button" class="redo btn">Try again</button></a>
        <span class="change">-- Click to advance to home. --</span>
      </div>
    </div>';
    }
    else if($error=="err"){
      echo'
      <div class="row">
        <div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate">
          <div class="icon">
            <span class="glyphicon glyphicon-thumbs-down"></span>
          </div>
          <h1>Oh no!</h1>
          <p>Oops!Something went wrong,
            <br> you should try again.</p>
          <a href="../index.php"><button type="button" class="redo btn">Try again</button></a>
          <span class="change">-- Click to advance to home. --</span>
        </div>
      </div>';
    }else if($error=="zero"){
      echo'
      <div class="row">
        <div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate">
          <div class="icon">
            <span class="glyphicon glyphicon-thumbs-down"></span>
          </div>
          <h1>Oh no!</h1>
          <p>Sorry!You can\'t bet with less than KES 1:00,
            <br> you should deposit and try again.</p>
          <a href="../index.php"><button type="button" class="redo btn">Try again</button></a>
          <span class="change">-- Click to advance to home. --</span>
        </div>
      </div>';
    }
        ?>
  </div>
  <!--/.container-->
</body>

</html>