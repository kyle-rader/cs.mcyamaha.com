<?php 
$baseInclude = $_SERVER['DOCUMENT_ROOT'] . '/include';
$page_title = $_SERVER['REQUEST_URI'];

$body = '';

switch($page_title) {
	default:
		$page_title = 'CS Mcyamaha.com';
		$body = 'app/app.php';
}
?>

<!DOCTYPE html>
<html>
<?php include_once "$baseInclude/header.inc"; ?>
<body>
<?php include_once "$body"; ?>
</body>
</html>
