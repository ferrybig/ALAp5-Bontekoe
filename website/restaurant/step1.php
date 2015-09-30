<?php

require_once __DIR__ . '/../php/_session.php';


$_SESSION['reserv'] = [];
$_SESSION['reserv']['time'] = time();
$_SESSION['reserv']['retrycount'] = 5;
$_SESSION['reserv']['token'] = bin2hex(openssl_random_pseudo_bytes(16));
header("location: step2.php");


