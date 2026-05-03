<?php
session_start();
session_unset();
session_destroy();

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

header("Location: index.html?loggedout=1");
exit;
?>
