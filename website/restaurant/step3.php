<?php

require_once __DIR__ . '/../php/_session.php';
require_once __DIR__ . '/../php/_db.php';

if (!isset($_SESSION['reserv'])) {
    header("location: step1.php");
    exit();
}
$invalid = time() - (30 * 60);
if ($_SESSION['reserv']['time'] < $invalid) {
    header("location: step1.php");
    exit();
}
if (!isset($_SESSION['reserv']['form'])) {
    header("location: step2.php");
    exit();
}

$form = $_SESSION['reserv']['form'];
unset($_SESSION['reserv']['form']);
$_SESSION['reserv']['retrycount']--;
$_SESSION['reserv']['time'] = time();

$stat = $_DB->prepare("SELECT count(*) as count FROM orders WHERE date = ?");
$stat->execute([$form['date']]);
$ordercount = $stat->fetchAll()[0]['count'];

$stat = $_DB->prepare("SELECT `id`, `nummer` FROM `tables`");
$stat->execute([]);
$tablecount = $stat->fetchAll();

if ((int)($ordercount) < count($tablecount)) {
    $stat = $_DB->prepare("INSERT INTO `orders` (`name`, `email`, `date`, `table`) VALUES (?, ?, ?, ?)");
    $stat->execute([$form['name'], $form['mail'], $form['date'], (int)$tablecount[$ordercount]['id']]);
    $_SESSION['reserv']['realform'] = $form;
    $_SESSION['reserv']['realform']['table'] = $tablecount[$ordercount]['nummer'];
    $_SESSION['reserv']['retrycount'] = -1;
    header("location: step4.php");
    exit();
} else {
    $_SESSION['reserv']['error'] = "Die datum is al vol gereserveerd, probeer een andere datum.";
    header("location: step2.php");
    exit();
}