<?php

require_once __DIR__ . '/../php/_session.php';

if (!isset($_SESSION['reserv'])) {
    header("location: step1.php");
    exit();
}
if (!isset($_SESSION['reserv']['realform'])) {
    header("location: step2.php");
    exit();
}
?>



<?PHP
echo "Hallo ".$_SESSION['reserv']['realform']['name']. ".<br>";

echo "Bedankt voor het reserveren van tafel " 
. $_SESSION['reserv']['realform']["table"] .
        " op datum " . 
        $_SESSION['reserv']['realform']["date"];
unset($_SESSION['reserv']);