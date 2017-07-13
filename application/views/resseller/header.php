<div id="loginmodal" class="modal fade in" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content row">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Sign in to continue to <br> Real Gujarat</h4>
            </div>
            <div class="modal-body">
                <h1 class="text-center login-title"></h1>
                <div class="account-wall">
                    <img class="profile-img" src="<?php echo base_url(); ?>include_files/resseller/images/login.png" alt="">
                    <form class="form-signin" method="post" id="login" action="<?php echo base_url(); ?>reseller/login_via_ajax">
                        <div id="login_message">                            
                        </div>
                        <input type="text" class="form-control" placeholder="Email" required autofocus name="login_identity" id="login_identity">
                        <input type="password" class="form-control" placeholder="Password" required id="login_password" name="login_password">
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user" id="submit">
                            Sign in</button>
                        <input type="hidden" name="valid_login_url" id="valid_login_url" value="<?php echo base_url(); ?>auth_public"/>
                               <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me">
                            Remember me
                            </label>
<!--                            <a href="#forgotmodal" class="pull-right need-help" data-toggle="modal" data-dismiss="modal">Need help? </a><span class="clearfix"></span>-->
                        <a href="<?php echo base_url()?>reseller/forgotten_password" class="pull-right need-help">Forgot Password ? </a><span class="clearfix"></span>
                    </form>
                </div>
                <a href="<?php echo base_url(); ?>reseller/signup" class="text-center new-account">Create an account ? Register Now </a>
            </div>
        </div>
    </div>
</div>
<div id="forgotmodal" class="modal fade in" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content row">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Forgot Password?</h4>
            </div>
            <div class="modal-body">
                <h1 class="text-center login-title"></h1>
                <div class="account-wall">
                    <img class="profile-img" src="<?php echo base_url(); ?>include_files/resseller/images/login.png" alt="">
                    <form class="form-forgot" method="post" id="login" action="<?php echo base_url(); ?>reseller/login_via_ajax">
                        <div id="login_message">                            
                        </div>
                        <input type="password" class="form-control newpassword" placeholder="Password" required id="login_password" name="login_password">
                        <input type="password" class="form-control reenterpassword" placeholder="Re-Enter Password" required id="login_password" name="login_password">
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user" id="submit">
                            Update Password</button>
                    </form>
                </div>
                <a href="<?php echo base_url(); ?>reseller/signup" class="text-center new-account">Create an account ? Register Now </a>
            </div>
        </div>
    </div>
</div>
<!-- header-section-starts -->
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="<?php echo base_url(); ?>reseller"><img src="<?php echo base_url(); ?>include_files/resseller/images/logo.png" class="img-responsive" alt="" /></a>
        </div>
        <div class="header-right">
            <div class="row">
                <ul class="list-inline pull-right header-link">
                    <li>
                        <h4><i class="fa fa-phone red"></i> +91 9726634141</h4>
                    </li>
                    <?php
                    if ($this->flexi_auth->is_logged_in() && !empty($userinfo)) {
                        ?>                        
                        <li class="submitad"><a href="<?php echo base_url(); ?>reseller/account"><i class="fa fa-user"></i>&nbsp;Account</a></li>
                        <li class="login"><a href="<?php echo base_url(); ?>reseller/logout"><i class="fa fa-power-off"></i>&nbsp;Logout</a></li>
                    <?php } else { ?>
                        <li class="login" data-toggle="modal" data-target="#loginmodal"><a href="#"><i class="fa fa-sign-in"></i>&nbsp;Login</a></li>                        
                    <?php } ?>          
                </ul>
                 <?php /* if ($this->flexi_auth->is_logged_in() && !empty($userinfo)) { ?>
                    <div class="headernumber pull-right"><i class="fa fa-user red"></i> Hello <?php echo strtolower($userinfo['uacc_username']); ?> </div> 
                <?php }*/ ?>                
            </div>
            <div class="row" id="topbar-menu">
                <span class="menu"></span>
                <div class="top-menu">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>reseller">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>reseller/benefits">Reseller Benefits</a></li>
                        <li><a href="<?php echo base_url(); ?>reseller/earn">How TO Earn</a></li>
                        <li><a href="<?php echo base_url(); ?>reseller/register">How To Register</a></li>
                        <li><a href="<?php echo base_url(); ?>reseller/faqs">FAQ</a></li>
                        <li><a href="<?php echo base_url(); ?>reseller/contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <script>
                $("span.menu").click(function () {
                    $(".top-menu").slideToggle("slow", function () {
                    });
                });
            </script>            
        </div>
        <div class="clearfix"></div>
    </div>
</div>