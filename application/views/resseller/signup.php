<?php
if ($_GET['ref'] != "") {
    $reffrence_link = base_url() . 'reseller/signup?ref=' . $_GET['ref'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <?php echo $header; ?>
        <div class="container">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 form-container">
                <h3><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Register Now</h3>
                <hr class="form-hr" />
                <?php
                if (is_numeric($this->session->flashdata('inserted_user_id'))) {
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
                <form class="form row" method="post" id="signup" action="<?php echo base_url(); ?>reseller/signup">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control" placeholder="First Name" required="" autofocus="" name="first_name" id="first_name" value="<?php echo (!empty($user_data)) ? $user_data['first_name'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control" placeholder="Last Name" required="" autofocus name="last_name" id="last_name" value="<?php echo (!empty($user_data)) ? $user_data['last_name'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-circle-o"></i></div>
                            <input type="text" class="form-control" placeholder="Username" required="" autofocus name="register_username" id="register_username" value="<?php echo (!empty($user_data)) ? $user_data['register_username'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input type="email" class="form-control" placeholder="Email" required="" name="register_email_address" id="register_email_address" value="<?php echo (!empty($user_data)) ? $user_data['register_email_address'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-unlock-alt"></i></div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="passwordmain" id="passwordmain">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                            <input type="password" class="form-control" placeholder="Re Enter Password" required="" name="inputPasswordConfirm" id="inputPasswordConfirm">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            <input type="text" class="form-control" placeholder="Landline No." name="landline_no" id="landline_no" value="<?php echo (!empty($user_data)) ? $user_data['landline_no'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                            <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" id="mobile_no" maxlength="10"  required autofocus value="<?php echo (!empty($user_data)) ? $user_data['mobile_no'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-link"></i></div>
                            <input type="text" class="form-control" placeholder="Reffrence Link" name="reffrence_link" id="reffrence_link" value="<?php echo ($reffrence_link != "") ? $reffrence_link : "" ?>" readonly="">
                        </div>
                    </div>
                    <input type="hidden" id="user_type" name="user_type" value="2"/>
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
            $("#register_username").on("keydown", function (e) {
                return e.which !== 32;
            });
        </script>
    </body>
</html>