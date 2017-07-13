<!DOCTYPE html>
<html>
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <?php echo $header; ?>
        <div class="content">
            <div class="contact about-desc">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 contact_left">
                            <h4>We Want to hear from you</h4>
                            <p class="m_6">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla</p>
                            <p class="m_7">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <div class="contact_grid contact_address">
                                <div class="contact-section text-center">
                                    <div class="contact-top row">
                                        <div class="col-md-4 col-sm-4 col-xs-12 contact-section-grid text-center">
                                            <i class="smartphone"></i>
                                            <p>Phone : +91 9726634141</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 contact-section-grid text-center">
                                            <i class="user"></i>
                                            <p>2nd, Satyam Complex</p>
                                            <p>Ahmedabad- 380008</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 contact-section-grid text-center">
                                            <i class="global"></i>
                                            <p><a href="mail-to:Support@yourname.com">reseller@realgujarat.com</a></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact_right">
                                <div class="contact-form_grid">
                                    <form method="post" action="#">
                                        <input type="text" class="textbox" value="Your name" onfocus="this.value = '';" onblur="if (this.value == '') {
                                          this.value = 'Your name';
                                      }">
                                        <input type="text" class="textbox" value="Your email" onfocus="this.value = '';" onblur="if (this.value == '') {
                                          this.value = 'Your email';}">
                                        <input type="text" class="textbox" value="Website" onfocus="this.value = '';" onblur="if (this.value == '') {
                                          this.value = 'Website';}">
                                        <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {
                                          this.value = 'Message';
                                      }">Message</textarea>
                                        <input type="submit" value="Send" class="btn btn-danger pull-right">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="map s-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d117531.79651527292!2d72.5479055!3d22.9918574!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e85e7cf7c0c03%3A0x2a837aa338024f9!2sAspire+Webservices+Pvt+Ltd!5e0!3m2!1sen!2sin!4v1484045854560" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <div class="map-layer"></div>
    </div>
<?php echo $footer; ?>
<script src="<?php echo base_url(); ?>include_files/resseller/js/bootstrap.min.js"></script>        
<script src="<?php echo base_url(); ?>include_files/resseller/js/resseller.js"></script>
</body>
</html>