<?php

$apipassword = $_POST['apipassword'];
$merchant = $_POST['merchant'];
$apiUsername = "merchant.$merchant";
$gwurl = "https://" . $_POST['gwurl'] . "/api/nvp/version/100;
$jsurl = "https://" . $_POST['gwurl'] . "/checkout/version/100/checkout.js";
$rwurl = $_POST['rwurl'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$phone = $_POST['phone'];
$Email = $_POST['Email'];
$order_id = date("YmdHis");
$txn_id = "TESTIDD" . date("YYmdHis");
$currency = $_POST['currency'];
$order_ref = date("YYmdHis");
$timeout = "https://testapivikas-e7c9a8fea6e1.herokuapp.com/mpgstest/hostedchkout/timeout.html";
$ct = new DateTime();
$ct->modify("+7 day");
$paylink_exp = $ct->format('Y-m-d\TH:i:s.\1\0\0\0\Z');
//$paylink_exp = gmDate("Y-m-d\TH:i:s.\Z");
//$paylink_exp = $ct->format(DateTime::ISO8601);
$curl = curl_init();
curl_setopt_array($curl, array(
//Enter gateway URL below
  CURLOPT_URL => $gwurl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "apiOperation=INITIATE_CHECKOUT&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword&order.currency=$currency&order.id=$order_id&order.amount=$amount&interaction.operation=PURCHASE&interaction.timeout=600&interaction.timeoutUrl=$timeout&checkoutMode=PAYMENT_LINK&paymentLink.expiryDateTime=$paylink_exp&paymentLink.numberOfAllowedAttempts=5",
//CURLOPT_POSTFIELDS => "apiOperation=INITIATE_CHECKOUT&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword&order.currency=$currency&order.id=$order_id&order.amount=$amount&interaction.operation=PURCHASE&interaction.timeout=600&interaction.timeoutUrl=$timeout&checkoutMode=WEBSITE",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache")
));

$response = curl_exec($curl);
//echo $response;
$dresponse = urldecode($response);
parse_str($dresponse, $output);
$paymentlink = $output['paymentLink_url'];
echo "<a href=" . $paymentlink . ">Payment Link<a/>";
$err = curl_error($curl);
//$order_id = uniqid(rand(), true);
curl_close($curl);
?>
