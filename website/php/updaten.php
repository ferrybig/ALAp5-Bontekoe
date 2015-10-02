<?php

include_once("_db.php");


if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = '';
}

if($action == 'save'){

    $id = $_GET['id'];
    $product_naam = $_POST['product_naam'];
    $product_prijs = $_POST['product_prijs'];
    $product_beschrijving = $_POST['product_beschrijving'];

    try{
        $query = $db->prepare("UPDATE `menu` SET `product_naam` = '$product_naam' WHERE `id_nummer` = '$id'");
        $query2 = $db->prepare("UPDATE `menu`  SET `product_prijs` = '$product_prijs' WHERE `id_nummer` = '$id'");
        $query3 = $db->prepare("UPDATE `menu`  SET `product_beschrijving` = '$product_beschrijving' WHERE `id_nummer` = '$id'");
        $query->execute();
        $query2->execute();
        $query3->execute();
        header("location: ../index.php");
    }catch (PDOException $e){
        $sMsg = '<p>
        Regelnummer: ' . $e->getLine() . '<br />
        Bestand: ' . $e->getFile() . '<br />
        Foutmelding: ' . $e->getMessage() . '<br />
        </p>';

        trigger_error($sMsg);
    }
}else{

    $id = $_GET["id"];

    try{
        $query = $db->prepare("SELECT * FROM `menu` WHERE `id_nummer` = '$id'");
        $query->execute();
    }catch (PDOException $e){
        $sMsg = '<p>
        Regelnummer: ' . $e->getLine() . '<br />
        Bestand: ' . $e->getFile() . '<br />
        Foutmelding: ' . $e->getMessage() . '<br />
        </p>';

        trigger_error($sMsg);
    }

    while($rij = $query->fetch()){
        $id_nummer = $rij['id_nummer'];
        $product_naam = $rij['product_naam'];
        $product_prijs = $rij['product_prijs'];
        $product_beschrijving = $rij['product_beschrijving'];
    }

    echo "<form action='?action=save&id=$id' method='post' name='categorieUpdaten'>
<table>
<tr>
<td>Product naam updaten</td>
<td><input type='text' name='product_naam' value='$product_naam' required></td>
</tr>
<tr>
<td>Product prijs updaten</td>
<td><input type='text' name='product_prijs' value='$product_prijs' required></td>
</tr>
<tr>
<td>Product beschrijving updaten</td>
<td><input type='text' name='product_beschrijving' value='$product_beschrijving' required></td>
</tr>
<tr>
<td colspan='2'><input type='reset' name='reset' value='leeg maken' >
<input  type='submit' name='submit' value='opslaan'></td>
</tr>
</table>
</form>";
}