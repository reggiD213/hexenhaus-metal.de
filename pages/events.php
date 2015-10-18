<?php

if ($url -> getPagenum() != null) {
	$pagenum = $url -> getPagenum();
} else {
	$pagenum = 1;
	$eventId = $url -> getId();
}

if (isset($eventId)) {
	require_once 'events-single.php';
} else {
	require_once 'events-list.php';
}
?>