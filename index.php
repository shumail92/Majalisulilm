
<?php include 'header.php'; ?>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">

         <!-- BEGIN SIDEBAR MENU -->
<?php include 'sidebar.php'; ?>

         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div class="page-content">
         <!-- BEGIN PAGE HEADER-->
         <div class="row">
            <div class="col-md-4">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <br><h1 class="page-title">
                  <b>Majalis-ul-ilm </b><br><small>Lecture Series by Dr. Muhammad Tahir ul Qadri</small>
               </h1>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
            <div class="col-md-8 pull-right">
              <img class="pull-right" src="red.png" width="100%" />
            </div>
         </div>
         <!-- END PAGE HEADER-->
         
         <?php 
           $sql = "SELECT * from videos_detail";
           $result = $mysqli->query($sql);
         ?>


         <!-- BEGIN DASHBOARD STATS -->
         <div class="row ">
            <div class="col-md-5 col-sm-5">
               <div class="portlet box red">
                  <div class="portlet-title" style="background-color: #B80000 !important;">
                     <div class="caption"><i class="icon-bell"></i>Series Archive</div>
                  </div>
                  <div class="portlet-body">
                     <div class="scroller" style="height: 600px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">

                        <?php
                        $class = "";
                          while($row = $result->fetch_assoc()) {
                            if($vid == $row["serial_no"]) {
                              $class = "green";
                            } else {
                              $class = "dark";
                            }
                        ?>
                        <li>
                              <a href="?vid=<?php echo $row["serial_no"]; ?>">
                               <div id="vid_<?php echo $row["serial_no"];?>" class="tile double bg-<?php echo $class; ?>" style="width: 100% !important;">
                                 <div class="tile-body">
                                    <img width="75px"  height="75px" src="<?php echo $row["lec_thumbnail"]; ?>" alt="">
                                    <h4 style="line-height: 20px !important;"><?php echo $row["lec_title"]; ?></h4>
                                    <p>
                                       <?php echo $row["short_desc"]; ?>
                                    </p>
                                 </div>
                                 <div class="tile-object">
                                    <div class="name">																		<?php 									$live_flag_text = "";									if($row["live_flag"] == 0) {										$live_flag_text ="Live Version";
									} else if($row["live_flag"] == 1) {										$live_flag_text ="English Subtitles";
									}																		?>
                                       <span class="label label-sm label-danger" style="background-color:#B80000 !important;">Lecture # <b><?php echo $row["serial_no"]; ?></b></span>&nbsp;&nbsp;&nbsp;<span class="label label-sm label-info"><?php echo $live_flag_text; ?></span>
                                    </div>
                                    <div class="number">
                                       <?php echo $row["lec_date"]; ?>
                                    </div>
                                 </div>
                                </div>

                              </a>
                           </li>

                        <?php
                        }

                        ?>

                        </ul>
                     </div>
                     <div class="scroller-footer">
                        <div class="pull-right">
                           <a href="#">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-7 col-sm-7">
               <div class="row">
               <div class="col-md-12 col-sm-12">
                 <div class="portlet box green tabbable">
                    <div class="portlet-title">
                       <div class="caption"><i class="icon-reorder"></i>Lecture Video</div>
                    </div>
                    <div class="portlet-body">
                       <div class="tabbable portlet-tabs">
                          <ul class="nav nav-tabs">

                            <?php 
                              $vimeo_video_flag = false;
                              $youtube_video_flag = false;
                              $playit_video_flag = false;
                              $sc_audio_flag = false;

                             $sql2 = "SELECT * from videos_detail where serial_no = $vid";
                             $result2 = $mysqli->query($sql2);
                              if($result2) {
                                $row = $result2->fetch_assoc();
                                
                                if($row["vimeo_link"] !=""  ) { //if vimeo is present
                                  $vimeo_video_flag = true;
                                }


                                //soundcloud audio
                                if($row["soundcloud_link"] != ""  ) {
                                  echo "<li><a href='#portlet_tab_4' data-toggle='tab'>Audio</a></li>";
                                  $sc_audio_flag = true;
                                }

                                //Playit video
                                if($row["playit_link"] !=""  ) {
                                  echo "<li><a href='#portlet_tab_3' data-toggle='tab'>Playit</a></li>";
                                  $playit_video_flag = true;
                                }

                                //youtube video
                                if($row["youtube_link"] !="" ) {
                                  $classvar = "";
                                  if(!$vimeo_video_flag) {  //if no vimeo video present
                                    $classvar = "class='active'";
                                  } 
                                  echo "<li $classvar><a href='#portlet_tab_2' data-toggle='tab'>Youtube</a></li>";
                                  $youtube_video_flag = true;
                                }

                                //vimeo
                                if($row["vimeo_link"] !=""  ) {
                                  echo "<li class='active'><a href='#portlet_tab_1' data-toggle='tab'>Vimeo</a></li>";
                                  $vimeo_video_flag = true;
                                }

                              }

                            ?>


                          </ul>
                          <div class="tab-content">
                          
                            <?php 

                            if($vimeo_video_flag) { ?>
                            
                            <div class="tab-pane active" id="portlet_tab_1">
                                  <iframe src="https://player.vimeo.com/video/<?php echo $row["vimeo_link"]; ?>?title=0&byline=0&portrait=0" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                                  </iframe>


                                  
                            </div>
                            <?php } ?>

                            <?php if($youtube_video_flag) { 

                              if (!$vimeo_video_flag) {  //if no vimeo video present
                                    $classvar = "active";
                                } else {
                                    $classvar = "";
                                }
                            ?>
                            <div class="tab-pane <?php echo $classvar; ?>" id="portlet_tab_2">
                                  <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $row["youtube_link"];?>?rel=0" frameborder="0" allowfullscreen>                                    
                                  </iframe>
                            </div>
                            <?php } ?>

                            <?php if($playit_video_flag) { ?>
                            
                            <div class="tab-pane" id="portlet_tab_3">
                                <div class="videoWrapper" style="position: relative; padding-bottom: 56.25%; /* 16:9 */ padding-top: 25px; height: 0;">
                                    <iframe src="http://playit.pk/embed/<?php echo $row["playit_link"]; ?>&logo=false&download=true" scrolling="NO" frameborder="0" style="overflow:hidden;border: 0px;position: absolute;top: 0;left: 0;width: 100%;height: 100%;" webkitallowfullscreen mozallowfullscreen allowfullscreen>      
                                    </iframe>
                                </div>  
                            </div>
                            <?php } ?>

                            <?php if($sc_audio_flag) { ?>
                            
                            <div class="tab-pane" id="portlet_tab_4">
                                  <?php echo $row["soundcloud_link"]; ?> 
                            </div>
                            <?php } ?>
                             
                             
                          </div>
                       </div>
                    </div>
                 </div>
                 </div>
               </div> 
               <div class="row">
                 <div class="col-md-12 col-sm-6">
                   <!-- BEGIN Portlet PORTLET-->
               <div class="portlet box grey">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-reorder"></i>Lecture Notes:</div>
                     <div class="actions">
                        <a href="#" class="btn red btn-sm"><i class="icon-pencil"></i> Download PDF</a>
                     </div>
                  </div>
                  <div class="portlet-body">
                     <div class="scroller" style="height: 150px;" data-always-visible="1" data-rail-visible="0">
                        <p><?php echo $row["lec_notes"]; ?><br/></p>
                        Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
                        consectetur Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
                        consecteturpurus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
                     </div>
                  </div>
               </div>
               <!-- END Portlet PORTLET-->

                 </div>
               </div>           
            </div>
        </div>
         
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
  $('#sidebar-dashboard').addClass('active');
$('#sidebar-dashboard > a').append('<span class="selected"></span>');
</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js" type="text/javascript"></script>
<script src="assets/scripts/index.js" type="text/javascript"></script>
<script src="assets/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
   jQuery(document).ready(function() {
      App.init(); // initlayout and core plugins
      Index.init();
      Index.initMiniCharts();
      $('.easy-pie-chart-reload').click();

   });
</script>
<!-- END JAVASCRIPTS -->



</body>
<!-- END BODY -->
</html>
