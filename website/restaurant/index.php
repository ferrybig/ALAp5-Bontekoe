<?php require_once __DIR__ . "/../php/_db.php"; ?>
<?php require_once __DIR__ . "/../php/_session.php"; ?>
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
        <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
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
                        <div class="col-md-8 col_2">
                            <?php
                            if(isset($_SESSION['user'])) {
                            
                                ////////////////////////////////////////////////////////////////////////////////
                                // MENU
                                ////////////////////////////////////////////////////////////////////////////////

                                $types = ["Voorgerecht", "Hoofdgerecht", "Nagerecht", "Dranken"];
                                foreach($types as $type) {
                                    $hoofd = $_DB->prepare(<<<SQL
SELECT `id_nummer`, `product_nummer`, `product_naam`, `product_prijs`, `product_beschrijving`  FROM  `menu` WHERE `product_type` = ?
SQL
                                            );
                                    $hoofd->execute([$type]);
                                    echo "<table border=1 style='width:100%' ><tr>
                                            <td>Nummer</td>
                                            <td>$type</td>
                                            <td>Prijs</td>
                                            <td>Acties</td></tr>";
                                    while ($rij = $hoofd->fetch()) {
                                        $id_nummer = $rij['id_nummer'];
                                        $product_nummer = $rij['product_nummer'];
                                        $product_naam = $rij['product_naam'];
                                        $product_prijs = $rij['product_prijs'];
                                        $product_beschrijving = $rij['product_beschrijving'];
                                        echo "<tr>
                                            <td>$product_nummer</td>
                                            <td>$product_naam</td>
                                            <td>€ $product_prijs</td>
                                            <td><a href='inc/delete.php?action=delete&id=$id_nummer'><img src='../img/delete.jpg'></a>
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
                                            <td colspan='3'> Product toevoegen</td>
                                            <td><a href='inc/toevoegen.php'><img src='../img/toevoegen.png'></a></td>
                                        </tr>
                                    </table><br />";
                                }

                                ////////////////////////////////////////////////////////////////////////////////
                                // table MANAGER
                                ////////////////////////////////////////////////////////////////////////////////
                                echo "<h3>Tafel manager</h3>";

                                $records = $_DB->prepare("SELECT `date`, `id`, `name`, `email`, `table` FROM `orders`");
                                $records->execute();
                                $records = $records->fetchAll(PDO::FETCH_GROUP);
                                
                                
                                echo "<table style='width:100%' border=1><tr><th>Orderdate</th><th>tafel</th><th>persoon</th></tr>";
                                
                                foreach($records as $date => $entries) {
                                    $size = count($entries);
                                    $first = true;
                                    foreach($entries as $entry) {
                                        echo "<tr>";
                                        if($first) {
                                            echo"<th rowspan=$size>$date</th>";
                                            $first = false;
                                        }
                                        echo "<td>$entry[table]</td>";
                                        echo "<td>$entry[name]<br>&nbsp;&nbsp;$entry[email]</td>";
                                        echo "</tr>";
                                    }
                                }
                                
                                echo "</table><br><br><br><br>";
                                
                            } 
                            ?>
                            
                            
                            
                            
                            <h4>Belangrijk om te weten over het restaurant</h4>
                            <p>
                                Het restaurant is dagelijks van 16:00 uur tot 23:00 uur geopend! <br /> <br />
                            </p>

                            <p>
                                In ons restaurant zijn tafels alleen te reserveren voor een hele dag. <br />
                                Reserveren kan op de reserveerpagina onder "Restaurant" en dan "Reserveren". <br />
                                Hier kan je de reservatiedag opgeven <br />
                                Na het kiezen van de reservatiedag hoef je alleen nog maar je e-mailadres en je naam in te voeren. <br />
                                Nadat je dit hebt gedaan krijg je een e-mail met de gegevens over de reservatie.

                            </p>

                            
                            
                            
                            
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