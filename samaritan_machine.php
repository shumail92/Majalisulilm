<?php
/**
 * Created by PhpStorm.
 * User: Shumail Mohy-ud-Din
 * Date: 12/14/2015
 * Time: 3:39 PM
 */


session_start();
if( isset(  $_SESSION['samaritan_token'])  ){
    header("location: samaritan.php");
} 

$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['token']) || empty($_POST['key'])) {
        $error = "Invalid Token/key";
    }else{
        $token= $_POST['token'];
        $key= $_POST['key'];
        $token= stripslashes($token);
        $key= stripslashes($key);

        if($token == "123" && $key == "456") {
            session_start(); // Starting Session
            $_SESSION['samaritan_token']= "123456";
            header("location: samaritan.php");
        } else {
            $error = "Invalid token/key";
        }
    }

}


?>




<!DOCTYPE html>

<!--
Project: Majalis ul Ilm
Author: Shumail Mohy ud Din
Website: http://www.7diagonals.com/

-->

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Samaritan v 1.0.0</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Samaritan" name="description" />
    <meta content="7Diagonals" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="assets/img/favico.png" />
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->

<div class="logo">
    <h3>Authenticate yourself!</h3>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM --> <!--action="index.html"-->
    <form class="login-form" method="post" action="samaritan_machine.php">
        <h3 class="form-title">Login to your account</h3>
        <?php if($error != ''){
            echo '<div class="alert alert-danger">';
            echo '<button class="close" data-dismiss="alert"></button>';
            echo "<span>$error</span>";
            echo '</div>';

        } ?>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Auth Token: </label>
            <div class="input-icon">
                <i class="icon-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Auth Token" name="token"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Session key:</label>
            <div class="input-icon">
                <i class="icon-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Session Key" name="key"/>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-lg blue pull-right">
                Login <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>

    </form>
    <!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2016 &copy; Minhaj-ul-Quran International &amp; <a href="http://7diagonals.com/">7Diagonals.</a>
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js" type="text/javascript"></script>
<script src="assets/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        App.init();
        Login.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

