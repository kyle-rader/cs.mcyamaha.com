<?php
include_once "include/top_ajax.inc";
include_once "$baseInclude/db.inc";

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	header("HTTP/1.0 400 Wrong Request Type.");
	exit();
}
else if (!isset($_POST['first']) || !isset($_POST['last']) || !isset($_POST['w_number']) || !isset($_POST['crn']))
{
	header("HTTP/1.0 400 Missing data in post.");
	exit();
}

$debug = '';

$first = strtolower((string)$_POST['first']);
$last  = strtolower((string)$_POST['last']);
$w_num = (int)$_POST['w_number'];
$crn   = (int)$_POST['crn'];
$ip    = (string)$_SERVER['REMOTE_ADDR'];
$code  = isset($_POST['code']) ? $_POST['code'] : '';
$result = false;

$debug .= "first:$first, last:$last, w:$w_num, crn:$crn, ip:$ip, code:$code";
if ((strlen($first) > 0) && (strlen($last) > 0) && ($w_num > 0) && ($crn > 0))
{
	$sql = <<<EOT
INSERT INTO attendance (
 CRN,
 FIRST_NAME, 
 LAST_NAME,
 W_NUMBER,
 IP_ADDRESS,
 CODE)
VALUES (?,?,?,?,?,?);
EOT;
	$debug .= '  made sql  ';
	if($stmt = $mysqli->prepare($sql))
	{
		$debug .= ' prepped  ';
		$stmt->bind_param('isssss', $crn, $first, $last, $w_num, $ip, $code);
		if($stmt->execute())
		{
			$mysqli->commit();
			$result = true;
		}
		$stmt->close();
	}
	$debug .= "  error:" . $mysqli->error;
}

print json_encode(Array('success' => $result, 'first' => $first, 'debug' => $debug));
?>
