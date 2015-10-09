<?php
//for us
$name    = $_POST['Name'];
$phone = $_POST['Phone'];
$email = $_POST['Email'];
$message = $_POST['Message'];


if(empty($_POST['Name'])  ||
    empty($_POST['Phone'])  ||
    empty($_POST['Email'])  ||
    empty($_POST['Message']))

{
    exit;
}

else {
    $send_to = 'jeoff98@gmail.com';
    mail($send_to, "Name: $name" , $message, "From: $email");
    header( 'Location: ../../contact.html' ) ;
    // afmaken bij header
}
