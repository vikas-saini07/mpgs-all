<?php
$apipassword = $_POST['apipassword'];
$merchant = $_POST['merchant'];
$apiUsername = "merchant.$merchant";
$apiversion = $_POST['apiversion'];
$amount = $_POST['amount'];
$sessionid = $_POST['sessionid'];
$sessionversion = $_POST['sessionversion'];
$sessionaeskey = $_POST['sessionaeskey'];
$sessionstatus = $_POST['sessionstatus'];
$currency = $_POST['currency'];
$description = $_POST['description'];
$phone = $_POST['phone'];
$Email = $_POST['Email'];
$url = $_POST['endpoint'];
$authrwurl = $_POST['authrwurl'];

$cardnumber = $_POST['cardnumber'];
$expiryyear = $_POST['expiryyear'];
$expirymonth = $_POST['expirymonth'];
$cvv = $_POST['cvv'];
$name = $_POST['name'];

$txn_id = date("YYmdHis");
$order_id = date("YmdHis");
$order_ref = date("YYmdHis");

$rwurl = $authrwurl;

$curl = curl_init();
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "apiOperation=UPDATE_SESSION&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword&session.id=$sessionid&transaction.id=$txn_id&order.id=$order_id&order.currency=$currency&order.amount=$amount&sourceOfFunds.provided.card.expiry.month=$expirymonth&sourceOfFunds.provided.card.expiry.year=$expiryyear&sourceOfFunds.provided.card.securityCode=$cvv&sourceOfFunds.provided.card.number=$cardnumber&sourceOfFunds.provided.card.nameOnCard=$name&sourceOfFunds.type=CARD&authentication.channel=PAYER_BROWSER&authentication.redirectResponseUrl=$rwurl",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache")
));

$response = curl_exec($curl);
parse_str($response, $data);
$err = curl_error($curl);
$array = json_encode($data, JSON_FORCE_OBJECT);
$json = json_decode($array, true);
echo $err;
curl_close($curl);

?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="" xmlns="http://www.w3.org/1999/html">
<form action="iniauth.php" method="post">
<ul class="form-style">
<label>Merchant ID</label><input type="text" name="merchant" readonly value="<?php echo $merchant?>">
<label>Session ID</label><input type="text" name="sessionid" readonly value="<?php echo $sessionid?>">
<label>Session update status</label><input type="text" name="sessionstatus" readonly value="<?php echo $json['session_updateStatus']?>">
<label>Session version</label><input type="text" name="sessionversion" readonly value="<?php echo $json['session_version']?>">
<input type="hidden" name="apipassword" readonly value="<?php echo $apipassword?>">
<input type="hidden" name="apiversion" readonly value="<?php echo $apiversion?>">
<input type="hidden" name="phone" readonly value="<?php echo $phone?>">
<input type="hidden" name="email" readonly value="<?php echo $email?>">
<input type="hidden" name="endpoint" readonly value="<?php echo $url?>">
<label>Card scheme</label><input type="text" name="cardscheme" readonly value="<?php echo $json['sourceOfFunds_provided_card_scheme']?>">
<label>Card holder name</label><input type="text" name="name" readonly value="<?php echo $json['sourceOfFunds_provided_card_nameOnCard']?>">
<label>Card number</label><input type="text" name="cardnumber" readonly value="<?php echo $cardnumber?>">
<label>Card expiry month</label><input type="text" name="expirymonth" readonly value="<?php echo $json['sourceOfFunds_provided_card_expiry_month']?>">
<label>Card expiry year</label><input type="text" name="expiryyear" readonly value="<?php echo $json['sourceOfFunds_provided_card_expiry_year']?>">
<label>Card Security Code</label><input type="text" name="cvv" readonly value="<?php echo $cvv?>">
<label>Order Amount</label><input type="text" name="amount" readonly value="<?php echo $json['order_amount']?>">
<label>Order Currency</label><input type="text" name="currency" readonly value="<?php echo $json['order_currency']?>">
<label>Transaction Id</label><input type="text" name="trxid" readonly value="<?php echo $json['transaction_id']?>">
<label>Order ID</label><input type="text" name="ordid" readonly value="<?php echo $json['order_id']?>">
<label>Authentication RedirectResponseUrl</label><input type="text" name="authrwurl" readonly value="<?php echo $authrwurl?>">
<input type="submit" value="Initiate Authentication API">
</ul>
</div>


</body>
</html>
