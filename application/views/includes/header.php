<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-5 col-sm-5">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>include_files/img/logo.png" alt="Bit Barrister" title="Bit Barrister" class="img-responsive logo" width="150"/></a>
            </div>
            <div class="col-md-9 col-xs-7 col-sm-7 text-right p-xs-0">
                <ul class="list-inline header-link">
                    <?php if (!$this->flexi_auth->is_logged_in() && empty($userinfo)) { ?>
                        <li class="text-center login" data-toggle="modal" data-target="#myModal">
                            <a href="<?php echo base_url(); ?>signin" ><img src="<?php echo base_url(); ?>include_files/img/login.png" /><span class="block">Login</span></a>
                        </li>
                        <li class="text-center register" data-toggle="modal" data-target="#myModal1">
                            <a href="<?php echo base_url(); ?>register" ><img src="<?php echo base_url(); ?>include_files/img/register.png" /><span class="block">Register</span></a>
                        </li>
                    <?php } else { ?>
                        <li class="text-center register">
                            <a href="<?php echo base_url();?>auth/member" ><img src="<?php echo base_url(); ?>include_files/img/account.png" /><span class="block">Account</span></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</header>
<nav class="navbar navbar-default" data-spy="affix" data-offset-top="94">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <form class="navbar-form hidden-sm hidden-md hidden-lg form-xs" role="search" action="/" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control searchbox" placeholder="Search.."/>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="button">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="link1"><a href="<?php echo base_url(); ?>home">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>aboutus">About Us</a></li>
                    <li><a href="<?php echo base_url(); ?>investment">Investment package</a></li>
                    <li><a href="<?php echo base_url(); ?>affiliate">Affiliate Program</a></li>
                    <li><a href="<?php echo base_url(); ?>security">Security Advice</a></li>
                    <li><a href="<?php echo base_url(); ?>help">Help Center</a></li>
                    <li><a href="<?php echo base_url(); ?>contactus">Contact us</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <form class="navbar-form hidden-sm hidden-md hidden-xs" role="search" action="/" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control searchbox" placeholder="Search.."/>
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="button">Search</button>
                            </span>
                        </div>
                    </form>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</nav>