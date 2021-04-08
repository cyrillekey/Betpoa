<?php
session_start();
if(empty($_SESSION['usernumber'])){
  header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw</title>
    <style>
    *{
        margin: 0;
        padding: 0;
    }
    .withdraw-container {
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10000;
}
.withdraw-confirm-popup {
  width: 300px;
  background-color: rgba(10, 31, 54, 0.8);
  border-radius: 4px;
  padding: 3em 1em;
  box-shadow: 0px 0px 40px 3px rgba(26, 177, 255, 0.56);
  display: flex;
  justify-content: center;
  flex-flow: column wrap;
  text-align: center;
}
.withdraw-confirm-popup__header {
  color: white;
  padding: 20px;
}
.withdraw-confirm-popup__header h1 {
  font-size: 22px;
  margin-bottom: 20px;
}
.withdraw-confirm-popup__header p {
  font-size: 16px;
}
.withdraw-confirm-popup__form {
  padding: 10px 20px;
  display: flex;
  flex-flow: column wrap;
}
.withdraw-confirm-popup__codeinput {
  height: 30px;
  font-size: 16px;
  color: black;
  margin-bottom: 30px;
  border: none;
  box-shadow: 0px 0px 5px 3px rgba(26, 177, 255, 0.5);
}
.withdraw-confirm-popup__codeinput:hover,
.withdraw-confirm-popup__codeinput:focus {
  box-shadow: 0px 0px 5px 3px rgba(26, 177, 255, 0.7);
}
.withdraw-confirm-popup__codeinput-error {
  box-shadow: 0px 0px 3px 4px rgba(255, 26, 26, 0.4);
}
.withdraw-confirm-popup__submit {
  font-weight: bold;
  border: none;
  border-radius: 3px;
  color: white;
  font-size: 16px;
  margin-bottom: 30px;
  background: #4a9d8e;
  -moz-transition: linear 0.1s;
  -o-transition: linear 0.1s;
  -webkit-transition: linear 0.1s;
  transition: linear 0.1s;
  padding: 8px 0px;
}
.withdraw-confirm-popup__submit:hover {
  transform: scale(1.02);
}
.withdraw-confirm-popup__submit:disabled {
  background: rgba(74, 157, 142, 0.3);
  color: rgba(255, 255, 255, 0.3);
  transform: scale(1);
}
.withdraw-confirm-popup__cancel {
  font-weight: bold;
  border: solid #4a9d8e 2px;
  border-radius: 3px;
  color: #4a9d8e;
  font-size: 16px;
  margin-bottom: 20px;
  background: none;
  -moz-transition: linear 0.1s;
  -o-transition: linear 0.1s;
  -webkit-transition: linear 0.1s;
  transition: linear 0.1s;
  padding: 8px 0px;
}
.withdraw-confirm-popup__cancel:hover {
  transform: scale(1.02);
}

    </style>
    <script src="../js/jquery-3.5.1.min.js"></script>
    
</head>
<body>
<section class="withdraw-container">
<article class="withdraw-confirm-popup">
  <div class="withdraw-confirm-popup__header">
    <h1 >
    CONFIRM WITHDRAWAL
  </h1>
  <p class="withdraw-confirm-popup__note">
   Enter amount you wish to withdraw.
  </p>
  </div>  
  <div class="withdraw-confirm-popup__form" method="POST">
  <input type="hidden" id="pnum" name="" value="<?php echo $_SESSION['usernumber']?>">
  <input autocomplete="OFF" id="money" type="number" name="code" class="withdraw-confirm-popup__codeinput withdraw-confirm-popup__codeinput-error" />
<input type="submit" value="Withdraw" class="withdraw-confirm-popup__submit" />
     <input type="submit" value="Cancel" class="withdraw-confirm-popup__cancel" />
  </div>
</article>  
</section>

</body>
<script src="../js/withdraw.js"></script>
</html>