<!DOCTYPE html>
<html>
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <?php echo $header; ?>
        <div>
            <div class="container">
                <div class="row">
                    <?php echo $sidebar; ?>                    
                    <div class="col-md-9 col-sm-8 col-xs-12 p-r-0">
                        <div class="form-container">
                            <h3><i class="fa fa-user"></i>&nbsp;&nbsp;Your Ads</h3>
                            <hr class="form-hr" />
                            <?php
                            if (!empty($results)) {
                                array_pop($results);
                                $i = 1;
                                foreach ($results as $data) {
                                    ?>
                                    <div class="row adlist">
                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            <img src="<?php echo base_url(); ?>include_files/logo/<?php echo ($data->logo != "" && (file_exists(FCPATH . 'include_files/logo/' . $data->logo))) ? $data->logo : 'noimage.jpg' ?>" alt="" class="img-responsive img-thumbnail" />                                            
                                            <?php echo ($data->is_approved == 0) ? '<p class="pending-text">Pending</p>' : ''; ?>
                                            <?php echo ($data->is_approved == 1) ? '<p class="approved-text">Approved</p>' : ''; ?>
                                            <?php echo ($data->is_approved == 2) ? '<p class="rejected-text">Rejected</p>' : ''; ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h4><?php echo $data->name; ?></h4>
                                            <ul class="list">
                                                <li><i class="fa fa-map-marker"></i> <?php echo $data->address; ?></li>
                                                <li><i class="fa fa-phone"></i> <?php echo $data->mobile_code . $data->mobile_no; ?></li>
                                                <?php if ($data->transaction_id) { ?>
                                                    <li>Transaction Id :  <?php echo $data->transaction_id; ?></li>
                                                <?php } ?>
        <!--                                                <li><i class="fa fa-star"></i> Rating</li>-->
                                            </ul> 
                                        </div>
                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            <?php if ($data->is_approved == 0) { ?>
                                                <a href="<?php echo base_url(); ?>reseller/add_business/<?php echo $data->id; ?>"><button class="btn btn-danger">Edit <i class="fa fa-edit"></i></button></a>
                                            <?php } ?>
                                        </div>
                                        <?php if ($data->transaction_id) { ?>
                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            <a onClick="earning_history('<?php echo $data->id; ?>')"><button class="btn btn-danger">Earnings <i class="fa fa-money"></i></button></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <img src="<?php echo base_url(); ?>include_files/norecordfound.png" class="img-responsive" />
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pull-right">
                                <?php
                                foreach ($links as $key => $link) {
                                    echo "<li>" . $link . "</li>";
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $footer; ?>
        <div id="earning_history_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Business Earnings</h4>
                    </div>
                    <form method="post" id="add_user_payment" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table-striped" id="tblGrid">
                                <thead id="tblHead">
                                    <tr>
                                        <th>Verified On</th>
                                        <th class="text-right">Rs.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>Company Name</td>
                                        <td class="text-right" id="verified_company_name">

                                        </td>
                                    </tr>
                                    <tr><td>Address</td>
                                        <td class="text-right" id="verified_address">

                                        </td>
                                    </tr>
                                    <tr><td>Category & Subcategory</td>
                                        <td class="text-right" id="verified_category">

                                        </td>
                                    </tr>
                                    <tr><td>Email</td>
                                        <td class="text-right" id="verified_email">

                                        </td>
                                    </tr>
                                    <tr><td>Mobile No.</td>
                                        <td class="text-right" id="verified_mobileno">

                                        </td>
                                    </tr>
                                    <tr><td>Landline No.</td>
                                        <td class="text-right" id="verified_landline">

                                        </td>
                                    </tr>
                                    <tr><td>Establishment Year</td>
                                        <td class="text-right" id="verified_estalishment">

                                        </td>
                                    </tr>
                                    <tr><td>About Us</td>
                                        <td class="text-right" id="verified_aboutus">

                                        </td>
                                    </tr>
                                    <tr><td>Services</td>
                                        <td class="text-right" id="verified_services">

                                        </td>
                                    </tr>
                                    <tr><td>Location</td>
                                        <td class="text-right" id="verified_location">

                                        </td>
                                    </tr>
                                    <tr><td>Hours of Operation</td>
                                        <td class="text-right" id="verified_hours">

                                        </td>
                                    </tr>
                                    <tr><td>Photographs</td>
                                        <td class="text-right" id="verified_photos">

                                        </td>
                                    </tr>
                                    <tr><td>Extra Incentive</td>
                                        <td class="text-right" id="verified_incentive">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>include_files/resseller/js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url(); ?>include_files/resseller/js/resseller.js"></script>   
        <script>
            function earning_history(id) {
            $.ajax({
            url: "<?php echo base_url(); ?>auth/get_businessinfo/",
            type: "POST",
            data: {id: id},
            dataType: "JSON",
            success: function (data)
            {
            if(data.status == true) {
            $('#earning_history_modal').modal('show');
            (data.earninginfo.company_name == 1) ? $('#verified_company_name').text('1') : $('#verified_company_name').text('0');
            (data.earninginfo.address == 1) ? $('#verified_address').text('1') : $('#verified_address').text('0');
            (data.earninginfo.email == 1) ? $('#verified_email').text('1') : $('#verified_email').text('0');
            (data.earninginfo.category_subcategory == 1) ? $('#verified_category').text('1') : $('#verified_category').text('0');            
            (data.earninginfo.mobile == 1) ? $('#verified_mobileno').text('1') : $('#verified_mobileno').text('0');
            (data.earninginfo.landline == 1) ? $('#verified_landline').text('1') : $('#verified_landline').text('0');
            (data.earninginfo.establishment_year == 1) ? $('#verified_estalishment').text('1') : $('#verified_estalishment').text('0');
            (data.earninginfo.aboutus == 1) ? $('#verified_aboutus').text('3') : $('#verified_aboutus').text('0');
            (data.earninginfo.services == 1) ? $('#verified_services').text('1') : $('#verified_services').text('0');
            (data.earninginfo.otherlocation == 1) ? $('#verified_location').text('1') : $('#verified_location').text('0');
            (data.earninginfo.hours == 1) ? $('#verified_hours').text('2') : $('#verified_hours').text('0');
            (data.earninginfo.photos == 1) ? $('#verified_photos').text('7') : $('#verified_photos').text('0');
            (data.earninginfo.extra_incentive == 1) ? $('#verified_incentive').text('5') : $('#verified_incentive').text('0');
            }else {
            alert('No Earning Information Available');
            }
            }
            });
            }
        </script>
    </body>
</html>