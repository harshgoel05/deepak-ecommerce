<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php 
require_once('Crypto.php');
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/ccavenue.php');
\Utility\SessionUtil\startReadOnlySession();
?>
<?php 

	error_reporting(0);
	
	$merchant_data='';
	$working_key=WORKING_KEY;//Shared by CCAVENUES
	$access_code=ACCESS_CODE;//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
<?php exit(); ?>
</html>

