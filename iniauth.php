<?php
var_dump($_POST);

$apipassword = $_POST['apipassword'];
$merchant = $_POST['merchant'];
$apiUsername = "merchant.$merchant";
$apiversion = $_POST['apiversion'];
$amount = $_POST['amount'];
$sessionid = $_POST['sessionid'];
$sessionstatus = $_POST['sessionstatus'];
$sessionversion = $_POST['sessionversion'];
$currency = $_POST['currency'];
$cardscheme = $_POST['cardscheme'];
$phone = $_POST['phone'];
$Email = $_POST['Email'];
$url = $_POST['endpoint'];
$authrwurl = $_POST['authrwurl'];

$cardnumber = $_POST['cardnumber'];
$expiryyear = $_POST['expiryyear'];
$expirymonth = $_POST['expirymonth'];
$cvv = $_POST['cvv'];
$name = $_POST['name'];

$txn_id = $_POST['trxid'];
$order_id = $_POST['ordid'];

$headers = apache_request_headers();
foreach ($headers as $header => $value) {
    if ($header == "Accept"){
        $acceptheaders = $value;
      }
}

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "apiOperation=INITIATE_AUTHENTICATION&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword&session.id=$sessionid&transaction.id=$txn_id&order.id=$order_id&order.currency=$currency&sourceOfFunds.type=CARD&authentication.channel=PAYER_BROWSER",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache")
));

$response = curl_exec($curl);
parse_str($response, $data);
$err = curl_error($curl);
$array = json_encode($data, JSON_FORCE_OBJECT);
$json = json_decode($array, true);
echo $response;
echo "<br>";
echo $err;
echo $json['authentication_version'];
#echo $response;
echo "<br>";
curl_close($curl);


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div id="" xmlns="http://www.w3.org/1999/html">
<form action="authpayer.php" method="post">
<ul class="form-style">
<label>Merchant ID</label><input type="text" name="merchant" readonly value="<?php echo $merchant?>">
<label>Session ID</label><input type="text" name="sessionid" readonly value="<?php echo $sessionid?>">
<input type="hidden" name="sessionstatus" readonly value="<?php echo $sessionstatus?>">
<input type="hidden" name="sessionversion" readonly value="<?php echo $sessionversion?>">
<input type="hidden" name="apipassword" readonly value="<?php echo $apipassword?>">
<input type="hidden" name="apiversion" readonly value="<?php echo $apiversion?>">
<input type="hidden" name="phone" readonly value="<?php echo $phone?>">
<input type="hidden" name="email" readonly value="<?php echo $email?>">
<input type="hidden" name="endpoint" readonly value="<?php echo $url?>">
<input type="hidden" name="cardscheme" readonly value="<?php echo $cardscheme?>">
<input type="hidden" name="name" readonly value="<?php echo $name?>">
<input type="hidden" name="cardnumber" readonly value="<?php echo $cardnumber?>">
<input type="hidden" name="expirymonth" readonly value="<?php echo $expirymonth?>">
<input type="hidden" name="expiryyear" readonly value="<?php echo $expiryyear ?>">
<input type="hidden" name="cvv" readonly value="<?php echo $cvv?>">
<input type="hidden" name="currency" readonly value="<?php echo $currency?>">
<label>Order Amount</label><input type="text" name="amount" readonly value="<?php echo $amount?>">
<label>Transaction Id</label><input type="text" name="trxid" readonly value="<?php echo $txn_id ?>">
<label>Order ID</label><input type="text" name="ordid" readonly value="<?php echo $order_id?>">
<label>3DSecureChallengeWindowSize</label><input type="text" id="chgwinsize" name="chgwinsize" value="FULL_SCREEN">
<label>Accept Headers</label><input type="text" id="acceptHeaders" name="acceptHeaders" readonly value="<?php echo $acceptheaders?>">
<label>Color Depth</label><input type="text" id="colorDepth" name="colorDepth" readonly>
<label>Language</label><input type="text" id="language" name="language" readonly>
<label>Height</label><input type="text" id="height" name="height" readonly>
<label>Width</label><input type="text" id="width" name="width" readonly>
<label>Authentication RedirectResponseUrl</label><input type="text" name="authrwurl" readonly value="<?php echo $authrwurl?>">
<input type="submit" value="Authentication Payer API">
</ul>
</div>


</body>
</html>
<script>
//var test = window.navigator.javaEnabled();
var language = window.navigator.language;
document.getElementById("language").value = language;

var width = window.screen.width;
document.getElementById("width").value = width;

var height = window.screen.height;
document.getElementById("height").value = height;

var colorDepth = window.screen.colorDepth;
document.getElementById("colorDepth").value = colorDepth
</script>
