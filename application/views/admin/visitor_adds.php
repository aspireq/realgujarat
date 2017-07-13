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
                            <h4 class="page-title">Visitors</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Visitors</li>
                            </ol>
                        </div>                        
                    </div>
                    <div class="row">                                         
                        <div class="white-box">                                         
                            <div class="table-responsive">
                                <table class="table product-overview" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>                                         
                                            <th>Contact No.</th>
                                            <th>Is Verified</th>
                                            <th>Advetize Added</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div>
            <?php echo $footer; ?>
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
        <script src="<?php echo base_url(); ?>include_files/admin/js/jQuery.dataTables.reloadAjax.js"></script>
        <!-- bt-switch -->
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js"></script>
        <script>
            var myTable = "";
            $(function () {
                myTable = $('#myTable').DataTable({
                    "bServerSide": true,
                    "sAjaxSource": "<?php echo base_url(); ?>auth_admin/get_visitors",
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
                            mData: 'company_name',
                            aTargets: [0]
                        },
                        {
                            mData: 'contact_no',
                            aTargets: [1]
                        },
                        {
                            mData: '',
                            aTargets: [2],
                            mRender: function (data, type, full)
                            {
                                if (full['is_verified'] == 1) {
                                    var html = '<span class="label label-success font-weight-100">Approved</span>'
                                    return html;
                                } else {
                                    var html = '<span class="label label-danger font-weight-100">No</span>'
                                    return html;
                                }
                            }
                        },
                        {
                            mData: '',
                            aTargets: [3],
                            mRender: function (data, type, full)
                            {
                                if (full['advertize_added'] == 1) {
                                    var html = '<span class="label label-success font-weight-100">Added</span>'
                                    return html;
                                } else {
                                    var html = '<span class="label label-danger font-weight-100">No</span>'
                                    return html;
                                }
                            }
                        },
                    ]
                });
            });
            $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
            var radioswitch = function () {
                var bt = function () {
                    $(".radio-switch").on("switch-change", function () {
                        $(".radio-switch").bootstrapSwitch("toggleRadioState")
                    }),
                            $(".radio-switch").on("switch-change", function () {
                        $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                    }),
                            $(".radio-switch").on("switch-change", function () {
                        $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                    })
                };
                return {
                    init: function () {
                        bt()
                    }
                }
            }();
            $(document).ready(function () {
                radioswitch.init()
            });
            function business_status(id) {
                var x;
                if (confirm("Are you sure you want approve this business") == true) {
                    x = "ok";
                } else {
                    x = "cancel";
                }
                if (x == "ok") {
                    $.ajax({
                        url: "<?php echo base_url(); ?>auth_admin/business_status/",
                        type: "POST",
                        data: {id: id},
                        dataType: "JSON",
                        success: function (data)
                        {
                            alert('Business approved successfully!');
                        }
                    });
                }
                reload_table();
            }
            function reload_table() {
                myTable.ajax.reload(null, false);
            }
        </script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    </body>
</html>