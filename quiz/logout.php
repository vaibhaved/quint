<?php
require 'core.inc.php';
session_destroy();
$_SESSION['te_no']=NULL;
header('Location: ../index.php');
?>