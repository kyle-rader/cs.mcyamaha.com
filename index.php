<?php 
$page_title = $_SERVER['REQUEST_URI'];
$body = 'app/app.php';
switch($page_title) {
	case '/':
		$page_title = 'Icebreaker';
		break;
	default:
		$page_title = 'Not Found';
}

include_once "include/header.inc";
include_once "include/db.inc";

print '<body>';
include_once "$body";
print '</body>';
print '</html>';

?>