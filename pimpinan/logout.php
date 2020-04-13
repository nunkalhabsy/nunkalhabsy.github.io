<?php
require_once('../includes/init.php');
$_SESSION["username"] = null;
$_SESSION["level"] = null;
redirect_to("../index.php");
?>