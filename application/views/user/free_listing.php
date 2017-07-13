<?php echo $header; ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>include_files/user/plugin/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>include_files/user/plugin/taginput/css/bootstrap-tagsinput.css">
<link href="<?php echo base_url(); ?>include_files/user/plugin/imageupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>include_files/user/plugin/imageupload/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 p-r-0">
                <div class="form-container">
                    <h3><i class="fa fa-cube"></i>&nbsp;&nbsp;<strong>Free Listings</strong></h3>
                    <hr class="form-hr" />
                    <?php if ($message != "") { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>
                    <?php if ($confirmation_code == "") { ?>
                        <form role="form" action="" method="post" enctype="multipart/form-data" id="verification_form">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="control-label">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                        <input type="text" class="form-control" data-placeholder="Company Name" name="company_name" id="company_name" value="<?php echo (!empty($visitorinfo) && $visitorinfo['company_name'] != "") ? $visitorinfo['company_name'] : ''; ?>">
                                    </div>    
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label">First Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" data-placeholder="First Name" name="first_name" id="first_name" value="<?php echo (!empty($visitorinfo) && $visitorinfo['first_name'] != "") ? $visitorinfo['first_name'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label">Last Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" data-placeholder="Last Name" name="last_name" id="last_name" value="<?php echo (!empty($visitorinfo) && $visitorinfo['last_name'] != "") ? $visitorinfo['last_name'] : ''; ?>">
                                    </div>    
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="control-label">Mobile No.</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control" data-placeholder="Mobile No." name="mobile_no" id="mobile_no" minlength="10" maxlength="10" value="<?php echo (!empty($visitorinfo) && $visitorinfo['mobile_no'] != "") ? $visitorinfo['mobile_no'] : ''; ?>">
                                    </div>    
                                </div>
                                <div class="col-md-12">                                
                                    <button class="btn btn-success pull-right" type="submit" name="verification" id="verification" value="verification">Receive Confirmation Code&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="form-title">Write Confirmation Code</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-check-circle"></i></div>
                                        <input type="text" class="form-control" data-placeholder="Confimration Code" name="confirmation_code" id="confirmation_code">
                                    </div>   
                                </div>
                                <input type="hidden" name="code" id="code" value="<?php echo $confirmation_code; ?>">
                                <div class="col-md-12 col-sm-12 col-xs-12">                                
                                    <button class="btn btn-success pull-right" type="submit" name="verified" id="verified" value="verified">Submit Ad&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>  
<script src="<?php echo base_url(); ?>include_files/user/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>include_files/user/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>include_files/user/js/review.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>include_files/user/js/lightbox.js"></script>
<script src="<?php echo base_url(); ?>include_files/user/plugin/imageupload/js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>include_files/user/plugin/imageupload/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>include_files/user/plugin/imageupload/themes/explorer/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>include_files/user/plugin/select2/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>include_files/user/plugin/taginput/js/bootstrap-tagsinput.js"></script>
<script src="<?php echo base_url(); ?>include_files/user/js/classie.js"></script>
<script src="<?php echo base_url(); ?>include_files/user/js/zeroGravity.js"></script>
<script src="<?php echo base_url(); ?>include_files/user/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#myCarousel').carousel({
            interval: 4000
        });
        var clickEvent = false;
        $('#myCarousel').on('click', '.nav a', function () {
            clickEvent = true;
            $('.nav li').removeClass('active');
            $(this).parent().addClass('active');
        }).on('slid.bs.carousel', function (e) {
            if (!clickEvent) {
                var count = $('.nav').children().length - 1;
                var current = $('.nav li.active');
                current.removeClass('active').next().addClass('active');
                var id = parseInt(current.data('slide-to'));
                if (count == id) {
                    $('.nav li').first().addClass('active');
                }
            }
            clickEvent = false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideDown("400");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideUp("400");
                    $(this).toggleClass('open');
                }
        );
    });
</script>
</body>
</html>