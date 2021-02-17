<?php
include('../conn/conn.php');
session_start();
if (!isset($_SESSION['usernumber'])) {
    header("location:../index.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit</title>
    <script src="../js/jquery-3.5.1.min.js"></script>
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .hide {
            display: none;
        }

        html {
            font-size: 10px;
            font-family: "Avenir Next";
        }

        page-overlay {
            position: fixed;
            display: flex;
            background: rgba(0, 0, 0, 0.5);
            height: 100vh;
            width: 100vw;
            overflow: scroll;
        }

        deposit-modal {
            margin: auto;
            display: flex;
            background: #fff;
            width: 40rem;
            min-height: 75rem;
            padding: 3rem;
            flex-direction: column;
        }

        deposit-modal>*+* {
            margin-bottom: 2rem;
        }

        .provider-section>*+* {
            margin-top: 3rem;
        }

        .inline {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            align-content: flex-start;
            flex-flow: row nowrap;
        }

        .inline>*+* {
            margin-left: 2rem;
        }

        h1 {
            text-transform: uppercase;
            font-size: 3rem;
            font-weight: normal;
            margin: 0;
            padding: 0 0 2rem 0;
            border-bottom: 1px solid rgba(0, 30, 51, 0.5);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }

        button {
            background: #001E33;
            border: none;
            color: #fff;
            padding: 2rem 1rem;
            font-size: 2rem;
            text-transform: uppercase;
            font-weight: 300;
            margin-top: auto;
            margin-bottom: 60px;
        }

        .add-new-card {
            display: block;
            color: #001E33;
            font-size: 1rem;
            margin: 1.5rem 0 2rem;
            outline: none;
            text-decoration: none;
            opacity: 0.5;
        }

        .add-new-card:hover {
            opacity: 1;
        }

        .payment-selection {
            list-style: none;
            padding: 0;
            font-size: 1.2rem;
            display: flex;
            justify-content: space-between;
        }

        .payment-selection li {
            border: 1px solid #001E33;
            padding: 1rem;
            margin-bottom: 0.5rem;
            width: 10rem;
            text-align: center;
            opacity: 0.5;
            cursor: pointer;
        }

        .payment-selection li:hover {
            opacity: 1;
        }

        .payment-selection li.selected {
            background: #001E33;
            color: #fff;
            opacity: 1;
            font-weight: 500;
        }

        label {
            font-size: 2rem;
            position: relative;
            display: block;
            width: 100%;
        }

        label span {
            position: absolute;
            top: 0;
            left: 0;
            color: rgba(0, 0, 0, 0.7);
            font-size: 0.7em;
            opacity: 0.8;
            -webkit-user-select: none;
        }

        label input {
            padding: 1.5em 0 0.5em;
            width: 100%;
            -webkit-tap-highlight-color: transparent;
            outline: none;
            border: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0;
            color: rgba(0, 0, 0, 0.7);
            font-size: 1em;
            background: none;
        }

        .divider {
            font-size: 1.5rem;
            letter-spacing: 10px;
            opacity: 0.3;
            text-align: center;
        }

        small {
            display: block;
            color: #001E33;
            font-size: 0.9rem;
            opacity: 0.5;
            margin-bottom: 0;
        }

        
    </style>
</head>

<body>
    <page-overlay>
        <deposit-modal>

            <h1>Deposit</h1>
            <ul class="payment-selection">
                <li  data-payment="card" class="payment-entity selected">Mpesa</li>
                <li  data-payment="paysafe" class="payment-entity">Card</li>
                <li  data-payment="neteller" class="payment-entity">Paypal</li>
            </ul>
            <label>

                <span>Amount</span>
                <input id="amount" type="text" placeholder="20.00" required="">
            </label>
            <section class="provider-section card " id="mpesa">
                <label>
                    <span>Phone Number</span>
                    <input id="pnumber" type="text" disabled value="254<?php echo substr($_SESSION['usernumber'],1);?>" placeholder="+254708073370">
                </label>
            </section>
            <section class="provider-section paysafe hide" id="card">
                <label>
                    <span>Card number</span>
                    <input type="text" placeholder="1111 2222 3333 4444">
                    <a class="add-new-card" href="">+ Manage cards</a>
                </label>
                <div class="inline">
                    <label>
                        <span>Expires</span>
                        <input type="text" placeholder="04/17">
                    </label>
                    <label>
                        <span>CVV</span>
                        <input type="text" placeholder="123">
                    </label>
                </div>
            </section>

            <section class="provider-section neteller hide" id="paypal">
                <label>
                    <span>Secure ID</span>
                    <input type="text" placeholder="123456">
                </label>
                <label>
                    <span>Email</span>
                    <input type="text" placeholder="someone@something.com">
                </label>
            </section>

            <div class="divider">...</div>

            <label>
                <span>Promo code</span>
                <input type="text" placeholder="Enter promo code">
            </label>
            <button id="pay" type="submit">
                Deposit
            </button>

            <small>In accordance with our Responsible Gambling Policy, you can now set Deposit Limits at any time from your account section.</small>
        </deposit-modal>
    </page-overlay>


</body>
<script src="../js/deposit.js"></script>

</html>