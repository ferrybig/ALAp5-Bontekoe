<?php

include_once("../../php/_db.php");


if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = '';
}

if($action == 'save'){

    $id = $_GET['id'];
    $product_nummer = $_POST['product_nummer'];
    $product_naam = $_POST['product_naam'];
    $product_prijs = $_POST['product_prijs'];
    $product_beschrijving = $_POST['product_beschrijving'];
    $product_type = $_POST['product_type'];

    try{
        $query = $_DB->prepare("UPDATE `menu` SET `product_nummer` = '$product_nummer', `product_naam` = '$product_naam', `product_prijs` = '$product_prijs', `product_beschrijving` = '$product_beschrijving', `product_type` = '$product_type' WHERE `id_nummer` = '$id'");
        $query->execute();
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
        $query = $_DB->prepare("SELECT * FROM `menu` WHERE `id_nummer` = '$id'");
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
        $product_nummer = $rij['product_nummer'];
        $product_naam = $rij['product_naam'];
        $product_prijs = $rij['product_prijs'];
        $product_beschrijving = $rij['product_beschrijving'];
        $product_type = $rij['product_type'];
    }

    echo "<form action='?action=save&id=$id' method='post' name='categorieUpdaten'>
<table>
<tr>
<td>Product nummer updaten</td>
<td><input type='text' name='product_nummer' value='$product_nummer' required></td>
</tr>
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
<td>Product type updaten</td>
<td><input type='text' name='product_type' value='$product_type' required></td>
</tr>
<tr>
<td colspan='2'><input type='reset' name='reset' value='leeg maken' >
<input  type='submit' name='submit' value='opslaan'></td>
</tr>
</table>
</form>";
}