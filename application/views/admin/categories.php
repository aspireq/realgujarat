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
                            <h4 class="page-title">Categories</h4> </div> 
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Categories</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if ($message != "") {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $message; ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="white-box">
                            <button class="fcbtn btn btn-success btn-outline btn-1d pull-right" onclick="window.location.href = '<?php echo base_url(); ?>auth_admin/add_categories'" >Add Category</button>                            
                            <div class="table-responsive">
                                <table class="table product-overview" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>                                            
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
                                            },
                                            {
                                                mData: '',
                                                aTargets: [3],
                                                mRender: function (data, type, full)
                                                {
                                                    var html = '<a href="<?php echo base_url(); ?>auth_admin/add_categories/' + full['id'] + '" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> '
                                                    html += '<a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                                                    return html;
                                                }
                                            }
                                        ]
                                    });
                                });
        </script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    </body>
</html>