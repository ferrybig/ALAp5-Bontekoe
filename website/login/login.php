<?php

/*
 * $displayform: 
 * array(true): show login form
 * array(true,String): show login form with error
 * array(true,array()): Use this information to prepopulate the form
 * array(false,array()): Show logged in user information
 */
$displayForm = array(true, "");
require_once '../php/_session.php';
ob_start();
?>


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
            <div class="navbar-inner">
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
                    <a class="brand" href="index.html"><img src="../img/logo1.png" alt="logo"></a>

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
                                            <li><a href="../home.html">Home</a></li>
                                            <li><a href="../menu.html">Menu</a></li>
                                            <li><a href="../reseveren.html">Reseveren</a></li>
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
        <!--<div class="map">
           <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3150859.767904157!2d-96.62081048651531!3d39.536794757966845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1408111832978"> </iframe>
        </div>-->
        <div class="footer">
            <div class="container">
                <div class="col-md-4 col_2">


<?PHP

echo'<div method="POST" id="login">';
if (isset($_SESSION['user'])) { //if there is a seasion user
    $displayForm = array(false, $_SESSION['user']); //if its false the website is logged in
} else if (filter_has_var(INPUT_GET, "activate")) {

    $mailkey = explode(":", filter_input(INPUT_GET, "activate"));
    require_once '../php/_db.php';//required the page _db.php
    $results = $db->prepare("
                                SELECT `id`, `userid`, `features` FROM `sessions` WHERE `id` = :id AND `userid` = :userid AND `expires` > NOW()
                                ");
    $results->execute(array(
        "id" => $mailkey[1],     //identical mailkey used line 27 and 20
        "userid" => $mailkey[0],
    ));
    $session_information = null;
    foreach ($results as $session_information)
        ;
    unset($results);

    $user_information = null;
    if ($session_information != null) {
        $session_information['features'] = explode(",", $session_information['features']);
        $results = $db->prepare("
                                    SELECT `id`, `username`, `fullname`, `email`, `features` FROM `members` WHERE `id` = :id 
                                    ");
        $results->execute(array(
            "id" => $mailkey[0],
        ));
        $user_information = null;
        foreach ($results as $user_information)
            ;
        unset($results);
    } else {
        header("Location: " . explode("login.php", $_SERVER["REQUEST_URI"])[0] . "login.php?");
        exit();
    }
    if ($user_information !== null) {
        for ($i = 0; isset($user_information[$i]); $i++)
            unset($user_information[$i]);
        $user_information['features'] = explode(",", $user_information['features']);
        if (in_array("verifyemail", $session_information['features'])) {
            if (!in_array("email_validated", $user_information['features'])) {
                array_push($user_information['features'], "email_validated");
            }  // sql code
            $results = $db->prepare("
                                    UPDATE `members` SET `features` = :features WHERE `id` = :id 
                                    ");
            $results->execute(array(
                "id" => $user_information['id'],
                "features" => implode(",", $user_information['features']),
            ));
            unset($results);
        }
        if (in_array("onetime", $session_information['features'])) {
            $results = $db->prepare("
                                    DELETE FROM `sessions` WHERE `id` = :id 
                                    ");
            $results->execute(array(
                "id" => $session_information['id'],
            ));
            unset($results);
        }
        if (in_array("banned", $user_information['features'])) {
            $displayForm = array(true, $user_information);
        } else if (in_array("require_password", $session_information['features'])) {
            $displayForm = array(true, $user_information);
        } else {
            $displayForm = array(false, $user_information);
        }
    } else {
        header("Location: " . explode("login.php", $_SERVER["REQUEST_URI"])[0] . "login.php");
        exit();
    }
} else if (filter_has_var(INPUT_POST, "login") && filter_has_var(INPUT_POST, "password")) {
    $login = filter_input(INPUT_POST, "login", FILTER_UNSAFE_RAW);
    $password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
    $token = filter_input(INPUT_POST, "token", FILTER_UNSAFE_RAW);  //sql code
    $sql = "SELECT `id`, `password_hash`, `username`, `fullname`, `email`, `features` FROM `members` WHERE ";
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $sql .= "`email` = :login";
    } else if (preg_match("/^[a-zA-Z0-9]{1,20}$/", $login)) {
        $sql .= "`username` = :login";
    } else {
        $sql = false;
    }
    if(!isset($_SESSION['token']) || $token !== $_SESSION['token'] || isset($_SESSION['hyjacked'])) {
        $displayForm = array(true, "Invalid security token, is your sesion hyjacked?");
        $_SESSION['hyjacked'] = true;
        session_regenerate_id (false);
        session_reset ();
    } else if ($sql != false) {
        unset($_SESSION['token']);
        require_once '../php/_db.php';
        $results = $db->prepare($sql);
        $results->execute(array(
            "login" => $login,
        ));
        $user_information = $results->fetch();
        unset($results);


        // Login by email/username && password
        if (is_array($user_information)) {
            for ($i = 0; isset($user_information[$i]); $i++)
                unset($user_information[$i]);
            $user_information['features'] = explode(",", $user_information['features']);
            if (password_verify($password, $user_information['password_hash'])) {

                //Remove password hash if it was read from the result
                $user_information['password_hash'] = null;

                if (in_array("banned", $user_information['features'])) {
                    $displayForm = array(true, "Your account is banned");
                } else if (!in_array("email_validated", $user_information['features'])) {
                    $displayForm = array(true, "You need to activate your account using instructions inside your mail");
                } else {
                    $displayForm = array(false, $user_information);
                }
            } else {
                //Remove password hash
                $user_information['password_hash'] = null;


                // invalid password
                $displayForm = array(true, "Invalid email/password combination");
            }
        } else {
            // invalid email/
            $displayForm = array(true, "Invalid email/password combination");
        }
    }
}

if ($displayForm[0] === true) {
    echo "<form action=login.php method=POST>";
    $url = filter_input(INPUT_POST, 'url');
    if (empty($url))
        $url = filter_input(INPUT_GET, 'url');
    if (empty($url)) {
        $url = $_SERVER['REQUEST_URI'];
        $url = dirname(dirname($url));
    } else {
        
    }
    $url = htmlentities($url);
    echo "<input type=hidden name=url value='$url'>";
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    echo "<input type=hidden name=token value='$_SESSION[token]'>";

    $showEmail = false;
    if (!isset($displayForm[1])) {
        echo "<p class=loginErr>You must login to access his area</p>";
    } else if (is_string($displayForm[1])) {
        echo "<p class=loginErr>$displayForm[1]</p>";
    } else if (is_array($displayForm[1])) {
        echo "<p class=loginErr>use your password to log in</p>";
        $showEmail = true;
    }
    if ($showEmail) {
        echo "<p class=shortcontact>{$displayForm[1]["fullname"]} ({$displayForm[1]["username"]})<br>{$displayForm[1]["email"]}</p>";
        echo "<input type=hidden name=login value={$displayForm[1]["email"]}>";
    } else {
        echo "<p><label><span>Email:</span><input type=text name=login value='" . filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "'></p>";
    }
    echo "<p><label><span>password:</span><input type=password name=password></label></p>";
    echo "<input type=submit value=Login>";
    echo "<p><a href=register.php>Make an new account</a></p>";
    echo "</form>";
} else {
    $_SESSION["user"] = $displayForm[1];

    $tempurl = filter_input(INPUT_POST, 'url');
    if (empty($tempurl)) {
        $url = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $url .= $_SERVER['SERVER_NAME'];
        $url .= $_SERVER['REQUEST_URI'];
        $url = dirname(dirname($url));
    } else {
        $url = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $url .= $_SERVER['SERVER_NAME'];
        $url .= $tempurl;
    }
    header("Location: " . $url);
    exit();
}
//unset($_SESSION["user"]);
echo'</div>';


?>
                </div>
                <h4>Sociaal Media</h4>
                <ul class="footer_social">
                    <li><a href="#"><i class="fa fa-facebook fa1"> </i></a></li>
                    <li><a href="#"><i class="fa fa-twitter fa1"> </i></a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="copy">
                <p>Copyright © 2015 | Bontekoe</p>
            </div>
        </div>
        </div>
    </body>
</html>	
<?PHP
ob_end_flush();
