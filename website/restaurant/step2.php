<?php
require_once __DIR__ . '/../php/_session.php';
require_once __DIR__ . '/../php/_formbuilder.php';

if (!isset($_SESSION['reserv'])) {
    header("location: step1.php");
    exit();
}
$invalid = time() - (30 * 60);
if ($_SESSION['reserv']['time'] < $invalid) {
    header("location: step1.php");
    exit();
}
if ($_SESSION['reserv']['retrycount'] < 1) {
    header("location: step1.php");
    exit();
}
if (isset($_SESSION['reserv']['form'])) {
    header("location: step3.php");
    exit();
}


$formbuilder = new Formbuilder([
    "token" => [
        "type" => "token",
        "token" => $_SESSION['reserv']['token'],
        'required' => true,
    ],
    "date" => [
        "type" => "date",
        'label' => "Uw gewenste datum",
        'min' => date('Y-m-d'),
        'max' => date('Y-m-d', strtotime('+1 week')),
        'required' => true,
    ],
    "mail" => [
        "label" => "Uw email address",
        "type" => "mail",
        "placeholder" => "email@yourdomain.nl",
        'required' => true,
    ],
    "name" => [
        "label" => "Uw naam",
        "type" => "text",
        "placeholder" => "Jou Naam",
        'required' => true,
    ]
        ]);

if ($formbuilder->isFilledIn()) {
    $_SESSION['reserv']['form'] = $formbuilder->getValues();
    header("location: step3.php");
    exit();
}
?>




<!DOCTYPE html>
<html>
    <head>
        <title>Resturant</title>
    </head>
    <body>
        <form action="?" method="POST">
            <?PHP if(isset($_SESSION['reserv']['error'])) { ?>
            <p>
                <?PHP echo htmlentities($_SESSION['reserv']['error']); ?>
            </p>
            <?PHP } ?>
            
            <?PHP foreach ($formbuilder->buildFormControls() as $key => $value) { ?>
                <p>
                    <?PHP echo$value ?>
                </p>
            <?PHP } ?>
            <input type="submit">

        </form>
    </body>
</html>