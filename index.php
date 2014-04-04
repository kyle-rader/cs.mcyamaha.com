<?php 
$baseInclude = $_SERVER['DOCUMENT_ROOT'] . '/include';
$page_title = $_SERVER['REQUEST_URI'];

$body = 'app/app.php';

switch($page_title) {
	case '/':
	
		$page_title = 'Icebreaker';
		break;
	default:
		$page_title = 'Not Found';
}

include_once "$baseInclude/header.inc";
include_once "$baseInclude/resource.inc";

print '<body>';
include_once "$body";
print '</body>';
print '</html>';

?>