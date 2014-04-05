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
	<div id="wrapper">
		<div id="header">
			<?php include_once "$baseInclude/header_topbar.inc"; ?>
		</div>
		<div id="content">
			<?php include_once "$body"; ?>
		</div>
		<div id="footer">
			<?php include_once "$baseInclude/footer.inc"; ?>
		</div>
	</div>
</body>
</html>
