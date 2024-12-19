<?php

$apipassword = $_POST['apipassword'];
$merchant = $_POST['merchant'];
$apiUsername = "merchant.$merchant";
$apiversion = $_POST['$apiversion'];
$gwurl = "https://" . $_POST['gwurl'] . "/api/nvp/version/" .  $apiversion;
$jsurl = "https://" . $_POST['gwurl'] . "/static/checkout/checkout.min.js";
$rwurl = $_POST['rwurl'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$phone = $_POST['phone'];
$Email = $_POST['Email'];
$order_id = date("YmdHis");
$txn_id = "TESTIDD" . date("YYmdHis");
$currency = $_POST['currency'];
$order_ref = date("YYmdHis");
$timeout = "https://testapivikas-e7c9a8fea6e1.herokuapp.com/hostedchkout/oldhosted/timeout.html";
$complete = "https://testapivikas-e7c9a8fea6e1.herokuapp.com/hostedchkout/oldhosted/complete.html";
$errorpage = "https://testapivikas-e7c9a8fea6e1.herokuapp.com/hostedchkout/oldhosted/error.html";
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
CURLOPT_POSTFIELDS => "apiOperation=INITIATE_CHECKOUT&merchant=$merchant&apiUsername=$apiUsername&apiPassword=$apipassword&order.currency=$currency&order.id=$order_id&order.amount=$amount&interaction.operation=PURCHASE&interaction.timeout=600&interaction.timeoutUrl=$timeout&checkoutMode=WEBSITE&interaction.merchant.name=$merchant&order.description=$description&interaction.merchant.url=$rwurl&interaction.style.accentColor=#19abcf&interaction.style.theme=default",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache")
));

$response = curl_exec($curl);
//echo $response;
$dresponse = urldecode($response);
parse_str($dresponse, $output);
$session_id = $output['session_id'];
echo $session_id;
$err = curl_error($curl);
//$order_id = uniqid(rand(), true);
curl_close($curl);
?>

<html>
    <head>
        <script src="<?php echo $jsurl ?>"
                data-error="errorCallback"
                data-complete="<?php echo $rwurl ?>"
                data-afterredirect="afterredirect"
                data-beforeRedirect="beforeredirect"
                data-cancel="cancelCallback">
        </script>

        <script type="text/javascript">
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }
            function beforeredirect() {
                  console.log("before redirect");
                  return {
                          beforeredirect: "This is a before redirect test message",
                          orderid: "<?php echo $order_id ?>"
                  };
             }
            function afterredirect(data) {
                    console.log("This is after redirect test message");
                    console.log(data);
             }
            Checkout.configure({
                session: {
                    id:  '<?php echo $session_id?>'
                 },
            });
        </script>
    </head>
    <body>
        ...
        <div id="embed-target"> </div>
        <input type="button" value="Pay with Embedded Page" onclick="Checkout.showEmbeddedPage('#embed-target');" />
        <input type="button" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
        ...
    </body>
</html>
