<?php 
include 'db_connect.php';

if(!isset($_GET["vid"])) {
   $vid = $_GET["vid"];
   header('Location: ?vid=1');
} else {
   $vid = $_GET["vid"];
   //check if serial number exists for this $vid
   $sql = "SELECT * from videos_detail where serial_no = $vid";
   $result = $mysqli->query($sql);
   
   if($result) {
     $row_count = $result->num_rows; 

     if($row_count == 1) { //exists in db - valid video id
         $vid = $vid;   //do nothing
         $result_row = $result->fetch_assoc();
         $page_title = "Majalis-ul-ilm (Lecture # $vid) - " . $result_row["lec_title"] . " - by Shaykh-ul-Islam Dr Muhammad Tahir-ul-Qadri";
     } else {
      header('Location: ?vid=1');   // if error: send to default landing of first video
     }
   } 
}

?>


<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<?php include 'un_header.php';?>
   <title><?php echo $page_title; ?> </title>

   <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
   <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>

   <link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
   <link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css" />

    <meta property="og:title" content="<?php echo $page_title; ?>"/>
    <meta property="og:image" content="<?php echo $result_row["lec_thumbnail"]; ?>"/>
    <meta property="og:site_name" content="Majalis-ul-Ilm |  Lecture Series by Shaykh-ul-Islam Dr. Muhammad Tahir-ul-Qadri"/>
    <meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-sidebar-closed">
   