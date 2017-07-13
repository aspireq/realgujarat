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
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <h4 class="page-title"><?php echo $business->name; ?></h4> </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Business Detail</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box row">
                                <div class="user-bg"> <img alt="user" src="<?php echo base_url(); ?>include_files/banners/<?php echo $business->banner; ?>" width="100%">
                                    <div class="overlay-box">
                                        <div class="user-content">
                                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>include_files/logo/<?php echo $business->logo; ?>" class="thumb-lg img-circle" alt="img"></a>
                                            <h4 class="text-white">User Name</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="white-box row">
                                <h4><strong>Contact Detail:</strong></h4>
                                <hr/>
                                <p class="col-md-3 col-sm-6 col-xs-12"><b>Email : </b><span><?php echo $business->email; ?></span></p>
                                <p class="col-md-3 col-sm-6 col-xs-12"><b>Landline No : </b><span><?php echo $business->landline_no; ?></span></p>
                                <p class="col-md-3 col-sm-6 col-xs-12"><b>Mobile No : </b><span><?php echo $business->mobile_no; ?></span></p>
                                <p class="col-md-3 col-sm-6 col-xs-12"><b>Other No : </b><span><?php echo $business->other_no; ?></span></p>
                            </div>
                            <div class="white-box row">
                                <h4><strong>Basic Detail</strong></h4>
                                <hr/>
                                <div class="table-responsive">
                                    <table class="table table-condensed table-bordered">
                                        <tr>
                                            <td class="col-md-2 col-sm-3 col-xs-5"><b>Category : </b></td>
                                            <td colspan="2"><span><?php echo ($business->category_name != "") ? $business->category_name : 'N/A'; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-2 col-sm-3 col-xs-5"><b>Sub Category : </b></td>
                                            <td colspan="2"><span><?php echo ($business->subcategory_name != "") ? $business->subcategory_name : 'N/A'; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-2 col-sm-3 col-xs-5"><b>Address : </b></td>
                                            <td colspan="2"><?php echo ($business->address != null) ? $business->address : 'N/A'; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Pincode : </b><span><?php echo $business->pincode; ?></span></td>
                                            <td><b>State : </b><span><?php echo ($business->state_name != null) ? $business->state_name : 'N/A'; ?></span></td>
                                            <td><b>City : </b><span><?php echo ($business->city_name != null) ? $business->city_name : 'N/A'; ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="white-box row">
                                <h4><strong>Company Detail:</strong></h4>
                                <hr/>
                                <p><b><i class="fa fa-angle-double-right"></i>&nbsp;About Company :</b></p>
                                <p><?php echo $business->business_description; ?> </p>
                                <p><b><i class="fa fa-angle-double-right"></i>&nbsp;Services :</b></p>
                                <ul class="half clearfix">
                                    <li>Valet Parking</li>
                                    <li>Home Delivery</li>
                                    <li>AC</li>
                                    <li>Valet Parking</li>
                                    <li>Home Delivery</li>
                                    <li>AC</li>
                                    <li>Valet Parking</li>
                                    <li>Home Delivery</li>
                                    <li>AC</li>
                                </ul>
                                <p><b><i class="fa fa-angle-double-right"></i>&nbsp;Hours Of Operation:</b></p>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>Timing:</p>
                                    <?php
                                    $from_timings_1 = explode(',', $business->from_timings_1);
                                    $to_timings_1 = explode(',', $business->to_timings_1);
                                    $from_timings_2 = explode(',', $business->from_timings_2);
                                    $to_timings_2 = explode(',', $business->to_timings_2);
                                    $days = array(
                                        0 => 'Monday',
                                        1 => 'Tuesday',
                                        2 => 'Wednesday',
                                        3 => 'Thursday',
                                        4 => 'Friday',
                                        5 => 'Saturday',
                                        6 => 'Sunday');
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Days</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                
                                                <?php foreach ($days as $key => $day) { ?>
                                                    <tr>
                                                        <td><?php echo $day; ?></td>
                                                        <td><?php echo $from_timings_1[$key]; ?></td>
                                                        <td><?php echo $to_timings_1[$key]; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>Dual Timing:</p>
                                    <div class="table-responsive">
                                        <?php if(!empty($from_timings_2)) { ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Days</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($days as $key => $day) { ?>
                                                    <tr>
                                                        <td><?php echo $day; ?></td>
                                                        <td><?php echo $from_timings_2[$key]; ?></td>
                                                        <td><?php echo $to_timings_2[$key]; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php }else { echo 'N/A'; } ?>
                                    </div>
                                </div>
                                <p><b><i class="fa fa-angle-double-right"></i>&nbsp;Payment Modes Accepted:</b></p>
                                <p><?php echo ($business->payment_methods != null) ? $business->payment_methods : 'N/A'; ?></p>
                                <p><b><i class="fa fa-angle-double-right"></i>&nbsp;Product Rate:</b></p>
                                <p><?php echo ($business->min_price_range != '0.00') ? $business->min_price_range : 'N/A'; ?> to <?php echo ($business->max_price_range != '0.00') ? $business->max_price_range : 'N/A'; ?></p>
                            </div>
                            <div class="white-box row">
                                <h4><strong>Photos:</strong></h4>
                                <hr/>
                                <?php
                                if (!empty($business->company_images)) {
                                    foreach ($business->company_images as $image) {
                                        ?>
                                        <div class="col-md-2 col-sm-6 col-xs-6 photos">
                                            <img src="<?php echo base_url(); ?>include_files/business_images/<?php echo $image->image; ?>" alt="" class="img-responsive"/>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "No Images Available";
                                }
                                ?>
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
        <script src="<?php echo base_url(); ?>include_files/admin/js/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
        <script>
            $(function () {
                var myTable = $('#myTable').DataTable({
                    "bServerSide": true,
                    "sAjaxSource": "<?php echo base_url(); ?>auth_admin/get_categories",
                    "sServerMethod": "POST",
                    "info": false,
                    "fnServerParams":
                            function (aoData) {
                            },
                    "aaSorting": [[2, 'desc'], [1, 'desc']],
                    "iDisplayLength": 10,
                    "bStateSave": true,
                    "fnCreatedRow": function (nRow, aData, iDataIndex)
                    {
                        $(nRow).attr("uacc_id", aData.id);
                    },
                    aoColumnDefs: [
                        {
                            mData: 'name',
                            aTargets: [0]
                        },
                        {
                            mData: 'description',
                            aTargets: [1]
                        },
                        {
                            mData: 'created_date',
                            aTargets: [2]
                        }
                    ]
                });
            });
        </script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
        <!-- bt-switch -->
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js"></script>
        <script type="text/javascript">
            $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        </script>
    </body>
</html>