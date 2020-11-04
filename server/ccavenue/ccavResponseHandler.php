<?php
use Utility\Fallacy;

require_once('Crypto.php');
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/config/ccavenue.php');
require_once(__ROOT__ . '/utility/utilities.php');
\Utility\SessionUtil\startReadOnlySession();
?>
<?php

error_reporting(0);

$workingKey = WORKING_KEY;		//Working Key should be provided here.
$encResponse = $_POST["encResp"];			//This is the response sent by the CCAvenue Server
$rcvdString = decrypt($encResponse, $workingKey);		//Crypto Decryption used as per the specified working key.
$order_status = "";
$decryptValues = explode('&', $rcvdString);
$dataSize = sizeof($decryptValues);

$row = [];
for ($i = 0; $i < $dataSize; $i++) {
	$information = explode('=', $decryptValues[$i]);
	if ($i == 3)	$order_status = $information[1];
	$row[$information[0]] = $information[1];
}

// \Utility\SessionUtil\addIdentifierToSession(USER_LOGIN,$row['merchant_param1']);
$userId = \Utility\SessionUtil\getUserSessionIdentifier();
// echo $userId.'<br>';
if($userId === null)
{
	echo "Not logged in";
}
echo "<center>";

$PaymentsModel = \Models\Payments::getInstance();
$temp_res = $PaymentsModel->insertRow($row);
if($temp_res instanceof Fallacy)
{
	print_r($temp_res);
	echo '<br>';
}
if ($temp_res !== true) {
	echo "Writing to payments table failed<br>";
}
else {
	echo "Writing to payments table succeeded<br>";
}

$toUpdate = [];

if ($order_status === "Success") {
	$toUpdate[ORDER_STATUS] = ORDER_STATUS_FLAGS['PLACED'];
	echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.<br>";
} else if ($order_status === "Aborted") {
	$toUpdate[ORDER_STATUS] = ORDER_STATUS_FLAGS['ABORTED'];
	echo "<br>Payment was aborted<br>";
} else if ($order_status === "Failure") {
	$toUpdate[ORDER_STATUS] = ORDER_STATUS_FLAGS['FAILED'];
	echo "<br>Thank you for shopping with us.However,the transaction has been declined.<br>";
} else {
	$toUpdate[ORDER_STATUS] = ORDER_STATUS_FLAGS['FAILED'];
	echo "<br>Security Error. Illegal access detected<br>";
}

$ordersModel = \Models\Orders::getInstance();
$condition = [];
$condition[ORDER_ID] = $row[ORDER_ID];
$condition[ORDER_ID] = 11;
$condition['user_id'] = $userId;
$condition = $ordersModel->conditionCreaterHelper($condition);
$temp_res = $ordersModel->update($toUpdate,$condition);

if($temp_res instanceof Fallacy)
{
	echo "Updating order status failed<br>";
	print_r($temp_res);
	echo '<br>';
}
else {
	echo "Order status updated successfully<br>";
}
echo "<br><br>";

echo "<table cellspacing=4 cellpadding=4>";
for ($i = 0; $i < $dataSize; $i++) {
	$information = explode('=', $decryptValues[$i]);
	echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
}



echo "</table><br>";
echo "</center>";
?>
