<?php

$paytrxid = date("YYmdHis");
$payordid = date("YYmdHiss");
echo "Authenticaiton Payer API Response:";
echo ("<br>");
echo ("<br>");
var_dump($_POST);
echo ("<br>");
echo ("<br>");


$ordid = $_POST['order_id'];
$trxid = $_POST['transaction_id'];
$gwrecomm = $_POST['response_gatewayRecommendation'];
$ciphertext = $_POST['encryptedData_ciphertext'];
$nonce = $_POST['encryptedData_nonce'];
$tag = $_POST['encryptedData_tag'];
$result = $_POST['result'];

$authtrxid = $trxid;


<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<form class="form" action="payinternal.php" method="post">
<ul class="form-style">
<li><label>Merchant Name<span class="required">*</span></label><input type="text" name="merchant" value=""></li>
<li><label>API Password<span class="required">*</span></label><input type="text" name="apipassword" value=""/li>
<li><label>Session ID<span class="required">*</span></label><input type="text" name="sessionid" value=""></li>
<li><label>Currency<span class="required">*</span></label><input type="text" name="currency" value=></li>
<li><label>PAY Transaction ID <span class="required">*</span></label><input type="text" name="paytrxid" value="<?php echo $paytrxid?>"></li>
<li><label>Authentication Order ID <span class="required">*</span></label><input type="text" name="ordid" value="<?php echo $ordid?>"></li>
<li><label>Authentication Transaction ID<span class="required">*</span></label><input type="text" name="authtrxid" value="<?php echo $authtrxid?>"></li>
<li><input type="submit" value="Submit Pay API"></li>
</ul>
</form>
</body>
</html>



