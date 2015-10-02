<?php
include_once("_db.php");
$id = $_GET['id'];
$query = $db->prepare("DELETE FROM `menu` WHERE `id_nummer` = '$id'");
$query->execute();
header("location: ../index.php");
$sMsg = '<p>
Regelnummer: ' . $e->getLine() . '<br />
Bestand: ' . $e->getFile() . '<br />
Foutmelding: ' . $e->getMessage() . '<br />
</p>';
trigger_error($sMsg);