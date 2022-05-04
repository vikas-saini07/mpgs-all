<?php
$apipassword = $_POST['apipassword'];
$merchant = $_POST['merchant'];
$apiUsername = "merchant.$merchant";
$apiversion = $_POST['apiversion'];
$currency = $_POST['currency'];
$sessionid = $_POST['sessionid'];
$amount = $_POST['amount'];
$paytrxid = date("YYmdHis");
$payordid = date("YYmdHiss");
$ordid = $_POST['ordid'];
$trxid = $_POST['trxid'];
$url = $_POST['url'];
$authtrxid = $trxid;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "apiOperation=PAY&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apiPassword&session.id=$sessionid&transaction.id=$paytrxid&order.id=$ordid&order.currency=$currency&sourceOfFunds.type=CARD&&authentication.transactionId=$authtrxid&transaction.source=INTERNET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache")
));

$response = curl_exec($curl);
echo ("<br>");
echo "PAY API Response:";
echo ("<br>");
echo ("<br>");
echo $response;
parse_str($response, $data);
$err = curl_error($curl);
$array = json_encode($data, JSON_FORCE_OBJECT);
$json = json_decode($array, true);
echo $err;
curl_close($curl);

?>
