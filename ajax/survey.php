<?php
include_once "include/top_ajax.inc";
include_once "$baseInclude/db.inc";
$conf = parse_ini_file("../.config/attendance.ini");

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	header("HTTP/1.0 400 Wrong Request Type.");
	exit();
}
else if (!isset($_POST['class']) ||
		 !isset($_POST['major_in_cs']) ||
		 !isset($_POST['favcolor']) ||
		 !isset($_POST['favanimal']) || 
		 !isset($_POST['favbeverage']) || 
		 !isset($_POST['favplace']) || 
		 !isset($_POST['progexp']) || 
		 !isset($_POST['favtitle']) || 
		 !isset($_POST['idealTA']))
{
	header("HTTP/1.0 400 Missing data in post.");
	exit();
}

$message = '';
$result = false;
$class   = $_POST['class'];
$major   = $_POST['major_in_cs'];
$color   = (string)$_POST['favcolor'];
$drink   = $_POST['favbeverage'];
$animal  = $_POST['favanimal'];
$place   = $_POST['favplace'];
$progexp = $_POST['progexp'];
$title   = $_POST['favtitle'];
$idealTA = $_POST['idealTA'];
$ip    = (string)$_SERVER['REMOTE_ADDR'];
$ip_used = false;

$sql1 = <<<EOT
select COUNT(*) AS count FROM demographics
WHERE
 DATE >= DATE_SUB(NOW(), INTERVAL 2 HOUR)
 AND `IP_ADDRESS` = ?;
EOT;
if($stmt1 = $mysqli->prepare($sql1))
{
	$stmt1->bind_param('s', $ip);
	$stmt1->execute();
	$stmt1->bind_result($count);
	if($stmt1->fetch())
	{
		$ip_used = ($count > 0);
	}
	$stmt1->close();
}

if(!$ip_used)
{
	$sql2 = <<<EOT
INSERT INTO demographics (
 CLASS,
 MAJOR,
 COLOR,
 ANIMAL,
 DRINK,
 PLACE,
 PROGEXP,
 TITLE,
 IDEAL_TA,
 DATE,
 IP_ADDRESS)
VALUES (?,?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP, ?);
EOT;
	if($stmt2 = $mysqli->prepare($sql2))
	{
		$stmt2->bind_param('ssssssssss', $class, $major, $color, $animal, $drink, $place, $progexp, $title, $idealTA, $ip);
		if($stmt2->execute())
		{
			$mysqli->commit();
			$result = false;
			$message = 'Got it!';
		}
		$stmt2->close();
	}
}
else {
	$message = 'This IP submitted a survey within the last 2 hours!';
}

print json_encode(Array('success' => $result, 'message' => $message));
?>
