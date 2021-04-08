<?php
require('../conn/conn.php');

  $money=$_POST['money'];
$number=$_POST['number'];
  /* Urls */
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';


  /* Required Variables */
  $consumerKey = 'LfamnxGlxsM7l2QlNt5tbH8O9kqm6UnL';        # Fill with your app Consumer Key
  $consumerSecret = 'pufm6hsG4cXL73rn';     # Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  
  /* from the test credentials provided on you developers account */
  $InitiatorName = 'apiop37';      # Initiator
  $SecurityCredential = 'UyM4fWNudW1kdg1pJzvQUUJA1WzxnDpvbQ6B732kUgpi42qA+0cDeTm+Qd8j3m984Fa7hdqSRNcOY1Yt1MuOKSLt9biwUCQ28l2UMSRzqaftfTW5ncMiML9Fk+vSfm8H5B+Q2vSEWHRyqXOHBqff1iCKx9rzbIOctDV/COvjzH3dDIC+HY8P+DEJk4JH3ivf9LHJ8d157GOXQWx2Im5cRyGT1Mdo4ySVUKKLv2ToICTA/Azy+xEbgecPWTDk8HB1A38s/nvaHuMtmwH1TIJPghz3JZ2pZkxzSHhHWePH0E481GaU6+T1Cr3poC5cLpXXIAkiyY4G3rM5jp/rA7omiw=='; 
  $CommandID = 'PromotionPayment';          # choose between SalaryPayment, BusinessPayment, PromotionPayment 
  $Amount = '20';
  $PartyA = '603021';             # shortcode 1
  $PartyB = '254708374149';             # Phone number you're sending money to
  $Remarks = 'Salary';      # Remarks ** can not be empty
  $QueueTimeOutURL = 'https://www.betpoa.xyz/betpoa%202.0/callbacks/with.php';    # your QueueTimeOutURL
  $ResultURL = 'https://www.betpoa.xyz/betpoa%202.0/callbacks/with.php';          # your ResultURL
  $Occasion = 'winning';           # Occasion

  /* Obtain Access Token */
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  curl_close($curl);

  /* Main B2C Request to the API */
  $b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2c_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  $resonse=json_decode($curl_response,true);
  
  echo($resonse)['ResponseCode'];
?>