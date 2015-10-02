<?php
include_once("../../php/_db.php");
$id = $_GET['id'];
$query = $_DB->prepare("DELETE FROM `menu` WHERE `id_nummer` = '$id'");
$query->execute();
header("location: ../restaurant/index.php");
$sMsg = '<p>
Regelnummer: ' . $e->getLine() . '<br />
Bestand: ' . $e->getFile() . '<br />
Foutmelding: ' . $e->getMessage() . '<br />
</p>';
trigger_error($sMsg);