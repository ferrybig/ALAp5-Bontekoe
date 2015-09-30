<?php

require_once __DIR__ . "/_config.php";

$db = $_CONFIG['db'];
$_DB = new PDO("mysql:host=$db[host];port=$db[port];dbname=$db[database];charset=UTF8;", "$db[username]", "$db[password]", array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
);
$_DB->query("SET NAMES utf8;");
unset($db);


