<!DOCTYPE html>
<html>
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <?php echo $header; ?>        
        <div class="banner">
            <div class="container-fluid">
                <div class="row">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="<?php echo base_url(); ?>include_files/resseller/images/slider1.jpg" alt="First slide" class="img-responsive">
                                <div class="carousel-caption">
                                    <h3><i>Work From Home</i></h3>
                                </div>
                            </div>
                            <div class="item">
                                <img src="<?php echo base_url(); ?>include_files/resseller/images/slider2.jpg" alt="Second slide" class="img-responsive">
                                <div class="carousel-caption">
                                    <h3><i>Work In Your Spare Time</i></h3>
                                </div>
                            </div>
                            <div class="item">
                                <img src="<?php echo base_url(); ?>include_files/resseller/images/slider3.jpg" alt="Third slide" class="img-responsive">
                                <div class="carousel-caption">
                                    <h3><i>Join Us Now</i></h3>
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control"
                                                                                     href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
                            </span></a>
                    </div>
                    <div class="main-text hidden-xs hidden-sm">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <h1>Work In Your Spare Time</h1>
                            <h3>
                                Our services are fully managed and we view ourselves as IT department of our company
                            </h3>
                            <?php
                            if ($this->flexi_auth->is_logged_in() && !empty($userinfo)) {
                                
                            } else {
                                ?>
                                <div class="btn-login">
                                    <a href="#" data-toggle="modal" data-target="#loginmodal">Login</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="services-section">
                <div class="container">
                    <center>
                        <h3>Hello and welcome to <span class="highlight-text">Realgujarat Reseller Panel</span> , a Strong Earning Source !!</h3>
                    </center>
                    <div class="services-section-grids">
                        <div class="col-md-4 col-sm-4 col-xs-12 services-section-grid1">
                            <div class="services-section-grid1-top">
                                <h4>Online Data Entry</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                <div class="icons">
                                    <div class="icon-left">
                                        <i class="call"></i>
                                    </div>
                                    <div class="icon-right">
                                        <a href="<?php echo base_url(); ?>reseller/benefits"><i class="arrow arrow1"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="services-section-grid1-bottom">
                                <h4>Blog Writing work</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                <div class="icons">
                                    <div class="icon-left">
                                        <i class="callmsg"></i>
                                    </div>
                                    <div class="icon-right">
                                        <a href="<?php echo base_url(); ?>reseller/benefits"><i class="arrow arrow2"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 services-section-grid2">
                            <h4>Form Filling Entry</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer </p>
                            <div class="icons icons2">
                                <div class="icon-left">
                                    <i class="interact"></i>
                                </div>
                                <div class="icon-right">
                                    <a href="<?php echo base_url(); ?>reseller/benefits"><i class="arrow arrow3"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 services-section-grid3">
                            <div class="services-section-grid3-top">
                                <h4>Ad Posting work</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                <div class="icons">
                                    <div class="icon-left">
                                        <i class="dt"></i>
                                    </div>
                                    <div class="icon-right">
                                        <a href="<?php echo base_url(); ?>reseller/benefits"><i class="arrow arrow4"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="services-section-grid3-bottom">
                                <h4>More Services</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                <div class="icons">
                                    <div class="icon-left">
                                        <i class="zoom"></i>
                                    </div>
                                    <div class="icon-right">
                                        <a href="<?php echo base_url(); ?>reseller/benefits"><i class="arrow arrow5"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="subscribe-section">
                <div class="container">
                    <div class="subscribe-section-grids">
                        <div class="col-md-8 col-sm-8 col-xs-12 subscribe">
                            <h3>Might need to know</h3>
                            <h4>
                                Realgujarat.com is an Gujarat's First Web Portal for Youth which contains eductaion & entertainment both at one Go. 
                                <!-- Realgujarat.com is an Sister Consern of Aspire Webservices Pvt. Ltd which came into exesitance in June 2012. -->
                            </h4>
                            <form>
                                <div class="form-group col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="enter email">
                                        <div class="input-group-addon">
                                            <button class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 book">
                            <img src="<?php echo base_url(); ?>include_files/resseller/images/book.png" alt="" class="img-responsive">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="our-clients">
                <div class="container">
                    <div class="our-clients-head text-center">
                        <h3>Our Clients</h3>
                    </div>
                    <!---strat-image-cursuals---->
                    <div class="scroll-slider">
                        <div class="nbs-flexisel-container">
                            <div class="nbs-flexisel-inner">
                                <ul class="flexiselDemo3 nbs-flexisel-ul" style="left: -253.6px; display: block;">
                                    <li><img src="<?php echo base_url(); ?>include_files/resseller/images/c1.jpg"></li>
                                    <li><img src="<?php echo base_url(); ?>include_files/resseller/images/c2.jpg"></li>
                                    <li><img src="<?php echo base_url(); ?>include_files/resseller/images/c3.jpg"></li>
                                    <li><img src="<?php echo base_url(); ?>include_files/resseller/images/c4.jpg"></li>
                                </ul>
                                <div class="nbs-flexisel-nav-left" style="display:none"></div>
                                <div class="nbs-flexisel-nav-right" style="display:none"></div>
                            </div>
                        </div>
                        <div class="clear"> </div>
                        <!---strat-image-cursuals---->
                        <script type="text/javascript" src="<?php echo base_url(); ?>include_files/resseller/js/jquery.flexisel.js"></script>
                        <!---End-image-cursuals---->
                        <script type="text/javascript">
                            $(window).load(function () {
                                $(".flexiselDemo3").flexisel({
                                    visibleItems: 4,
                                    animationSpeed: 1000,
                                    autoPlay: true,
                                    autoPlaySpeed: 3000,
                                    pauseOnHover: true,
                                    enableResponsiveBreakpoints: true,
                                    responsiveBreakpoints: {
                                        portrait: {
                                            changePoint: 480,
                                            visibleItems: 1
                                        },
                                        landscape: {
                                            changePoint: 640,
                                            visibleItems: 2
                                        },
                                        tablet: {
                                            changePoint: 768,
                                            visibleItems: 3
                                        }
                                    }
                                });
                            });
                        </script>                        
                    </div>
                </div>
            </div>
        </div>
        <?php echo $footer; ?>
        <script src="<?php echo base_url(); ?>include_files/resseller/js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url(); ?>include_files/resseller/js/resseller.js"></script>        
    </body>
</html>