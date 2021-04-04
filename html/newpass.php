<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style2.css">
    <title>Reset</title>
    <style>

.reset-password-box {
    position: absolute;
    left: calc(50% - 170px);
    top: calc(50% - 220px);
    width: 340px;
    height: auto;
    padding-bottom: 35px;
    background-color: white;
    border: 1px solid silver;
    color: grey;
    font-family: 'Source Sans Pro', sans-serif;
    font-size: 14px;
    z-index: 500;
    transition: height 1s ease;
}

.title-bar {
    height: 40px;
    width: 100%;
    background-color: WhiteSmoke;
    border-bottom: 1px solid silver;
}

.center-title {
    position: absolute;
    margin-top: -1px;
    width: 100%;
    text-align: center;
    font-size: 30px;
    vertical-align: top;
    font-weight: 800;
    color: LightGrey;
}

.title {
    height: 40px;
    width: 100%;
    padding-left: 15px;
    padding-top: 12px;
    font-weight: 700;
    color: grey;
}

.username-label {
    line-height: 200%;
}

.username {
    padding-top: 20px;
    padding-left: 30px;
}

.password-label {
    line-height: 200%;
}

.password {
    padding-top: 10px;
    padding-left: 30px;
}

.new-password-label {
    line-height: 200%;
}

.new-password {
    padding-top: 10px;
    padding-left: 30px;
}

.password-verification {
    padding-top: 10px;
    padding-left: 30px;
}

.password-verification-label {
    line-height: 200%;
}

.opacity-0 {
    opacity: 0;
}

#username-input,
#password-input,
#new-password-input,
#password-verification-input {
    width: 260px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 16px;
    border: 1px solid darkgrey;
    border-radius: 0px;
}

.back-login {
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 20px;
}

.back {
    display: inline-block;
    border: 1px solid LightGrey;
    width: 130px;
    text-align: center;
    background-color: DarkRed;
    color: white;
}

.back:active {
    background-color: LightGrey;
}

.back>a {
    color: inherit;
    text-decoration: none;
    width: inherit;
    min-height: 100%;
    display: block;
    padding-top: 10px;
    padding-bottom: 10px;
}

.reset-password-button {
    float: right;
    display: inline-block;
    border: 1px solid LightGrey;
    width: 130px;
    text-align: center;
    background-color: SteelBlue;
    color: white;
}

.reset-password-button:active {
    background-color: LightGrey;
}

.reset-password-button>a {
    color: inherit;
    text-decoration: none;
    width: inherit;
    min-height: 100%;
    display: block;
    padding-top: 10px;
    padding-bottom: 10px;
}
    </style>
</head>
<body>
<div class="title-bar">
    <div class="center-title">Betpoa</div>

  </div>

<div class="reset-password-box">

  <div class="title-bar">
    <div class="title">PASSWORD RESET</div>

  </div>

  <div class="username">
    <label for="username-input" class="username-label">Username</label>
    <input type="text" id="username-input" autofocus>
  </div>
  <!--
  <div class="password">
    <label for="password-input" class="password-label">Old Password</label>
    <input type="password" id="password-input">
  </div>
  -->

  <div class="new-password">
    <label for="new-password-input" class="new-password-label">New Password</label>
    <input type="password" id="new-password-input">
  </div>

  <div class="password-verification">
    <label for="password-input" class="password--verification-label">Password Verification</label>
    <input type="password" id="password-verification-input">
  </div>


  <div class="back-login">
    <div class="back">
      <a href="https://codepen.io/OurDailyBread/debug/eJmBNL"><i class="fa fa-angle-double-left"></i> Back to Login</a>
    </div>
    <div class="reset-password-button" onclick="airTableResetPassword()">
      <a href="#">Rest Password</a>
    </div>
  </div>

</div>
</body>
</html>