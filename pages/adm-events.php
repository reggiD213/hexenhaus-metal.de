<?php

if (isset($eventId)) {
	require_once 'adm-events-single.php';
} else {
	require_once 'adm-events-list.php';
}
?>