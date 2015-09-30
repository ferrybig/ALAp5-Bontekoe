<?php

require_once("../php/_db.php");

if(!isset($_GET['page']))
    $_GET['page'] = "home";
try{
    $query = $_DB->prepare("SELECT * FROM  `uitgaan` WHERE `page` = '$_GET[page]'");
    $query->execute();
}catch(PDOException $e){
    $sMsg = '<p>
            Regelnummer: ' . $e->getLine() . '<br />
            Bestand: ' . $e->getFile() . '<br />
            Foutmelding: ' . $e->getMessage() . '<br />
            </p>';
    trigger_error($sMsg);
}

while($rij = $query->fetch()) {
    $text = $rij['text'];
}
echo "$text";

