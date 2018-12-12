<?php

if ($_POST) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: /slum/index.php");
	exit();
}
