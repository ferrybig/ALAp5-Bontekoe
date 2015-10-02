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
                                            <td>nummer</td>
                                            <td>$type</td>
                                            <td>prijs</td>
                                            <td>acties</td></tr>";
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

                                $tafels = $_DB->prepare("SELECT `id`, `nummer` FROM `tables`");
                                $tafels->execute();
                                $tafels = $tafels->fetchAll();
                                
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
                            
                            
                            
                            
                            <h4>Verhaal</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p>
                                Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.
                            </p>
                            <p>
                                Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. Donec turpis. Donec vitae metus. Morbi tristique neque eu mauris. Quisque gravida ipsum non sapien. Proin turpis lacus, scelerisque vitae, elementum at, lobortis ac, quam. Aliquam dictum eleifend risus. In hac habitasse platea dictumst. Etiam sit amet diam. Suspendisse odio. Suspendisse nunc. In semper bibendum libero.
                            </p>
                            <p>
                                Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla. Cras dignissim elit et augue. Nullam non diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum. Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus.
                            </p>
                            <p>
                                Aliquam vehicula sem ut pede. Cras purus lectus, egestas eu, vehicula at, imperdiet sed, nibh. Morbi consectetuer luctus felis. Donec vitae nisi. Aliquam tincidunt feugiat elit. Duis sed elit ut turpis ullamcorper feugiat. Praesent pretium, mauris sed fermentum hendrerit, nulla lorem iaculis magna, pulvinar scelerisque urna tellus a justo. Suspendisse pulvinar massa in metus. Duis quis quam. Proin justo. Curabitur ac sapien. Nam erat. Praesent ut quam.
                            </p>
                            <p>
                                Vivamus commodo, augue et laoreet euismod, sem sapien tempor dolor, ac egestas sem ligula quis lacus. Donec vestibulum tortor ac lacus. Sed posuere vestibulum nisl. Curabitur eleifend fermentum justo. Nullam imperdiet. Integer sit amet mauris imperdiet risus sollicitudin rutrum. Ut vitae turpis. Nulla facilisi. Quisque tortor velit, scelerisque et, facilisis vel, tempor sed, urna. Vivamus nulla elit, vestibulum eget, semper et, scelerisque eget, lacus. Pellentesque viverra purus. Quisque elit. Donec ut dolor.
                            </p>
                            <p>
                                Duis volutpat elit et erat. In at nulla at nisl condimentum aliquet. Quisque elementum pharetra lacus. Nunc gravida arcu eget nunc. Nulla iaculis egestas magna. Aliquam erat volutpat. Sed pellentesque orci. Etiam lacus lorem, iaculis sit amet, pharetra quis, imperdiet sit amet, lectus. Integer quis elit ac mi aliquam pretium. Nullam mauris orci, porttitor eget, sollicitudin non, vulputate id, risus. Donec varius enim nec sem. Nam aliquam lacinia enim. Quisque eget lorem eu purus dignissim ultricies. Fusce porttitor hendrerit ante. Mauris urna diam, cursus id, mattis eget, tempus sit amet, risus. Curabitur eu felis. Sed eu mi. Nullam lectus mauris, luctus a, mattis ac, tempus non, leo. Cras mi nulla, rhoncus id, laoreet ut, ultricies id, odio.
                            </p>
                            <p>
                                Donec imperdiet. Vestibulum auctor tortor at orci. Integer semper, nisi eget suscipit eleifend, erat nisl hendrerit justo, eget vestibulum lorem justo ac leo. Integer sem velit, pharetra in, fringilla eu, fermentum id, felis. Vestibulum sed felis. In elit. Praesent et pede vel ante dapibus condimentum. Donec magna. Quisque id risus. Mauris vulputate pellentesque leo. Duis vulputate, ligula at venenatis tincidunt, orci nunc interdum leo, ac egestas elit sem ut lacus. Etiam non diam quis arcu egestas commodo. Curabitur nec massa ac massa gravida condimentum. Aenean id libero. Pellentesque vitae tellus. Fusce lectus est, accumsan ac, bibendum sed, porta eget, augue. Etiam faucibus. Quisque tempus purus eu ante.
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