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
                            <h4 class="page-title">User Accounts</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Users</li>
                            </ol>
                        </div>                        
                    </div>
                    <div class="row">                        
                        <div class="white-box">
                            <input type="hidden" alt="alert" class="img-responsive model_img" id="payment_added">
                            <input type="hidden" alt="alert" class="img-responsive model_img" id="payment_failed">
                            <input type="hidden" alt="alert" class="img-responsive model_img" id="user_approved_success">
                            <input type="hidden" alt="alert" class="img-responsive model_img" id="suspend_user_success">
                            <div class="table-responsive">
                                <table class="table product-overview" id="myTable">
                                    <thead>
                                        <tr>                                            
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>Earnings</th>
                                            <th>IP Address</th>
                                            <th>Last Login</th>
                                            <th>Email Verified ?</th>
                                            <th>Add Payment</th>
                                            <th>Payments</th>
                                            <th>Status</th>
                                            <th>Suspended</th>
                                            <th>Remove Session</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>                
                    </div>
                    <?php echo $footer; ?>
                </div>            
            </div>
            <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Add Payment</h4>
                        </div>
                        <form method="post" id="add_user_payment" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="reseller_id" id="reseller_id">
                                <input type="hidden" name="edit_id" id="edit_id">
                                <div class="form-group">
                                    <label for="total_earnings" class="control-label">Earnings:</label>
                                    <input type="text" class="form-control" id="total_earnings" name="total_earnings" readonly="">
                                </div>
                                <div class="form-group">
                                    <label class="payment_date">Payment Date:</label>
                                    <input type="text" class="form-control" id="payment_date" name='payment_date' placeholder="mm/dd/yyyy">                                
                                </div>
                                <div class="form-group">
                                    <label class="payment_mode">Payment Mode:</label>                                
                                    <select class="form-control" name="payment_mode" id="payment_mode">
                                        <option value="">Select Payment Mode</option>                                  
                                        <option value="Cheque">Cheque</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Bitcoin">Bitcoin</option>                           
                                    </select>
                                </div>
                                <div id="additional_fields">
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount:</label>
                                    <input type="text" class="form-control" id="amount" name="amount" onblur="calculate_amount();">
                                </div>
                                <div class="form-group">
                                    <label class="tax_method">Tax :</label>
                                    <select class="form-control" name="tax_method" id="tax_method" onchange="calculate_amount();">
                                        <option value="0">Expemted</option>
                                        <option value="15">15 %</option>
                                        <option value="10">10 %</option>                           
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nettamount" class="control-label">Net Amount:</label>
                                    <input type="text" class="form-control" id="nettamount" name="nettamount" readonly="">
                                </div>
                                <input type="hidden" name="final_amount" id="final_amount">
                                <div class="form-group">
                                    <label for="payment_description" class="control-label">Description :</label>
                                    <textarea class="form-control" id="payment_description" name="payment_description"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">                                
                                <button type="submit" class="btn btn-danger waves-effect waves-light" name="submit_form" id="submit_form">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="payment_history" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel">Payment History</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table product-overview" id="payment_table">
                                    <thead>
                                        <tr>                                            
                                            <th>Payment Date</th>
                                            <th>Payment Mode</th>
                                            <th>Cheque No.</th>
                                            <th>Trasaction Id</th>
                                            <th>Amount</th>
                                            <th>Tax</th>
                                            <th>Net Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="approve_modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Approve User</h4>
                        </div>
                        <form method="post" id="approve_user">
                            <input type="hidden" name="approving_user" id="approving_user">
                            <div class="modal-body">
                                <h4>Are you sure want to activate this user </h4>                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" name="approve" id="approve" onclick="approve_user();">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="suspend_modal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Suspend User</h4>
                        </div>
                        <form method="post" id="suspend_user">
                            <input type="hidden" name="suspending_user" id="suspending_user">
                            <div class="modal-body">
                                <h4 id="suspend_msg"></h4>                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" name="suspend" id="suspend" onclick="suspend_user_confirm();">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/jquery.validate.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/forms.jquery.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/jquery.slimscroll.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/waves.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/custom.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/jQuery.dataTables.reloadAjax.js"></script>
            <script>
                                    var myTable = "";
                                    $(function () {
                                        $('#payment_added').click(function () {
                                            swal("", "Payment information saved Successfully!");
                                        });
                                        $('#payment_failed').click(function () {
                                            swal("", "Something went wrong! Please try again later..");
                                        });
                                        $('#user_approved_success').click(function () {
                                            swal("", "User approved Successfully!");
                                        });
                                        $('#suspend_user_success').click(function () {
                                            swal("", "Suspend status saved Successfully!");
                                        });
                                        $('#payment_date').datepicker({
                                            autoclose: true,
                                            format: 'yyyy-mm-dd',
                                            todayHighlight: true
                                        });
                                        $('#payment_mode').change(function () {
                                            var mode = $('#payment_mode').val();
                                            $('#additional_fields').empty();
                                            if (mode == "Cheque") {
                                                $('#additional_fields').html('<div class="form-group"><label for="chequeno" class="control-label">Cheque No.:</label><input type="text" class="form-control" id="chequeno" name="chequeno"></div>');
                                            } else if (mode == "Bitcoin") {
                                                $('#additional_fields').html('<div class="form-group"><label for="transaction_id" class="control-label">Transaction Id:</label><input type="text" class="form-control" id="transaction_id" name="transaction_id"></div>');
                                            } else if (mode == "Bank Transfer") {
                                                $('#additional_fields').html('<div class="form-group"><label for="bank_transaction_id" class="control-label">Transaction Id:</label><input type="text" class="form-control" id="bank_transaction_id" name="bank_transaction_id"></div>');
                                            }
                                        });
                                        $("#add_user_payment").submit(function () {
                                        }).validate({
                                            rules: {
                                                payment_date: "required",
                                                payment_mode: {required: true},
                                                amount: {
                                                    required: true,
                                                    number: true,
                                                    min: 5,
                                                    max: function () {
                                                        return $("#total_earnings").val()
                                                    }
                                                },
                                                chequeno: {
                                                    required: {
                                                        depends: function (element) {
                                                            return ($('#payment_mode').val() == 'Cheque');
                                                        }
                                                    }
                                                },
                                                transaction_id: {
                                                    required: {
                                                        depends: function (element) {
                                                            return ($('#payment_mode').val() == 'Bitcoin');
                                                        }
                                                    }
                                                },
                                                bank_transaction_id: {
                                                    required: {
                                                        depends: function (element) {
                                                            return ($('#payment_mode').val() == 'Bank Transfer');
                                                        }
                                                    }
                                                },
                                            }, messages: {
                                                amount: {
                                                    max: "You can not make payment greater than user earnings",
                                                    min: "Minimum amount for payment is 5.0",
                                                }
                                            },
                                            success: function (element) {
                                                element.closest('.form-group').removeClass('has-error');
                                                element.closest('.form-group label').remove();
                                            },
                                            highlight: function (element) {
                                                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                                            },
                                            submitHandler: function (form) {
                                                calculate_amount();
                                                $('#submit_form').attr('disabled', true);
                                                $('#submit_form').text('Please Wait...');
                                                $.ajax({
                                                    url: "<?php echo base_url(); ?>auth_admin/add_payment/",
                                                    type: "POST",
                                                    data: $('#add_user_payment').serialize(),
                                                    dataType: "JSON",
                                                    success: function (response)
                                                    {
                                                        if (response == true) {
                                                            $("#payment_added").trigger('click');
                                                            $('#responsive-modal').modal('hide');
                                                            myTable.ajax.reload(null, false);
                                                        } else {
                                                            $("#payment_failed").trigger('click');
                                                        }
                                                        $('#submit_form').attr('disabled', false);
                                                        $('#submit_form').text('Submit');
                                                        reload_table();
                                                    }
                                                });
                                            }
                                        });
                                        myTable = $('#myTable').DataTable({
                                            "bServerSide": true,
                                            "sAjaxSource": "<?php echo base_url(); ?>auth_admin/get_user_account",
                                            "sServerMethod": "POST",
                                            "info": false,
                                            "fnServerParams":
                                                    function (aoData) {
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
                                                    mData: 'uacc_username',
                                                    aTargets: [0]
                                                },
                                                {
                                                    mData: 'uacc_email',
                                                    aTargets: [1]
                                                },
                                                {
                                                    mData: 'mobile_no',
                                                    aTargets: [2]
                                                },
                                                {
                                                    mData: 'earnings',
                                                    aTargets: [3]
                                                },
                                                {
                                                    mData: 'uacc_ip_address',
                                                    aTargets: [4]
                                                },
                                                {
                                                    mData: 'uacc_date_last_login',
                                                    aTargets: [5]
                                                },
                                                {
                                                    mData: '',
                                                    aTargets: [6],
                                                    mRender: function (data, type, full)
                                                    {
                                                        if (full['uacc_active'] !== '0') {
                                                            var html = '<span class="label label-success font-weight-100">Verified</span>';
                                                            return html;
                                                        } else {
                                                            var html = '<span class="label label-danger font-weight-100">Not Verified</span>';
                                                            return html;
                                                        }
                                                    }
                                                },
                                                {
                                                    mData: '',
                                                    aTargets: [7],
                                                    mRender: function (data, type, full)
                                                    {
                                                        if (full['earnings'] != null) {
                                                            var html = '<a onClick="add_payment(' + full['uacc_id'] + ')" class="btn btn-info fcbtn btn-outline btn-1d">Add Payment</a>';
                                                            return html;
                                                        } else {
                                                            var html = '';
                                                            return html;
                                                        }
                                                    }
                                                },
                                                {
                                                    mData: '',
                                                    aTargets: [8],
                                                    mRender: function (data, type, full)
                                                    {
                                                        var html = '<a onClick="payment_history(' + full['uacc_id'] + ')" class="btn btn-info fcbtn btn-outline btn-1d">Payment History</a>';
                                                        return html;
                                                    }
                                                },
                                                {
                                                    mData: '',
                                                    aTargets: [9],
                                                    mRender: function (data, type, full)
                                                    {
                                                        if (full['uacc_admin_approved'] == 1) {
                                                            var html = '<span class="label label-success font-weight-100">Approved</span>'
                                                            return html;
                                                        } else {
                                                            var html = '<div class="onoffswitch2"><input type="checkbox" onClick="user_status(' + full['uacc_id'] + ')" name="pending' + full['uacc_id'] + '" class="onoffswitch2-checkbox" id="pending' + full['uacc_id'] + '"><label class="onoffswitch2-label" for="pending' + full['uacc_id'] + '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div>';
                                                            return html;
                                                        }
                                                    }
                                                },
                                                {
                                                    mData: '',
                                                    aTargets: [10],
                                                    mRender: function (data, type, full)
                                                    {
                                                        if (full['uacc_suspend'] == 1) {
                                                            var html = '<div class="onoffswitch2"><input type="checkbox" onClick="suspend_user(' + full['uacc_id'] + ')" name="suspend' + full['uacc_id'] + '" class="onoffswitch2-checkbox" id="suspend' + full['uacc_id'] + '" checked><label class="onoffswitch2-label" for="suspend' + full['uacc_id'] + '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div>';
                                                            return html;
                                                        } else {
                                                            var html = '<div class="onoffswitch2"><input type="checkbox" onClick="suspend_user(' + full['uacc_id'] + ')" name="suspend' + full['uacc_id'] + '" class="onoffswitch2-checkbox" id="suspend' + full['uacc_id'] + '"><label class="onoffswitch2-label" for="suspend' + full['uacc_id'] + '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div>';
                                                            return html;
                                                        }
                                                    }
                                                },
                                                {
                                                    mData: '',
                                                    aTargets: [11],
                                                    mRender: function (data, type, full)
                                                    {
                                                        if (full['is_login'] == 0) {
                                                            var html = '<span class="label label-success font-weight-100">No Active Login</span>'
                                                            return html;
                                                        } else {
                                                            var html = '<div class="onoffswitch2"><input type="checkbox" onClick="user_sessions(' + full['uacc_id'] + ')" name="pending' + full['uacc_id'] + '" class="onoffswitch2-checkbox" id="pending' + full['uacc_id'] + '"><label class="onoffswitch2-label" for="pending' + full['uacc_id'] + '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div>';
                                                            return html;
                                                        }
                                                    }
                                                }
                                            ]
                                        });
                                    });
                                    function reload_table() {
                                        myTable.ajax.reload(null, false);
                                    }
                                    function user_sessions(id) {
                                        var x;
                                        if (confirm("Are you sure you want remove previous session for this user") == true) {
                                            x = "ok";
                                        } else {
                                            x = "cancel";
                                        }
                                        if (x == "ok") {
                                            $.ajax({
                                                url: "<?php echo base_url(); ?>auth_admin/user_session/",
                                                type: "POST",
                                                data: {id: id},
                                                dataType: "JSON",
                                                success: function (data)
                                                {
                                                    alert('Session Removed successfully!');
                                                }
                                            });
                                        }
                                        reload_table();
                                    }
                                    function approve_user() {
                                        var user_id = $('#approving_user').val();
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>auth_admin/approve_user",
                                            type: "POST",
                                            data: {user_id: user_id},
                                            dataType: "JSON",
                                            success: function (response)
                                            {
                                                if (response == true) {
                                                    $("#user_approved_success").trigger('click');
                                                    $('#approve_modal').modal('hide');
                                                } else {
                                                    $("#payment_failed").trigger('click');
                                                }
                                                reload_table();
                                            }
                                        });
                                    }
                                    function suspend_user_confirm() {
                                        var user_id = $('#suspending_user').val();
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>auth_admin/suspend_user",
                                            type: "POST",
                                            data: {user_id: user_id},
                                            dataType: "JSON",
                                            success: function (response)
                                            {
                                                if (response == true) {
                                                    $("#suspend_user_success").trigger('click');
                                                    $('#suspend_modal').modal('hide');
                                                } else {
                                                    $("#payment_failed").trigger('click');
                                                }
                                                reload_table();
                                            }
                                        });
                                    }
            </script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
            <script>
                                    function user_status(user_id) {
                                        $('#approve_user')[0].reset();
                                        $('#approving_user').val(user_id);
                                        $('#approve_modal').modal('show');
                                    }

                                    function suspend_user(user_id) {
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>auth/get_record/",
                                            type: "POST",
                                            data: {id: user_id, table_coloum: 'uacc_id', table_name: 'user_accounts'},
                                            dataType: "JSON",
                                            success: function (data)
                                            {
                                                if (data.uacc_suspend == 1) {
                                                    $('#suspend_msg').text('Are you sure want to activated this user');
                                                } else {
                                                    $('#suspend_msg').text('Are you sure want to suspend this user');
                                                }
                                                $('#suspend_user')[0].reset();
                                                $('#suspending_user').val(user_id);
                                                $('#suspend_modal').modal('show');
                                            }
                                        });
                                    }

                                    function add_payment(user_id) {
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>auth_admin/get_userearnings/",
                                            type: "POST",
                                            data: {user_id: user_id},
                                            dataType: "JSON",
                                            success: function (data)
                                            {
                                                $('.error').remove();
                                                $('.form-group').removeClass('has-error');
                                                $('#add_user_payment')[0].reset();
                                                $('#responsive-modal').modal('show');
                                                $('#total_earnings').val(data.earnings);
                                                $('#reseller_id').val(data.uacc_id);
                                            }
                                        });
                                    }
            </script>
            <script type="text/javascript">
                var isfirsttime = 0;
                var payment_table;
                function payment_history(user_id)
                {
                    $('#payment_history').modal('show');
                    var payment_tableurl = "<?php echo base_url(); ?>auth_admin/get_payments/" + user_id;
                    if (isfirsttime == '0')
                    {
                        payment_table = $('#payment_table').DataTable({
                            "bServerSide": true,
                            "sAjaxSource": payment_tableurl,
                            "sServerMethod": "POST",
                            "info": false,
                            "fnServerParams":
                                    function (aoData) {
                                    },
                            "aaSorting": [0, 'desc'],
                            "iDisplayLength": 5,
                            aoColumnDefs: [
                                {
                                    mData: 'date',
                                    aTargets: [0]
                                },
                                {
                                    mData: 'payment_method',
                                    aTargets: [1]
                                },
                                {
                                    mData: 'chequeno',
                                    aTargets: [2]
                                },
                                {
                                    mData: 'transaction_id',
                                    aTargets: [3]
                                },
                                {
                                    mData: 'amount',
                                    aTargets: [4]
                                },
                                {
                                    mData: '',
                                    aTargets: [5],
                                    mRender: function (data, type, full)
                                    {
                                        if (full['tax'] != null) {
                                            var html = full['tax'] + '%';
                                            return html;
                                        } else {
                                            var html = '';
                                            return html;
                                        }
                                    }
                                },
                                {
                                    mData: 'netamount',
                                    aTargets: [6]
                                },
                                {
                                    mData: '',
                                    aTargets: [7],
                                    mRender: function (data, type, full)
                                    {
                                        var html = '<a onClick="edit_payment(' + full['id'] + ')" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a> '
                                        //html += '<a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                                        return html;
                                    }
                                }
                            ]
                        });
                        isfirsttime = 1;
                    } else
                    {
                        payment_table.ajax.url(payment_tableurl).load();
                    }
                }
                function calculate_amount() {
                    var tax_method = $('#tax_method').val();
                    var amount = $('#amount').val();
                    if (tax_method != 0) {
                        var calulated_amount = amount - ((amount * tax_method) / 100);
                        $('#nettamount').val(calulated_amount);
                        $('#final_amount').val(calulated_amount);
                    } else {
                        $('#nettamount').val(amount);
                        $('#final_amount').val(amount);
                    }
                }
                function edit_payment(id) {
                    $('#payment_history').modal('hide');
                    $('body').addClass('modal-open');
                    $.ajax({
                        url: "<?php echo base_url(); ?>auth/get_record/",
                        type: "POST",
                        data: {id: id, table_coloum: 'id', table_name: 'reseller_payments'},
                        dataType: "JSON",
                        success: function (data)
                        {
                            $('.error').remove();
                            $('.form-group').removeClass('has-error');
                            $('#add_user_payment')[0].reset();
                            $('#total_earnings').val(data.earnings);
                            $('#reseller_id').val(data.user_id);
                            $('#payment_date').val(data.date);
                            $('#amount').val(data.amount);
                            $('#nettamount').val(data.netamount);
                            $('#final_amount').val(data.netamount);
                            $('#payment_description').val(data.description);
                            $('select[id="payment_mode"]').find('option:contains(' + data.payment_method + ')').attr("selected", true);
                            if (data.tax !== '0') {
                                $('select[id="tax_method"]').find('option:contains(' + data.tax + ')').attr("selected", true);
                            }
                            $('#payment_mode').trigger("change");
                            if (data.chequeno !== null) {
                                $('#chequeno').val(data.chequeno);
                            } else if (data.bank_transaction_id !== null) {
                                $('#bank_transaction_id').val(data.bank_transaction_id);
                            } else if (data.transaction_id !== null) {
                                $('#transaction_id').val(data.transaction_id);
                            }
                            $('#edit_id').val(data.id);
                            $('#responsive-modal').modal('show');
                            if ($('#responsive-modal').css('display') == 'none') {
                                // alert(true);
                                $('body').addClass('modal-open');
                            }
                        }
                    });
                }
            </script>
    </body>
</html>
