<?php

require_once '../php/_session.php'; // _required sesion.php
unset($_SESSION['user']);
unset($_SESSION['formpages']);
$url = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$url .= $_SERVER['SERVER_NAME'];
$url .= $_SERVER['REQUEST_URI'];
$url = dirname(dirname($url));
header("Location: $url");
echo "Logged out:".date();
  