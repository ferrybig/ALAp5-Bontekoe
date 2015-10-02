<?php

include_once("_db.php");

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = '';
}

if($action == 'save'){

    $product_naam = $_POST['product_naam'];
    $product_prijs = $_POST['product_prijs'];
    $product_beschrijving = $_POST['product_beschrijving'];

    try{
        $query = $db->prepare("INSERT INTO `menu` (`product_naam`, `product_prijs`, `product_beschrijving`) VALUES ('$product_naam', '$product_prijs', '$product_beschrijving')");
        $query->execute();
        header("location: ../index.php");
    }catch (PDOException $e){
        $sMsg = '<p>
Regelnummer: ' . $e->getLine() . '<br />
Bestand: ' . $e->getFile() . '<br />
Foutmelding: ' . $e->getMessage() . '<br />
</p>';
    }
}else{
    echo "<form action='?action=save' method='post'>
<table>
<tr>
<td>Product naam</td>
<td><input type='text' name='product_naam' required></td>
</tr>
<tr>
<td>Product prijs</td>
<td><input type='text' name='product_prijs' required></td>
</tr>
<tr>
<td>Product beschrijving</td>
<td><input type='text' name='product_beschrijving' required></td>
</tr>
<tr>
<td>
<input type='reset' name='reset' value='leeg maken'>
<input type='submit' name='submit' value='opslaan'>
</td>
</tr>
</table>
</form>";
}

?>