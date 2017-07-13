<!DOCTYPE html>
<html>
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <?php echo $header; ?>
        <div class="container">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 form-container">
                <h3><i class="fa fa-recycle"></i>&nbsp;&nbsp;Reset Password</h3>
                <hr class="form-hr" />
                <?php
                if (is_numeric($this->session->flashdata('mail_sent'))) {
                    $message_status = 'alert-success';
                } else {
                    $message_status = 'alert-danger';
                }
                if ($message != "") {
                    ?>
                    <div class="alert <?php echo $message_status; ?> alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $message; ?>
                    </div>
                <?php } ?>
                <form class="form row" method="post" id="reset_password">                    
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-circle-o"></i></div>
                            <input type="password" class="form-control" placeholder="New Password" required autofocus name="new_password" id="new_password">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-circle-o"></i></div>
                            <input type="password" class="form-control" placeholder="Confirm Password" required autofocus name="confirm_new_password" id="confirm_new_password">
                        </div>
                    </div>                    
                    <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                        <button class="btn btn-primary btn-submit pull-right" type="submit">Submit&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <?php echo $footer; ?>
        <script src="<?php echo base_url(); ?>include_files/resseller/js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url(); ?>include_files/resseller/js/resseller.js"></script>   
        <script>
            $(document).ready(function () {
                $('#mobile_no, #landline_no').on('change keyup', function () {
                    var sanitized = $(this).val().replace(/[^-.0-9]/g, '');
                    sanitized = sanitized.replace(/(.)-+/g, '$1');
                    sanitized = sanitized.replace(/\.(?=.*\.)/g, '');
                    $(this).val(sanitized);
                });
            });
        </script>
    </body>
</html>