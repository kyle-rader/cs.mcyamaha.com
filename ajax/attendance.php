<?php
include_once "include/top_ajax.inc";
include_once "$baseInclude/db.inc";
$conf = parse_ini_file("../.config/attendance.ini");

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

$message = '';
$first = strtolower((string)$_POST['first']);
$last  = strtolower((string)$_POST['last']);
$w_num = strtolower((string)$_POST['w_number']);
$crn   = (string)$_POST['crn'];
$ip    = (string)$_SERVER['REMOTE_ADDR'];
$code  = isset($_POST['code']) ? $_POST['code'] : '';
$result = false;
$override = $code == md5($conf['code']);

if ((substr($ip, 0, 11) != $conf['lab_ip']) && !$override)
{
	$message = "You must sign in from a WWU CS Lab.";
}
else if ((strlen($first) > 0) && (strlen($last) > 0) && (strlen($w_num) > 0) && (strlen($crn) > 0))
{
	$sql1 = <<<EOT
select COUNT(*) AS count FROM attendance
WHERE
 `DATE` = (SELECT CURDATE())
 AND (`W_NUMBER` = ? OR `IP_ADDRESS` = ? OR (`FIRST_NAME` = ? AND `LAST_NAME` = ?));
EOT;
	if($stmt1 = $mysqli->prepare($sql1))
	{
		$stmt1->bind_param('ssss', $w_num, $ip, $first, $last);
		$stmt1->execute();
		$stmt1->bind_result($count);
		if($stmt1->fetch())
		{
			if(($count == 0) || $override)
			{
				$sql2 = <<<EOT
INSERT INTO attendance (
 CRN,
 FIRST_NAME, 
 LAST_NAME,
 W_NUMBER,
 IP_ADDRESS,
 CODE,
 DATE)
VALUES (?,?,?,?,?,?, (SELECT CURDATE()));
EOT;
				if($stmt2 = $mysqli2->prepare($sql2))
				{
					$stmt2->bind_param('isssss', $crn, $first, $last, $w_num, $ip, $code);
					if($stmt2->execute())
					{
						$mysqli->commit();
						$result = true;
						$message = "Great you're here";
					}
					$stmt2->close();
				}
			}
			else {
				$message = 'You have already signed in today!';
			}
		}
		$stmt1->close();
	}
}

print json_encode(Array('success' => $result, 'first' => ucfirst($first), 'message' => $message));
?>
