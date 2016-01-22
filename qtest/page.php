<?php
require_once __DIR__ . '/functions.php';

redirectToQueueIfNoSession();

echo "We have valid session <a href='setToExpire.php'>Set To Expire</a> <a href='deleteCookies.php'>Delete cookies and revalidate</a>";