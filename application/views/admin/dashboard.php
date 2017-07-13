<!DOCTYPE html>  
<html lang="en">
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">          
            <?php echo $header; ?>
            <?php echo $sidebar; ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">                            
                            <ol class="breadcrumb">                                
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="ti-user text-info"></i> User Accounts</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->total_users; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="ti-timer text-warning"></i> Pending Businesses</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->pending_business; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="fa fa-check-circle text-success"></i> Approved Businesses</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->approved_business; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="fa fa-folder text-danger"></i> Categories</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->total_categories; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="fa fa-folder-open text-info"></i> Sub Categories</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->total_subcategories; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="fa fa-users text-warning"></i> Visitors</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->total_visitors; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="fa fa-tag text-success"></i> Visitor's ADs</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->total_visitor_adds; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title"><i class="fa fa-money"></i> Payments</h3>
                                <div class="text-right">
                                    <h1 class="counter"><?php echo $dashboard_data->reseller_payments; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
                <?php echo $footer; ?>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/raphael/raphael-min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/morrisjs/morris.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/dashboard1.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
        
    </body>
</html>