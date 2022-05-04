<?php
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

$cardnumber = $_POST['cardnumber'];
$expiryyear = $_POST['expiryyear'];
$expirymonth = $_POST['expirymonth'];
$cvv = $_POST['cvv'];
$name = $_POST['name'];

$txn_id = $_POST['trxid'];
$order_id = $_POST['ordid'];


$chgwinsize = $_POST['chgwinsize'];
$acceptHeaders = $_POST['acceptHeaders'];
$colorDepth = $_POST['colorDepth'];
$language = $_POST['language'];
$height = $_POST['height'];
$width = $_POST['width'];
$authrwurl = $_POST['authrwurl'];

$chk = "ERROR";
$json[] = "";
$json['result'] = "ERROR";


while ($json['result'] == "ERROR"){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "apiOperation=AUTHENTICATE_PAYER&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword&session.id=$sessionid&transaction.id=$txn_id&order.id=$order_id&order.currency=$currency&authentication.redirectResponseUrl=$authrwurl&device.browser=PAYER_BROWSER&device.browserDetails.3DSecureChallengeWindowSize=$chgwinsize&device.browserDetails.acceptHeaders=$acceptHeaders&device.browserDetails.colorDepth=$colorDepth&device.browserDetails.javaEnabled=true&device.browserDetails.javaScriptEnabled=false&device.browserDetails.language=$language&device.browserDetails.screenHeight=$height&device.browserDetails.screenWidth=$width&device.browserDetails.timeZone=-600",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache")
));

$response = curl_exec($curl);
echo $response;
parse_str($response, $data);
$err = curl_error($curl);
$array = json_encode($data, JSON_FORCE_OBJECT);
$json = json_decode($array, true);
//echo "Error Cause: " . $json['error_cause'];
/*
echo ("<br>");
echo "Error Cause: " . $json['error_cause'];
echo ("<br>");
echo "Error Explanation: " . $json['error_explanation'];
echo ("<br>");
echo "Result: " . $json['result'];
echo ("<br>");
*/
if ($json['result'] != "ERROR"  ){
        $htmldata = $json['authentication_redirectHtml'];
//      echo "<div> id=loaderfin></div>";
}}#while loop end here

echo $err;
curl_close($curl);




?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script>

</script>
</head>
<body>
<div id="acs" xmlns="http://www.w3.org/1999/html">
<?php echo $htmldata; ?>
</div>

</body>
