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
                            <h4 class="page-title">Businesses</h4> </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Businesses</li>
                            </ol>
                        </div>                        
                    </div>
                    <div class="row">                                   
                        <div class="white-box">
                            <button class="fcbtn btn btn-success btn-outline btn-1d pull-right" onclick="window.location.href = '<?php echo base_url(); ?>auth_admin/add_business'" >Add Business</button>                            
                            <div class="table-responsive">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <input type="checkbox" class="search_business" id="approved_business" name="approved_business" value="1">
                                    <label for="approved_business">Approved</label>
                                    <input type="checkbox" class="search_business" id="rejected_business" name="rejected_business" value="1">                                    
                                    <label for="rejected_business">Rejected</label>
                                    <input type="checkbox" class="search_business" id="pending_business" name="pending_business" value="1" >
                                    <label for="pending_business">Pending</label>                                    
                                </div>
                                <table class="table product-overview" id="myTable">
                                    <thead>
                                        <tr> 
                                            <th>Transaction Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>Other No.</th>
                                            <th>Contact Person</th>
                                            <th>Website</th>
                                            <th>Addded Date</th>
                                            <th>Is Approved</th>
                                            <th>Is Rejected</th>
                                            <th>Detail ?</th>
                                            <th>Action</th>
                                            <th>Earnings</th>
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
        <div id="earning_history_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Business Earnings</h4>
                    </div>
                    <form method="post" id="add_user_payment" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table-striped" id="tblGrid">
                                <thead id="tblHead">
                                    <tr>
                                        <th>Verified On</th>
                                        <th class="text-right">Rs.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>Company Name</td>
                                        <td class="text-right" id="verified_company_name">

                                        </td>
                                    </tr>
                                    <tr><td>Address</td>
                                        <td class="text-right" id="verified_address">

                                        </td>
                                    </tr>
                                    <tr><td>Category & Subcategory</td>
                                        <td class="text-right" id="verified_category">

                                        </td>
                                    </tr>
                                    <tr><td>Email</td>
                                        <td class="text-right" id="verified_email">

                                        </td>
                                    </tr>
                                    <tr><td>Mobile No.</td>
                                        <td class="text-right" id="verified_mobileno">

                                        </td>
                                    </tr>
                                    <tr><td>Landline No.</td>
                                        <td class="text-right" id="verified_landline">

                                        </td>
                                    </tr>
                                    <tr><td>Establishment Year</td>
                                        <td class="text-right" id="verified_estalishment">

                                        </td>
                                    </tr>
                                    <tr><td>About Us</td>
                                        <td class="text-right" id="verified_aboutus">

                                        </td>
                                    </tr>
                                    <tr><td>Services</td>
                                        <td class="text-right" id="verified_services">

                                        </td>
                                    </tr>
                                    <tr><td>Location</td>
                                        <td class="text-right" id="verified_location">

                                        </td>
                                    </tr>
                                    <tr><td>Hours of Operation</td>
                                        <td class="text-right" id="verified_hours">

                                        </td>
                                    </tr>
                                    <tr><td>Photographs</td>
                                        <td class="text-right" id="verified_photos">

                                        </td>
                                    </tr>
                                    <tr><td>Extra Incentive</td>
                                        <td class="text-right" id="verified_incentive">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
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
        <script src="<?php echo base_url(); ?>include_files/admin/js/jQuery.dataTables.reloadAjax.js"></script>        
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
        <script>
                                $(document).ready(function () {
                                    $(".search_business").change(function () {
                                        reload_table();
                                    });
                                });
                                var myTable = "";
                                $(function () {
                                    myTable = $('#myTable').DataTable({
                                        "bServerSide": true,
                                        "sAjaxSource": "<?php echo base_url(); ?>auth_admin/get_business",
                                        "sServerMethod": "POST",
                                        "info": false,
                                        "fnServerParams":
                                                function (aoData) {
                                                    aoData.push({"name": "approved_business", "value": ($("#approved_business").is(':checked')) ? 1 : 0},
                                                            {"name": "rejected_business", "value": ($("#rejected_business").is(':checked')) ? 1 : 0},
                                                            {"name": "pending_business", "value": ($("#pending_business").is(':checked')) ? 1 : 0});
                                                },
                                        "aaSorting": [4, 'desc'],
                                        "iDisplayLength": 10,
                                        "bStateSave": true,
                                        "fnCreatedRow": function (nRow, aData, iDataIndex)
                                        {
                                            $(nRow).attr("uacc_id", aData.id);
                                        },
                                        aoColumnDefs: [
                                            {
                                                mData: 'transaction_id',
                                                aTargets: [0]
                                            },
                                            {
                                                mData: 'name',
                                                aTargets: [1]
                                            },
                                            {
                                                mData: 'email',
                                                aTargets: [2]
                                            },
                                            {
                                                mData: 'mobile_no',
                                                aTargets: [3]
                                            },
                                            {
                                                mData: 'other_no',
                                                aTargets: [4]
                                            },
                                            {
                                                mData: 'contact_person_name',
                                                aTargets: [5]
                                            },
                                            {
                                                mData: 'website',
                                                aTargets: [6]
                                            },
                                            {
                                                mData: 'created_date',
                                                aTargets: [7]
                                            },
                                            {
                                                mData: '',
                                                aTargets: [8],
                                                mRender: function (data, type, full)
                                                {
                                                    if (full['is_approved'] == 1) {
                                                        var html = '<span class="label label-success font-weight-100">Approved</span>'
                                                        return html;
                                                    } else if (full['is_approved'] == 2) {
                                                        var html = '<span class="label label-success font-weight-100">Rejected</span>'
                                                        return html;
                                                    } else {
                                                        var html = '<div class="onoffswitch2"><input type="checkbox" onClick="business_status(' + full['id'] + ')" name="pending' + full['id'] + '" class="onoffswitch2-checkbox" id="pending' + full['id'] + '"><label class="onoffswitch2-label" for="pending' + full['id'] + '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div>';
                                                        return html;
                                                    }
                                                }
                                            },
                                            {
                                                mData: '',
                                                aTargets: [9],
                                                mRender: function (data, type, full)
                                                {
                                                    if (full['is_approved'] == 2) {
                                                        var html = '<span class="label label-success font-weight-100">Rejected</span>'
                                                        return html;
                                                    } else if (full['is_approved'] == 1) {
                                                        var html = '<span class="label label-success font-weight-100">Approved</span>'
                                                        return html;
                                                    } else if (full['is_approved'] == 0) {
                                                        var html = '<div class="onoffswitch2"><input type="checkbox" onClick="reject_status(' + full['id'] + ')" name="pending1' + full['id'] + '" class="onoffswitch2-checkbox" id="pending1' + full['id'] + '"><label class="onoffswitch2-label" for="pending1' + full['id'] + '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div>';
                                                        return html;
                                                    }
                                                }
                                            },
                                            {
                                                mData: '',
                                                aTargets: [10],
                                                mRender: function (data, type, full)
                                                {
                                                    var html = '<a href="<?php echo base_url(); ?>auth_admin/business_detail/' + full['id'] + '" class="btn btn-info fcbtn btn-outline btn-1d">View More</a>';
                                                    return html;
                                                }
                                            },
                                            {
                                                mData: '',
                                                aTargets: [11],
                                                mRender: function (data, type, full)
                                                {
                                                    var html = '<a href="<?php echo base_url(); ?>auth_admin/add_business/' + full['id'] + '" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a>      ';
                                                    html += '<a onClick="delete_business(' + full['id'] + ')" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                                                    return html;
                                                }
                                            },
                                            {
                                                mData: '',
                                                aTargets: [12],
                                                mRender: function (data, type, full)
                                                {
                                                    var html = '<a onClick="earning_history(' + full['id'] + ')" class="text-inverse p-r-10" data-toggle="tooltip" title="Earnings"><i class="ti-marker-alt"></i></a>';
                                                    return html;
                                                }
                                            }
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
                                function reject_status(id) {
                                    var x;
                                    if (confirm("Are you sure you want reject this business") == true) {
                                        x = "ok";
                                    } else {
                                        x = "cancel";
                                    }
                                    if (x == "ok") {
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>auth_admin/reject_status/",
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
                                function delete_business(id) {
                                    var x;
                                    if (confirm("Are you sure you want delete this business") == true) {
                                        x = "ok";
                                    } else {
                                        x = "cancel";
                                    }
                                    if (x == "ok") {
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>auth_admin/delete_business/",
                                            type: "POST",
                                            data: {id: id},
                                            dataType: "JSON",
                                            success: function (data)
                                            {
                                                alert('Business deleted successfully!');
                                            }
                                        });
                                    }
                                    reload_table();
                                }
                                function reload_table() {
                                    myTable.ajax.reload(null, false);
                                }
                                function earning_history(id) {
                                    $.ajax({
                                        url: "<?php echo base_url(); ?>auth/get_businessinfo/",
                                        type: "POST",
                                        data: {id: id},
                                        dataType: "JSON",
                                        success: function (data)
                                        {
                                            if (data.status == true) {
                                                $('#earning_history_modal').modal('show');
                                                (data.earninginfo.company_name == 1) ? $('#verified_company_name').text('1') : $('#verified_company_name').text('0');
                                                (data.earninginfo.address == 1) ? $('#verified_address').text('1') : $('#verified_address').text('0');
                                                (data.earninginfo.email == 1) ? $('#verified_email').text('1') : $('#verified_email').text('0');
                                                (data.earninginfo.category_subcategory == 1) ? $('#verified_category').text('1') : $('#verified_category').text('0');
                                                (data.earninginfo.mobile == 1) ? $('#verified_mobileno').text('1') : $('#verified_mobileno').text('0');
                                                (data.earninginfo.landline == 1) ? $('#verified_landline').text('1') : $('#verified_landline').text('0');
                                                (data.earninginfo.establishment_year == 1) ? $('#verified_estalishment').text('1') : $('#verified_estalishment').text('0');
                                                (data.earninginfo.aboutus == 1) ? $('#verified_aboutus').text('3') : $('#verified_aboutus').text('0');
                                                (data.earninginfo.services == 1) ? $('#verified_services').text('1') : $('#verified_services').text('0');
                                                (data.earninginfo.otherlocation == 1) ? $('#verified_location').text('1') : $('#verified_location').text('0');
                                                (data.earninginfo.hours == 1) ? $('#verified_hours').text('2') : $('#verified_hours').text('0');
                                                (data.earninginfo.photos == 1) ? $('#verified_photos').text('7') : $('#verified_photos').text('0');
                                                (data.earninginfo.extra_incentive == 1) ? $('#verified_incentive').text('5') : $('#verified_incentive').text('0');
                                            } else {
                                                alert('No Earning Information Available');
                                            }
                                        }
                                    });
                                }
        </script>        
    </body>
</html>