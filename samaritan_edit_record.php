<?php
/**
 * Created by PhpStorm.
 * User: Shumail Mohy-ud-Din
 * Date: 12/14/2015
 * Time: 6:42 PM
 *
 * -- put check on ID
 */

// edit record page
$record_id = $_GET['id'];

include 'samaritan_header.php'; ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR MENU -->
    <?php include 'samaritan_sidebar.php'; ?>


    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">
                Edit Record <small> Update, Delete & more</small>
            </h3>
            <ul class="page-breadcrumb breadcrumb">
                <li class="btn-group">
                    <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                        <span>Data</span> <i class="icon-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Export to Excel</a></li>

                    </ul>
                </li>
                <li>
                    <i class="icon-home"></i>
                    <a href="#">Samaritan</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="samaritan.php">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="#">Edit Record</a></li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>

    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS -->
    <!-- END PAGE -->

    <!-- -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-globe"></i>Edit Record # <?php echo $record_id; ?></div>

                </div>
                <div class="portlet-body">
                //form to edit & update
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- -->
</div>
<!-- END CONTAINER -->
<?php include 'samaritan_footer.php'; ?>
<script type="text/javascript">
    $('#sidebar-edit-record').addClass('active');


</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js"></script>
<script src="assets/scripts/table-managed.js"></script>
<script src="assets/scripts/table-advanced.js"></script>

<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>
</body>
<!-- END BODY -->
</html>


