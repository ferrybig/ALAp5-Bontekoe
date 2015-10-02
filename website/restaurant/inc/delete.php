<?php
include_once("../../php/_db.php");
$id = $_GET['id'];
$query = $_DB->prepare("DELETE FROM `menu` WHERE `id_nummer` = ?");
$query->execute([$id]);
header("location: ../index.php");
