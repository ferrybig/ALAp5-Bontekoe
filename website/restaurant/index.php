<?php require_once __DIR__ . "/../php/_db.php"; ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>De Bontekoe</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
        <script type="application/x-javascript">
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <link href="../css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css'/>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- Custom Theme files -->
        <link href="../css/style.css" rel='stylesheet' type='text/css'/>
        <link href="../css/font-awesome.css" rel="stylesheet">
        <script>
            $(document).ready(function () {
                $(".dropdown").hover(
                    function () {
                        $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                        $(this).toggleClass('open');
                    },
                    function () {
                        $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                        $(this).toggleClass('open');
                    }
                );
            });
        </script>
    </head>
    <body>
        <!-- ============================  Navigation Start =========================== -->
        <div class="navbar navbar-inverse-blue navbar">
            <!--<div class="navbar navbar-inverse-blue navbar-fixed-top">-->
            <div class="navbar-inner navbar-inner_1">
                <div class="container">
                    <div class="navigation">
                        <nav id="colorNav">
                            <ul>
                                <li class="green">
                                    <a href="#" class="icon-home"></a>
                                    <ul>
                                        <li><a href="../login/login.php">Login</a></li>
                                        <li><a href="../login/logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <a class="brand" href="../index.html"><img src="../img/logo1.png" alt="logo"></a>

                    <div class="pull-right">
                        <nav class="navbar nav_bottom" role="navigation">

                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header nav_2">
                                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                                        data-target="#bs-megadropdown-tabs">Menu
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#"></a>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                                <ul class="nav navbar-nav nav_1">
                                    <li><a href="../index.html">Home</a></li>
                                    <li><a href="../bioscoop.html">Bioscoop</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Restaurant<span
                                                class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="menu.php">Menu</a></li>
                                            <li><a href="step1.php">Reseveren</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Discotheek<span
                                                class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="../uitgaan/index.php">Home</a></li>
                                            <li><a href="../uitgaan/index.php?page=80s-90s">80's en 90's</a></li>
                                            <li><a href="../uitgaan/index.php?page=schuurfeest">Schuurfeest</a></li>
                                            <li><a href="../uitgaan/index.php?page=urban">Urban</a></li>
                                        </ul>
                                    </li>
                                    <li class="last"><a href="../contact.html">Contacts</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>
                    </div>
                    <!-- end pull-right -->
                    <div class="clearfix"></div>
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-inner -->
        </div>
        <!-- end navbar-inverse-blue -->
        <!-- ============================  Navigation End ============================ -->
        <div class="grid_3">
            <div class="container">
                <!--<div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3150859.767904157!2d-96.62081048651531!3d39.536794757966845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1408111832978"> </iframe>
                </div>-->
                <div class="footer">
                    <div class="container">
                        <div class="col-md-4 col_2">
                            <?php
                            ////////////////////////////////////////////////////////////////////////////////
                            // VOORGERECHT
                            ////////////////////////////////////////////////////////////////////////////////
                            try {
                                $hoofd = $_DB->prepare("SELECT * FROM  `menu` WHERE `product_type` = 'Voorgerecht'");
                                $hoofd->execute();
                            } catch (PDOException $e) {
                                $sMsg = '<p>
                                Regelnummer: ' . $e->getLine() . '<br />
                                Bestand: ' . $e->getFile() . '<br />
                                Foutmelding: ' . $e->getMessage() . '<br />
                            </p>';
                                trigger_error($sMsg);
                            }
                            echo "<table border='1'>
                                <tr>
                                    <td>nummer</td>
                                    <td>voorgerecht</td>
                                    <td>prijs</td>
                                    <td>acties</td>
                                </tr>
                                ";
                            while ($rij = $hoofd->fetch()) {
                                $id_nummer = $rij['id_nummer'];
                                $product_nummer = $rij['product_nummer'];
                                $product_naam = $rij['product_naam'];
                                $product_prijs = $rij['product_prijs'];
                                $product_beschrijving = $rij['product_beschrijving'];
                                echo "<tr>
                                    <td>$product_nummer</td>
                                    <td>$product_naam</td>
                                    <td>$product_prijs</td>
                                    <td>
                                        <a href='inc/delete.php?action=delete&id=$id_nummer'><img src='../img/delete.jpg'></a>
                                        <a href='inc/updaten.php?id=$id_nummer'><img src='../img/edit.jpg'></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan='3'>$product_beschrijving</td>
                                </tr>";
                            }
                            echo "
                                <tr>
                                    <td colspan='3' > Product toevoegen</td>
                                    <td><a href='inc/toevoegen.php'><img src='../img/toevoegen.png'></a></td>
                                </tr>
                            </table><br />";
                            ////////////////////////////////////////////////////////////////////////////////
                            // HOOFDGERECHT
                            ////////////////////////////////////////////////////////////////////////////////
                            try {
                                $hoofd = $_DB->prepare("SELECT * FROM  `menu` WHERE `product_type` = 'Hoofdgerecht'");
                                $hoofd->execute();
                            } catch (PDOException $e) {
                                $sMsg = '<p>
                                Regelnummer: ' . $e->getLine() . '<br />
                                Bestand: ' . $e->getFile() . '<br />
                                Foutmelding: ' . $e->getMessage() . '<br />
                            </p>';
                                trigger_error($sMsg);
                            }
                            echo "<table border='1'>
                                <tr>
                                    <td>nummer</td>
                                    <td>hoofdgerecht</td>
                                    <td>prijs</td>
                                    <td>acties</td>
                                </tr>
                                ";
                            while ($rij = $hoofd->fetch()) {
                                $id_nummer = $rij['id_nummer'];
                                $product_nummer = $rij['product_nummer'];
                                $product_naam = $rij['product_naam'];
                                $product_prijs = $rij['product_prijs'];
                                $product_beschrijving = $rij['product_beschrijving'];
                                echo "<tr>
                                    <td>$product_nummer</td>
                                    <td>$product_naam</td>
                                    <td>$product_prijs</td>
                                    <td>
                                        <a href='inc/delete.php?action=delete&id=$id_nummer'><img src='../img/delete.jpg'></a>
                                        <a href='inc/updaten.php?id=$id_nummer'><img src='../img/edit.jpg'></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan='3'>$product_beschrijving</td>
                                </tr>";
                            }
                            echo "
                                <tr>
                                    <td colspan='3' > Product toevoegen</td>
                                    <td><a href='inc/toevoegen.php'><img src='../img/toevoegen.png'></a></td>
                                </tr>
                            </table><br />";
                            ////////////////////////////////////////////////////////////////////////////////
                            // NAGERECHT
                            ////////////////////////////////////////////////////////////////////////////////
                            try {
                                $hoofd = $_DB->prepare("SELECT * FROM  `menu` WHERE `product_type` = 'Nagerecht'");
                                $hoofd->execute();
                            } catch (PDOException $e) {
                                $sMsg = '<p>
                                Regelnummer: ' . $e->getLine() . '<br />
                                Bestand: ' . $e->getFile() . '<br />
                                Foutmelding: ' . $e->getMessage() . '<br />
                            </p>';
                                trigger_error($sMsg);
                            }
                            echo "<table border='1'>
                                <tr>
                                    <td>nummer</td>
                                    <td>nagerecht</td>
                                    <td>prijs</td>
                                    <td>acties</td>
                                </tr>
                                ";
                            while ($rij = $hoofd->fetch()) {
                                $id_nummer = $rij['id_nummer'];
                                $product_nummer = $rij['product_nummer'];
                                $product_naam = $rij['product_naam'];
                                $product_prijs = $rij['product_prijs'];
                                $product_beschrijving = $rij['product_beschrijving'];
                                echo "<tr>
                                    <td>$product_nummer</td>
                                    <td>$product_naam</td>
                                    <td>$product_prijs</td>
                                    <td>
                                        <a href='inc/delete.php?action=delete&id=$id_nummer'><img src='../img/delete.jpg'></a>
                                        <a href='inc/updaten.php?id=$id_nummer'><img src='../img/edit.jpg'></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan='3'>$product_beschrijving</td>
                                </tr>";
                            }
                            echo "
                                <tr>
                                    <td colspan='3' > Product toevoegen</td>
                                    <td><a href='inc/toevoegen.php'><img src='../img/toevoegen.png'></a></td>
                                </tr>
                            </table><br />";
                            ////////////////////////////////////////////////////////////////////////////////
                            // DRANKEN
                            ////////////////////////////////////////////////////////////////////////////////
                            try {
                                $hoofd = $_DB->prepare("SELECT * FROM  `menu` WHERE `product_type` = 'Dranken'");
                                $hoofd->execute();
                            } catch (PDOException $e) {
                                $sMsg = '<p>
                                Regelnummer: ' . $e->getLine() . '<br />
                                Bestand: ' . $e->getFile() . '<br />
                                Foutmelding: ' . $e->getMessage() . '<br />
                            </p>';
                                trigger_error($sMsg);
                            }
                            echo "<table border='1'>
                                <tr>
                                    <td>nummer</td>
                                    <td>dranken</td>
                                    <td>prijs</td>
                                    <td>acties</td>
                                </tr>
                                ";
                            while ($rij = $hoofd->fetch()) {
                                $id_nummer = $rij['id_nummer'];
                                $product_nummer = $rij['product_nummer'];
                                $product_naam = $rij['product_naam'];
                                $product_prijs = $rij['product_prijs'];
                                $product_beschrijving = $rij['product_beschrijving'];
                                echo "<tr>
                                    <td>$product_nummer</td>
                                    <td>$product_naam</td>
                                    <td>$product_prijs</td>
                                    <td>
                                        <a href='inc/delete.php?action=delete&id=$id_nummer'><img src='../img/delete.jpg'></a>
                                        <a href='inc/updaten.php?id=$id_nummer'><img src='../img/edit.jpg'></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan='3'>$product_beschrijving</td>
                                </tr>";
                            }
                            echo "
                                <tr>
                                    <td colspan='3' > Product toevoegen</td>
                                    <td><a href='inc/toevoegen.php'><img src='../img/toevoegen.png'></a></td>
                                </tr>
                            </table>";
                            ////////////////////////////////////////////////////////////////////////////////
                            // table MANAGER
                            ////////////////////////////////////////////////////////////////////////////////
                            echo "<h3>Tafel manager</h3>";
                            $action = filter_input(INPUT_GET, 'action');
                            if ($action === 'update') {
                                $stat = $_DB->prepare(""
                                    . "UPDATE `rooms` SET `tablenumber` = :tablenumber, `roomtype` = :roomtype WHERE `id` = :id");
                                $stat->execute([
                                    'name' => filter_input(INPUT_POST, 'tablenumber'),
                                    'roomtype' => filter_input(INPUT_POST, 'roomtype'),
                                    'id' => filter_input(INPUT_POST, 'id'),
                                ]);
                            } else if ($action === 'insert') {
                                $stat = $_DB->prepare(""
                                    . "INSERT INTO `rooms` ( `tablenumber` , `locationid` ) VALUES ( :tablenumber, 1 )"); // TODO Allow location id selector
                                $stat->execute([
                                    'tablenumber' => filter_input(INPUT_POST, 'name'),
                                ]);
                            }
                            $delete = filter_input(INPUT_GET, 'delete');
                            if ($delete != false) {
                                $stat = $_DB->prepare(""
                                    . "DELETE FROM `rooms` WHERE `id` = ?");
                                $stat->execute([$delete]);
                                echo "<p>Tafel verwijderd!</p>";
                            }

                            $type = filter_input(INPUT_GET, 'edit');
                            if ($type == false) {
                                $stat = $_DB->prepare("SELECT `id`, `tablenumber` FROM `rooms`");
                                $stat->execute();
                                echo '<div id=datatable><table><thead><tr>';
                                echo "<th>ID</th>";
                                echo "<th>Tafelnummer</th>";
                                echo "<th>Edit</th>";
                                echo "<th>Delete</th>";
                                echo "</tr></thead><tbody>";
                                foreach ($stat as $row) {
                                    echo "<tr>";
                                    echo "<td class='table'>$row[id]</td>";
                                    echo "<td class='table'>$row[tablenumber]</td>";
                                    echo "<td class='table'><a href='?page=rooms&edit=$row[id]'>Edit</a></td>";
                                    echo "<td class='table'><a href='?page=rooms&delete=$row[id]'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody><tfoot>";
                                if ($stat->rowCount() == 0) {
                                    echo "<tr><td colspan=5><strong>No room types found</strong></td></tr>";
                                }
                                echo "<tr><td colspan=5><a href='?page=rooms&edit=-1'>Maak nieuwe tafel</a></td></tr>";
                                echo "</tfoot></table></div>";
                            } else if ($type == '-1') {
                                echo "<form action='?page=rooms&action=insert' method=POST>";
                                echo "<p><label>Tafel nummer<br><input name=name type=text required></label></p>";
                                echo "<p><input type=submit></p>";
                                echo '</form>';
                            } else {
                                $stat = $_DB->prepare("SELECT `id`, `tablenumber`, `roomtype` FROM `rooms` WHERE `id` = ?");
                                $stat->execute([$type]);
                                $rows = $stat->fetchAll();
                                if (!empty($rows)) {
                                    $row = $rows[0];
                                    echo "<form action='?page=rooms&action=update' method=POST>";
                                    echo "<p><label>ID<br><input name=id type=number readonly value=$row[id]></label></p>";
                                    echo "<p><label>Table number<br><input name=name type=text required value='$row[tablenumber]'></label></p>";
                                    echo "<p><input type=submit></p>";
                                    echo '</form>';
                                }
                            }
                            $asAjax = filter_has_var(INPUT_POST, 'ajax');
                            ////////////////////////////////////////////////////////////////////////////////
                            // Order manager
                            ////////////////////////////////////////////////////////////////////////////////
                            if (!$asAjax) {
                                echo "<h3>Order manager</h3>";
                            }
                            $delete = filter_input(INPUT_GET, 'delete');
                            if ($delete != false) {
                                $stat = $_DB->prepare(""
                                    . "DELETE FROM `orderlist` WHERE `id` = ?");
                                $stat->execute([$delete]);
                                echo "<p>Order deleted</p>";
                            }
                            $orderview = filter_input(INPUT_GET, 'order');
                            if ($orderview != null) {
                                $stat = $_DB->prepare("SELECT `memberid`, `price`, `payed`, `created`, `created_by`, `comments` FROM `orderlist` WHERE `id` = ?");
                                $stat->execute([$orderview]);
                                $rows = $stat->fetchAll();
                                if (empty($rows)) {
                                    echo "No results found";
                                } else {
                                    $row = $rows[0];
                                    $stat = $_DB->prepare("SELECT `fullname` FROM `members` WHERE `id` = ?");
                                    $stat->execute([$row['memberid']]);
                                    $user = $stat->fetch();
                                    unset($stat);
                                    $stat = $_DB->prepare("SELECT `fullname` FROM `members` WHERE `id` = ?");
                                    $stat->execute([$row['created_by']]);
                                    $by = $stat->fetch();
                                    echo "<p><a href='?page=orders&delete=$orderview'>Delete order</a></p>";
                                    echo "<dl>";
                                    echo "<dt>Id</dt><dd>$orderview</dd>";
                                    echo "<dt>Created</dt><dd>$row[created]</dd>";
                                    echo "<dt>Payed</dt><dd>$row[payed]</dd>";
                                    echo "<dt>Price</dt><dd>$ $row[price].00</dd>";
                                    echo "<dt>Comments</dt><dd>$row[comments]</dd>";
                                    echo "<dt>Member</dt><dd><a href='?page=user&user=$row[memberid]'>$user[fullname]</a></dd>";
                                    echo "<dt>Created by</dt><dd><a href='?page=user&user=$row[created_by]'>$by[fullname]</a></dd>";
                                    echo "</dl>";
                                    echo "<p>Rooms affected:</p>";
                                    $stat = $_DB->prepare(<<<SQL
                                SELECT
                            `rooms`.`id`,
                            `rooms`.`roomnumber`,
                            `roomtypes`.`name` as 'roomtype',
                            `roomtypes`.`id` as 'roomtypeid',
                            `orders`.`date`
                            FROM rooms
                            INNER JOIN `orders`
                            ON `rooms`.`id` = `orders`.`roomid`
                            INNER JOIN `roomtypes`
                            ON `rooms`.`roomtype` = `roomtypes`.`id`
                            WHERE `orders`.`orderid` = ?
SQL
                                    );
                                    $stat->execute([$orderview]);
                                    echo "<div id=datatable><table><thead><tr><th>roomtype</th><th>roomnumber</th><th>date</th></tr></thead><tbody>";
                                    foreach ($stat as $r) {
                                        echo <<<HTML
                                    <tr>
                                        <td>
                                            <a href='?page=type&edit=$r[roomtypeid]'>
                                                $r[roomtype]
                                            </a>
                                        </td>
                                        <td>
                                            <a href='?page=rooms&edit=$r[id]'>
                                                $r[tablenumber]
                                            </a>
                                        </td>
                                        <td>
                                            $r[date]
                                        </td>
                                    </tr>
HTML;
                                    }
                                    if ($stat->rowCount() == 0) {
                                        echo "<tr><td colspan=3><strong>No rooms found for this order</strong></td></tr>";
                                    }
                                    echo "</tbody><tfoot></tfoot></table></div>";
                                }
                            } else {
                                $startdate = filter_input(INPUT_POST, 'start');
                                if ($startdate != false) {
                                    $start = DateTime::createFromFormat('Y-m-d', $startdate);
                                } else {
                                    $start = new DateTime;
                                    $start->sub(new DateInterval('P10D'));
                                }
                                $start->sub(new DateInterval('P1D'));
                                $enddate = filter_input(INPUT_POST, 'end');
                                if ($enddate != false) {
                                    $end = DateTime::createFromFormat('Y-m-d', $enddate);
                                } else {
                                    $end = new DateTime;
                                    $end->add(new DateInterval('P120D'));
                                }
                                $stat = $_DB->prepare(<<<SQL
                                SELECT
                            `rooms`.`id`,
                            `rooms`.`tablenumber` AS 'type'
                            FROM `rooms`
                            ORDER BY `rooms`.`id`
SQL
                                );
                                $stat->execute();
                                $rooms = $stat->fetchAll();
                                $roomsById = [];
                                $actualStart = clone $start;
                                $actualStart->add(new DateInterval('P1D'));
                                if (!$asAjax) {
                                    echo "<form method=POST id=orderform action='?page=orders'>Show records from ";
                                    echo "<input type=date id=startdate name=start required value='" . $actualStart->format('Y-m-d') . "'> ";
                                    echo "to <input type=date id=enddate name=end required value='" . $end->format('Y-m-d') . "'>";
                                    echo "<input type=submit value='refresh page'></form>";
                                    echo "<div id=datatable><table id=ordertable><thead><tr><th>Date</th>";
                                }
                                $numbers = [];
                                $seenNumbers = [];
                                foreach ($rooms as $r) {
                                    $roomsById[$r['id']] = $r;
                                    $numbers[] = $r['id'];
                                    $seenNumbers[$r['id']] = 0;
                                    if (!$asAjax) {
                                        echo "<th>$r[type]</th>";
                                    }
                                }
                                if (!$asAjax) {
                                    echo "</tr></thead><tbody>";
                                }

                                $interval = DateInterval::createFromDateString('1 day');
                                $period = new DatePeriod($start, $interval, $end);
                                $stat = $_DB->prepare(<<<SQL
                                        SELECT
                                    `orders`.`id`,
                                    `orders`.`roomid`,
                                    `orderlist`.`memberid`,
                                    `members`.`username`,
                                    `orderlist`.`id` AS 'orderid',
                                    `orderlist`.`payed` IS NOT NULL AS 'haspayed',
                                    `orderlist`.`created` AS 'created'
                                    FROM `orderlist`
                                    LEFT JOIN `orders`
                                    ON `orders`.`orderid` = `orderlist`.`id`
                                    LEFT JOIN `members`
                                    ON `members`.`id` = `orderlist`.`memberid`
                                    WHERE `date` = ?
                                    ORDER BY `orders`.`roomid`
SQL
                                );
                                $isFirstEntry = true;
                                foreach ($period as $dt) {
                                    if ($isFirstEntry) {
                                        ob_start();
                                    }
                                    $stat->execute([$dt->format("Y-m-d")]);
                                    $i = 0;
                                    $rows = $stat->fetchAll();
                                    echo "<tr>";
                                    echo "<td>" . $dt->format("Y-m-d") . "</td>";
                                    foreach ($rows as $row) {
                                        while ($row['roomid'] != $numbers[$i]) {
                                            $classes = '';
                                            if ($seenNumbers[$numbers[$i]] != 0) {
                                                $classes .= ' startEntry';
                                                $seenNumbers[$numbers[$i]] = 0;
                                            }
                                            echo "<td class='free$classes'></td>";
                                            $i++;
                                        }
                                        $timestamp = date("Y-m-d H:i:s", strtotime($row['created']));
                                        $classes = $row['haspayed'] ? "payed" : "pending";
                                        if ($seenNumbers[$row['roomid']] != $row['orderid']) {
                                            $classes .= ' startEntry';
                                            $seenNumbers[$row['roomid']] = $row['orderid'];
                                        }
                                        $id = sprintf("%'.05d", $row['orderid'] + 0);
                                        echo "<td class='nonfree $classes' title='$timestamp'>"
                                            . "<a href='?page=orders&order=$id'>$id </a>("
                                            . "<a href='?page=user&user=$row[memberid]'>$row[username]</a>) "
                                            . "</td>";
                                        $i++;
                                    }
                                    while ($i < count($numbers)) {
                                        $classes = '';
                                        if ($seenNumbers[$numbers[$i]] != 0) {
                                            $classes .= ' startEntry';
                                            $seenNumbers[$numbers[$i]] = 0;
                                        }
                                        echo "<td class='free$classes'></td>";
                                        $i++;
                                    }
                                    echo "</tr>\n";
                                    if ($isFirstEntry) {
                                        ob_end_clean();
                                        $isFirstEntry = false;
                                    }
                                }
                                if (!$asAjax) {
                                    echo "</tbody><tfoot></tfoot></table></div>";
                                }
                            }

                            ?>
                        </div>
                        <div class="col-md-2 col_2">
                            <h4>Sociaal Media</h4>
                            <ul class="footer_social">
                                <li><a href="#"><i class="fa fa-facebook fa1"> </i></a></li>
                                <li><a href="#"><i class="fa fa-twitter fa1"> </i></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="copy">
                            <p>Copyright © 2015 Bontekoe</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>	