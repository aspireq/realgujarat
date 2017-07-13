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
                    <div class="col-md-9 col-sm-8 p-r-0">
                        <div class="form-container">
                            <h3><i class="fa fa-user"></i>&nbsp;&nbsp;Update your profile</h3>
                            <hr class="form-hr" />
                            <?php if ($message != "") { ?>
                                <div class="alert <?php echo ($this->session->flashdata('alert_class')) ? $this->session->flashdata('alert_class') : 'alert-danger'; ?> alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message; ?>
                                </div>
                            <?php } ?>
                            <form class="form row" method="post" action="<?php echo base_url(); ?>reseller/update_profile">
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="First Name" required name="first_name" id="first_name" value="<?php echo (!empty($userinfo['upro_first_name'])) ? $userinfo['upro_first_name'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Last Name" required name="last_name" id="last_name" value="<?php echo (!empty($userinfo['upro_last_name'])) ? $userinfo['upro_last_name'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                                        <input type="text" class="form-control" placeholder="Date Of Birth (mm/dd/yyyy)" required  name="birth_date" id="birth_date" value="<?php echo (!empty($userinfo['birth_date'])) ? $userinfo['birth_date'] : '' ?>">
                                    </div>
                                </div>                                
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="" class="col-md-3 col-sm-3 control-label">Gendar :</label>
                                    <div class="col-md-9 col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="gender_male" value="Male" <?php echo (!empty($userinfo['gender']) && $userinfo['gender'] == "Male") ? 'checked' : '' ?>> Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="gender_female" value="Female" <?php echo (!empty($userinfo['gender']) && $userinfo['gender'] == "Female") ? 'checked' : '' ?>> Female
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <textarea class="form-control" rows="2" placeholder="Address" name="address" ><?php echo (!empty($userinfo['address'])) ? $userinfo['address'] : '' ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user-circle-o"></i></div>
                                        <input type="text" class="form-control" placeholder="Username" required name="username" id="username" readonly="" value="<?php echo (!empty($userinfo['uacc_username'])) ? $userinfo['uacc_username'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input type="email" class="form-control" placeholder="Email" required name="email" id="email" readonly="" value="<?php echo (!empty($userinfo['uacc_email'])) ? $userinfo['uacc_email'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                        <input type="text" class="form-control" placeholder="Reffrence Link" required name="reffrence_link" id="reffrence_link" readonly="" value="<?php echo (!empty($userinfo['reffrence_link'])) ? $userinfo['reffrence_link'] : '' ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <input type="text" class="form-control" placeholder="Pincode" name="pincode" id="pincode" maxlength="6" value="<?php echo (!empty($userinfo['pincode'])) ? $userinfo['pincode'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <select class="form-control" name="state" id="state">
                                            <option value="">Select State</option>
                                            <?php foreach ($states as $state) { ?>
                                                <option value="<?php echo $state->id; ?>" <?php echo (!empty($userinfo['state'] && $userinfo['state'] == $state->id)) ? 'selected' : '' ?> ><?php echo $state->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <select class="form-control" id="city" name="city">
                                            <option value="">Select City</option>
                                            <?php if (!empty($userinfo['city'])) { ?>
                                                <option value="<?php echo $cityname->id; ?>" selected><?php echo $cityname->name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control" placeholder="Landline No."  name="landline_no" id="landline_no" maxlength="10" value="<?php echo (!empty($userinfo['landline_no'])) ? $userinfo['landline_no'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                        <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" id="mobile_no" maxlength="10" value="<?php echo (!empty($userinfo['mobile_no'])) ? $userinfo['mobile_no'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                        <input type="text" class="form-control" placeholder="Other No." name="other_no" id="other_no" maxlength="10" value="<?php echo (!empty($userinfo['other_no'])) ? $userinfo['other_no'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">                    
                                        <input type="checkbox" name="change_pwd" id="change_pwd" value="1">
                                        <label for="change_pwd">Change Password</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" class="form-control" placeholder="Current Password" name="current_password" id="current_password">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-unlock-alt"></i></div>
                                        <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-unlock-alt"></i></div>
                                        <input type="password" class="form-control" placeholder="Re Enter Password" id="confirm_new_password" name="confirm_new_password">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                                    <button class="btn btn-danger btn-submit pull-right" type="submit" name="update_prf" id="update_prf">Update&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $footer; ?>
        <script src="<?php echo base_url(); ?>include_files/resseller/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/resseller/js/resseller.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        <script>
            $(document).ready(function () {
                var date_input = $('input[name="birth_date"]');
                var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                date_input.datepicker({
                    format: 'yyyy-mm-dd',
                    container: container,
                    todayHighlight: false,
                    autoclose: true,
                })
                $('#pincode, #landline_no, #mobile_no, #other_no').on('change keyup', function () {
                    var sanitized = $(this).val().replace(/[^-.0-9]/g, '');
                    sanitized = sanitized.replace(/(.)-+/g, '$1');
                    sanitized = sanitized.replace(/\.(?=.*\.)/g, '');
                    $(this).val(sanitized);
                });
                $('#state').change(function () {
                    var state_id = $('#state').val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>reseller/cities/",
                        type: "POST",
                        data: {state_id: state_id},
                        dataType: "JSON",
                        success: function (data)
                        {
                            $('#city').empty();
                            $('#city').html('<option value="">Select City</option>');
                            $.each(data, function (index, value) {
                                $('#city').append($('<option>').text(value.name).attr('value', value.id));
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>