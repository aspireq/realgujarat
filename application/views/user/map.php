<!DOCTYPE html>
<html>
    <?php echo $header; ?> 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo $name; ?></h3>
            </div>
            <div class="col-md-12">
                <div id="map"></div>
            </div>
        </div>
    </div>
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
    <script>
        function initMap() {
            var myLatLng = {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>}
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '<?php echo $name; ?>'
            });
        }
    </script>
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
</body>
</html>