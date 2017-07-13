<?php echo $header; ?>
<link href="<?php echo base_url(); ?>include_files/user/css/checkbox.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>include_files/user/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>include_files/user/css/lightbox.css" />
<style>
    .companybg{
        background:url('<?php echo base_url(); ?>include_files/banners/<?php echo ($business->banner != "" && (file_exists(FCPATH . 'include_files/banners/' . $business->banner))) ? $business->banner : 'detailbg.png' ?>')no-repeat;
        background-size: cover;
    }
</style>
<section> 
    <div id="sms" class="modal fade in" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content row">
                <div class="modal-header custom-modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Get information by SMS/Email</h4>
                </div>
                <div class="modal-body">
                    <form name="info_form" action="#" method="post">
                        <input type="hidden" name="business_id" id="business_id" value="<?php echo $business->id; ?>">
                               <span class="input input--chisato">
                            <input class="input__field input__field--chisato" type="text" id="info_name" name="info_name" />
                            <label class="input__label input__label--chisato" for="input-13">
                                <span class="input__label-content input__label-content--chisato" data-content="Enter Name"><i class="fa fa-user"></i> Enter Name</span>
                            </label>
                        </span>
                        <span class="input input--chisato">
                            <input class="input__field input__field--chisato" type="email" id="info_email" name="info_email" />
                            <label class="input__label input__label--chisato" for="input-13">
                                <span class="input__label-content input__label-content--chisato" data-content="Enter Email"><i class="fa fa-envelope"></i> Enter Email</span>
                            </label>
                        </span>
                        <span class="input input--chisato">
                            <input class="input__field input__field--chisato" type="text" id="info_mobile" name="info_mobile" />
                            <label class="input__label input__label--chisato" for="input-13">
                                <span class="input__label-content input__label-content--chisato" data-content="Enter Mobile"><i class="fa fa-phone"></i> Enter phone</span>
                            </label>
                        </span>
                        <div class="col-sm-12 col-xs-12 col-md-12 gap">
                            <button type="button" name="send_info" id="send_info" class="cart-button center-block">SEND <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="share" class="modal fade in" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content row">
                <div class="modal-header custom-modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Share With</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-inline sharelist">
                        <li class="facebook-wrapper">
                            <a href="#">
                                <i class="fa fa-facebook-official"></i><br>
                                <span>Facebook</span>
                            </a>
                        </li>
                        <li class="twitter-wrapper">
                            <a href="#">
                                <i class="fa fa-twitter"></i><br>
                                <span>Twitter</span>
                            </a>
                        </li>
                        <li class="google-wrapper">
                            <a href="#">
                                <i class="fa fa-google-plus"></i><br>
                                <span>Google Plus</span>
                            </a>
                        </li>
                        <li class="whatsapp-wrapper">
                            <a href="#">
                                <i class="fa fa-whatsapp"></i><br>
                                <span>Whats app</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="editdetail" class="modal fade in" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content row">
                <div class="modal-header custom-modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Help Us Improve This Detail</h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><a href="#">Report as inaccurate</a></li>
                        <li><a href="#">Edit / Modify this business</a></li>
                        <li><a href="#">Upload Photos</a></li>
                        <li><a href="#">Remove My Listing</a></li>
                        <li><a href="#">Own This</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid companybg p-0">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <h2 class="detailpage-title"><?php echo $business->name; ?></h2>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="pull-right">
                            <h2><i class="fa fa-phone"></i> <?php
                                $mobile_no = ($business->mobile_code != "") ? '+(' . $business->mobile_code . ')-' : '';
                                echo $mobile_no . $business->mobile_no;
                                ?></h2>
                            <ul class="list-inline pull-right">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($total_ratings < $i) {
                                        echo '<li><i class="fa fa-star-o"></i></li>';
                                    } else {
                                        echo '<li><i class="fa fa-star"></i></li>';
                                    }
                                }
                                ?>
                                <li class="rating"><span><?php echo $total_ratings . '.0'; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container detail-content">
        <div class="row wrapper cf">
            <div class="col-md-3 col-sm-3 col-xs-12 p-0">
                <div class="detail-left col-md-12 col-xs-12 view_more">
                    <?php if ($business->business_description != null) { ?>
                        <h4>About</h4>
                        <?php
                        $string = strip_tags($business->business_description);
                        if (strlen($string) > 300) {
                            $stringCut = substr($string, 0, 300);
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a style="cursor:pointer;" onclick="view_info();">View More</a>';
                        }
                        ?>
                        <p id="business_desc"><?php echo $string; ?></p>
                        <?php
                    }
                    ?>
                    <?php
                    if ($business->year_establishment != null) {
                        ?>

                        <h4>Year Established</h4>
                        <p><?php echo ($business->year_establishment != null ) ? $business->year_establishment : 'N/A'; ?> </p>
                    <?php } ?>
                    <br/>
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/address.png" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Address</h4>
                            <address>
                                <?php echo ($business->address != null) ? $business->address:'';?>
                                <?php echo ($business->city != 0)?','.$business->city_name:'';?>
                                <?php echo ($business->state != 0)?','.$business->state_name:'';?>
                                <?php echo ($business->pincode != 0)?','.$business->pincode:'';?>
                            </address>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/phone.png" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Contact</h4>
                            <?php
                            $mobile_no = ($business->mobile_code != "") ? '+(' . $business->mobile_code . ')-' : '';
                            $landline_code = ($business->landline_code != "") ? '+ (' . $business->landline_code . ')-' : '';
                            $other_code = ($business->other_code != "") ? '+(' . $business->other_code . ')-' : '';
                            echo ($business->mobile_no != 0) ? '<p>' . $mobile_no . $business->mobile_no . '</p>' : '';
                            echo ($business->landline_no != 0) ? '<p>' . $landline_code . $business->landline_no . '</p>' : '';
                            echo ($business->other_no != 0) ? '<p>' . $other_code . $business->other_no . '</p>' : '';
                            ?>
                        </div>
                    </div>
                    <?php if ($business->min_price_range != 0.00 && $business->max_price_range != 0.00) { ?>
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="#">
                                    <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/rate.png" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Rate</h4>
                                <p><i class="fa fa-inr"></i> <?php echo $business->min_price_range; ?> to <i class="fa fa-inr"></i> <?php echo $business->max_price_range; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($business->payment_methods != "") { ?>
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="#">
                                    <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/credit-card.png" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Mode of Payment</h4>
                                <?php
                                $payment_types = explode(',', $business->payment_methods);
                                foreach ($payment_types as $payment_type) {
                                    echo '<p>' . $payment_type . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>                    
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/clock.png" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Hours of Operation</h4>

                            <div id="hours_of_opeation">
                                <?php
                                $days = array(
                                    0 => 'Monday',
                                    1 => 'Tuesday',
                                    2 => 'Wednesday',
                                    3 => 'Thursday',
                                    4 => 'Friday',
                                    5 => 'Saturday',
                                    6 => 'Sunday');
                                $from_timings_1 = explode(',', $business->from_timings_1);
                                $to_timings_1 = explode(',', $business->to_timings_1);
                                $from_timings_2 = explode(',', $business->from_timings_2);
                                $to_timings_2 = explode(',', $business->to_timings_2);
                                foreach ($days as $key => $day) {
                                    if (date('l', strtotime(date('Y-m-d'))) == $day) {
                                        echo '<p>' . $day . ':  ' . $from_timings_1[$key] . ' - ' . $to_timings_1[$key];
                                        if (!empty($from_timings_2[0])) {
                                            echo ' || ' . $from_timings_2[$key] . ' - ' . $to_timings_2[$key];
                                        }
                                        echo '</p>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="hours_display" id="hours_display" onclick="show_timings(<?php echo $business->id; ?>);">
                                <label for="hours_display" id="hours_display_lable">View All</label>
                            </div>
                        </div>
                    </div>
                    <?php
                    $keywords = explode(',', $business->keywords);
                    if (!empty($keywords[0])) {
                        ?>
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="#">
                                    <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/phone.png" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Also Listed In</h4>
                                <?php
                                foreach ($keywords as $keyword) {
                                    echo '<p>' . $keyword . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    $other_locations = explode(',', $business->other_locations);
                    if (!empty($other_locations[0])) {
                        ?>
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="#">
                                    <img class="media-object" src="<?php echo base_url(); ?>include_files/user/img/detail/phone.png" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Other Locations</h4>
                                <?php
                                foreach ($other_locations as $other_location) {
                                    echo '<p>' . $other_location . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 m-15">
                    <img src="<?php echo base_url(); ?>include_files/user/img/adbanner1.png" class="img-responsive" alt="ad"/>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12" id="middle-content">
                <div class="col-md-12 col-sm-12 col-xs-12 detail-center">
                    <h3>Services</h3>
                    <hr>
                    <ul class="list service-list">
                        <?php
                        if ($business->services != "") {
                            $services = explode(',', $business->services);
                            foreach ($services as $service) {
                                ?>
                                <li>
                                    <i class="fa fa-check-circle"></i> <span><?php echo $service; ?></span>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 detail-center m-15">
                    <h3>Photos</h3>
                    <hr>                  
                    <?php
                    if (!empty($business->company_images)) {
                        foreach ($business->company_images as $key => $image) {
                            if ((file_exists(FCPATH . 'include_files/business_images/' . $image->image))) {
                                if ($key < 4) {
                                    ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <a href='<?php echo base_url(); ?>include_files/business_images/<?php echo $image->image; ?>'
                                           class='fresco'
                                           data-fresco-group='example'
                                           data-fresco-caption="<?php echo $business->name; ?>">
                                            <img src='<?php echo base_url(); ?>include_files/business_images/<?php echo $image->image; ?>' alt='' class="img-responsive img" alt="business-image"/>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    } else {
                        echo 'No Photos Available';
                    }
                    ?>
                    <p class="pull-right col-md-12 col-sm-12 col-xs-12 text-right">Total Photos (<?php echo count($business->company_images); ?>) <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> View All</a></p>
                    <div class="collapse" id="collapseExample">
                        <div class="well row">
                            <?php
                            foreach ($business->company_images as $key => $image) {
                                if ((file_exists(FCPATH . 'include_files/business_images/' . $image->image))) {
                                    if ($key > 3) {
                                        ?>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <a href='<?php echo base_url(); ?>include_files/business_images/<?php echo $image->image; ?>'
                                               class='fresco'
                                               data-fresco-group='example'
                                               data-fresco-caption="<?php echo $business->name; ?>">
                                                <img src='<?php echo base_url(); ?>include_files/business_images/<?php echo $image->image; ?>' alt='' class="img-responsive img"/>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 closephoto">
                                <i class="fa fa-chevron-up"></i> Close Photo Gallery
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 detail-center m-15 review">
                    <h3>Review</h3>
                    <hr>
                    <?php
                    if (!empty($results)) {
                        array_pop($results);
                        foreach ($results as $data) {
                            ?>
                            <div class="row">
                                <div class="col-md-2 col-sm-3 col-xs-4">
                                    <img src="<?php echo base_url(); ?>include_files/user/img/r3.png" class="img-responsive img-circle img-thumbnail" />
                                </div>
                                <div class="col-md-10 col-sm-9 col-xs-8">
                                    <div class="review-title row">
                                        <h4 class="col-md-7 col-sm-12 col-xs-12"><?php echo $data->name; ?></h4>
                                        <div class="col-md-5 col-sm-12 col-xs-12">
                                            <ul class="list-inline pull-right">                                                
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($data->rating < $i) {
                                                        echo '<li><i class="fa fa-star-o"></i></li>';
                                                    } else {
                                                        echo '<li><i class="fa fa-star"></i></li>';
                                                    }
                                                }
                                                ?>
                                                <li class="rating"><span><?php echo $data->rating; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p><?php echo $data->review; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        No Reviews Available
                    <?php }
                    ?>
                    <div class = "row">
                        <div class = "col-md-12">
                            <nav aria-label = "Page navigation">
                                <ul class = "pagination pull-right">
                                    <?php
                                    foreach ($links as $key => $link) {
                                        echo "<li>" . $link . "</li>";
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="well well-sm p-0">
                        <div class="text-right">
                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Give your Review And Rating</a>
                        </div>
                        <div class="row" id="post-review-box" style="display:none;">
                            <div class="col-md-12">
                                <form accept-charset="UTF-8" action="" method="post">
                                    <input id="ratings-hidden" name="rating" type="hidden">
                                    <input type="text" name="name" id="name" class="form-control animated" placeholder="Enter your name">
                                    <input type="hidden" name="business_id" id="business_id" value="<?php echo $business->id; ?>">
                                    <input type="hidden" name="rating_value" id="rating_value">
                                    <br>
                                    <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                    <div class="text-right">
                                        <div class="stars starrr" data-rating="0"></div>
                                        <a class="btn btn-danger btn-sm cancel-btn" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                            Cancel</a>
                                        <button class="btn btn-success cart-button" type="button" name="add_review" id="add_review">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 detail-right">
                <ul class="list action-list">
                    <li data-toggle="modal" data-target="#sms">
                        <img src="<?php echo base_url(); ?>include_files/user/img/detail/sms.png" alt="SMS"/>
                        <span>SMS / E-mail</span>
                    </li>
                    <li data-toggle="modal" data-target="#share">
                        <img src="<?php echo base_url(); ?>include_files/user/img/detail/share.png" alt="Share"/>
                        <span onclick="send_information()">Share</span>
                    </li>
                    <li>
                        <img src="<?php echo base_url(); ?>include_files/user/img/detail/address.png" alt="address"/>
                        <span><a target="_blank" href="<?php echo base_url(); ?>auth/map/<?php echo $business->id; ?>">Map</a></span>
                    </li>
                    <li data-toggle="modal" data-target="#editdetail">
                        <img src="<?php echo base_url(); ?>include_files/user/img/detail/edit.png" alt="edit"/>
                        <span>Edit This</span>
                    </li>
                    <li>
                        <img src="<?php echo base_url(); ?>include_files/user/img/detail/varyfied.png" alt="varyfied"/>
                        <span>Varified</span>
                    </li>
                </ul>
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUtuwvvgzEjpbGtnBpi-94V9auHIa_n1M&callback=initMap">
</script>
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
<script>
    $(document).ready(function () {
        $("#rat_busine").click(function () {
            $(this).attr('data-rating', 2);
            var rating = $('.stars starrr .stars starrr-on').length;
            return false;
        });
        $("#add_review").click(function () {
            var rating = $('#rating_value').val();
            var name = $('#name').val();
            var review = $('#new-review').val();
            var business_id = $('#business_id').val();
            if (name == "") {
                alert('Please enter name to submit review');
                return false;
            } else if (review == "") {
                alert('Please write something');
                return false;
            } else if (rating == 0) {
                alert('Please select ratings');
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>auth/add_review/",
                    type: "POST",
                    data: {name: name, review: review, business_id: business_id, rating: rating},
                    dataType: "JSON",
                    success: function (data)
                    {
                        alert('your review submitted successfully !');
                        $('#name').val('');
                        $('#new-review').val('');
                        location.reload();
                        //$('#rating_value').val('');
                    }
                });
            }
        });
    });
    function show_timings(id) {
        var type;
        if ($('#hours_display').is(':checked')) {
            $('#hours_display_lable').text('Show Less');
            type = "View All";
        } else {
            $('#hours_display_lable').text('View All');
            type = "Show Less";
        }
        $.ajax({
            url: "<?php echo base_url(); ?>auth/hours_of_operation/",
            type: "POST",
            data: {id: id, type: type},
            dataType: "JSON",
            success: function (data)
            {
                $('#hours_of_opeation').empty();
                $('#hours_of_opeation').html(data);
            }
        });
    }
    function send_information() {
        $('#info_form')[0].reset();
        $('#sms').modal('show');
    }

    function view_info() {
        var val = $('.view_more a:first').text();
        if (val === 'View More') {
            $('.view_more a:first ').text('View Less');
            $('#business_desc').text('<?php echo strip_tags($business->business_description); ?>');
        } else {
            $('.view_more a:first ').text('View More');
        }
    }
    $(document).on('ready', function () {
        $('#send_info').click(function () {
            var name = $('#info_name').val();
            var email = $('#info_email').val();
            var mobile = $('#info_mobile').val();
            var business_id = $('#business_id').val();
            if (name === "") {
                alert("Enter your name");
                return false;
            } else if (email === "") {
                alert("Enter email address");
                return false;
            } else if (mobile === "") {
                alert("Enter mobile no.");
                return false;
            }
            $.ajax({
                url: "<?php echo base_url(); ?>auth/send_information/",
                type: "POST",
                data: {name: name, email: email, mobile: mobile, business_id: business_id},
                dataType: "JSON",
                success: function (response)
                {
                    if (response != "") {
                        $('#sms').modal('hide');
                        alert("Business information mailed successfully !");
                    } else {
                        alert("Something went wrong !...please try again....");
                    }
                }
            });
        });
    });
</script>
</body>
</html>
