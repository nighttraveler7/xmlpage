<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use nighttraveler7\XMLPage\XMLPage;

$xmlpage = XMLPage($page_name);

$xml_content = $xmlpage->xml_content;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $xml_content->title; ?></title>
	</head>
	<body>
		<div class="content"><?php echo $xml_content->content; ?></div>
	</body>
</html>
