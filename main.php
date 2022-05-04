<?php

$apipassword = $_POST['apipassword'];
$merchant = $_POST['merchant'];
$apiUsername = "merchant.$merchant";
$apiversion = $_POST['apiversion'];
$endpoint = $_POST['endpoint'];
$authrwurl = $_POST['authrwurl'];
$url = "https://" . $endpoint . "/api/nvp/version/" . $apiversion;
$curl = curl_init();
curl_setopt_array($curl, array(
//Enter gateway URL below
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "apiOperation=CREATE_SESSION&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword",
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
<form action="updatesession.php" method="post">
<ul class="form-style">
<label>Card Number<span class="required">*</span></label><input type="text" name="cardnumber" value="5123450000000008">
<label>Expiry Month<span class="required">*</span></label><input type="number" name="expirymonth" value="05">
<label>Expiry Year<span class="required">*</span></label><input type="number" name="expiryyear" value="31">
<label>CVV<span class="required">*</span></label><input type="text" name="cvv" value="100">
<label>Currency<span class="required">*</span></label><input type="text" step=any name="currency" value="AUD">
<label>Amount<span class="required">*</span></label><input type="number" step=any name="amount" value=1>
<label>Name <span class="required">*</span></label><input type="text" name="name" value="Vikas">
<label>Phone<span class="required">*</span></label><input type="number" name="phone" value="1212121212">
<label>Email<span class="required">*</span></label><input type="email" name="Email" value="test@test.com">
<label>Merchant</label><input type="text" name="merchant" readonly value="<?php echo $merchant?>">
<input type="hidden" name="apipassword" readonly value="<?php echo $apipassword?>">
<input type="hidden" name="apiversion" readonly value="<?php echo $apiversion?>">
<label>End Point</label><input type="text" name="endpoint" readonly value="<?php echo $url?>">
<label>Session ID</label><input type="text" name="sessionid" readonly value="<?php echo $json['session_id']?>">
<label>Session Version</label><input type="text" name="sessionversion" readonly value="<?php echo $json['session_version']?>">
<label>Session AES 256 Key</label><input type="text" name="sessionaeskey" readonly value="<?php echo $json['session_aes256Key']?>">
<label>Session Update Status</label><input type="text" name="sessionstatus" readonly value="<?php echo $json['session_updateStatus']?>">
<label>Authentication RedirectResponseUrl</label><input type="text" name="authrwurl" readonly value="<?php echo $authrwurl?>">
<input type="submit" value="Update Session API">
</ul>

</div>
</body>
</html>
