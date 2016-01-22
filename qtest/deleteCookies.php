<?php
require_once __DIR__ . '/functions.php';

redirectToQueueIfNoSession();

foreach($_COOKIE as $key => $value) {
	if (strpos($key, "QueueITAccepted-") === 0)
		unset($_COOKIE[$key]);
}

redirectToQueueIfNoSession();