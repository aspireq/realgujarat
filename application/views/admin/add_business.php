<!DOCTYPE html>  
<html lang="en">
    <head>
        <?php echo $common; ?>
    </head>
    <body>
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
            <?php echo $header; ?>
            <?php echo $sidebar; ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Add Business</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Add Businesses</li>
                            </ol>
                        </div>                        
                    </div>
                    <div class="row">                                         
                        <div class="white-box">
                            <?php
                            if ($message != "") {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <!-- step-->
                            <div class="stepwizard col-md-12 col-sm-12 col-xs-12">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a href="#step-1" type="button" class="btn btn-danger btn-circle">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-2" type="button" class="btn btn-default btn-circle disabled">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-3" type="button" class="btn btn-default btn-circle disabled">3</a>
                                        <p>Step 3</p>
                                    </div>
                                </div>
                            </div>
                            <!--  form-->
                            <form class="form" role="form" method="post" enctype="multipart/form-data" action="" id="business_post">
                                <input type="hidden" name="total_earnings" id="total_earnings">
                                <div class="row setup-content" id="step-1">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3>Step 1 : Basic Information</h3>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" class="form-control" placeholder="Company name" required name="company_name" id="company_name" value="<?php echo (!empty($businessinfo) && $businessinfo['name'] != "") ? $businessinfo['name'] : '' ?>" onblur="calculateTotal()">
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label for="company_name_verified">Company Name Verified ? </label>
                                                <input type="checkbox" class="" id="company_name_verified" name="company_name_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->company_name == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo (!empty($businessinfo && isset($businessinfo['id']))) ? $businessinfo['id'] : '' ?>">
                                        <input type="hidden" name="old_logo" id="old_logo" value="<?php echo (!empty($businessinfo && isset($businessinfo['banner']))) ? $businessinfo['banner'] : '' ?>">
                                        <input type="hidden" name="old_banner" id="old_banner" value="<?php echo (!empty($businessinfo && isset($businessinfo['logo']))) ? $businessinfo['logo'] : '' ?>">                                        
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-cube"></i></div>
                                                <select type="text" class="form-control" name="category" id="category" required onChange="calculateTotal()">
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?php echo $category->id; ?>" <?php echo (!empty($businessinfo) && $businessinfo['category_id'] != "" && $businessinfo['category_id'] == $category->id ) ? 'selected' : '' ?>><?php echo $category->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-cube"></i></div>
                                                <select class="form-control" name="subcategory" id="subcategory">
                                                    <option value="">Select Subcategory</option>
                                                    <?php
                                                    if (!empty($businessinfo) && $businessinfo['subcategory_id'] != "") {
                                                        $subcategoryin = $this->db->query('select * from subcategories where id = ' . $businessinfo['subcategory_id'] . '');
                                                        echo '<option value="' . $subcategoryin->row()->id . '" selected>' . $subcategoryin->row()->name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="category_subcategory_verifed">Category & Subcategory Verified ? </label>
                                                <input type="checkbox" class="" id="category_subcategory_verifed" name="category_subcategory_verifed" value="1" <?php echo (!empty($earninghistory) && $earninghistory->category_subcategory == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                <textarea type="text" class="form-control" rows="2" placeholder="Company Address" name="company_address" id="company_address" required="" onblur="calculateTotal()"><?php echo (!empty($businessinfo) && $businessinfo['address'] != "") ? $businessinfo['address'] : '' ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                <input type="text" class="form-control" placeholder="Pincode" name="pincode" id="pincode" maxlength="6" onblur="calculateTotal()" value="<?php echo (!empty($businessinfo) && $businessinfo['pincode'] != "") ? $businessinfo['pincode'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="">Select State</option>
                                                    <?php foreach ($states as $state) { ?>
                                                        <option value="<?php echo $state->id; ?>" <?php echo (!empty($businessinfo) && $businessinfo['state'] != "" && $businessinfo['state'] == $state->id ) ? 'selected' : '' ?>><?php echo $state->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                <select class="form-control" id="city" name="city">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    if (!empty($businessinfo) && $businessinfo['city'] != "") {
                                                        $cityinfo = $this->db->query('select * from cities where id = ' . $businessinfo['city'] . '');
                                                        echo '<option value="' . $cityinfo->row()->id . '" selected>' . $cityinfo->row()->name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="company_address_verifed">Company Location Information (Address,City,State) Verified ? </label>
                                                <input type="checkbox" class="" id="company_address_verifed" name="company_address_verifed" value="1" <?php echo (!empty($earninghistory) && $earninghistory->address == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo (!empty($businessinfo) && $businessinfo['email'] != "") ? $businessinfo['email'] : '' ?>">
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="email_verified">Email Address Verified ? </label>
                                                <input type="checkbox" class="" id="email_verified" name="email_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->email == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12" id="find_duplicates">
                                            <div class="alert alert-danger alert-dismissable">                                                
                                                One of the Contact already registered with the system
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <div class="input-group-addon codeinput">
                                                    <input type="text" placeholder="Code" class="form-control" name="landline_code" id="landline_code" value="<?php echo (!empty($businessinfo) && $businessinfo['landline_code'] != "") ? $businessinfo['landline_code'] : '' ?>">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Landline No." name="landline_no" id="landline_no" maxlength="10" value="<?php echo (!empty($businessinfo) && $businessinfo['landline_no'] != "") ? $businessinfo['landline_no'] : '' ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                                <div class="input-group-addon codeinput">
                                                    <input type="text" placeholder="Code" class="form-control" name="mobile_code" id="mobile_code" value="<?php echo (!empty($businessinfo) && $businessinfo['mobile_code'] != "") ? $businessinfo['mobile_code'] : '' ?>">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Mobile No." required name="mobile_no" id="mobile_no" maxlength="10" value="<?php echo (!empty($businessinfo) && $businessinfo['mobile_no'] != "") ? $businessinfo['mobile_no'] : '' ?>" onblur="calculateTotal()">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                                <div class="input-group-addon codeinput">
                                                    <input type="text" placeholder="Code" name="other_code" id="other_code" class="form-control" value="<?php echo (!empty($businessinfo) && $businessinfo['other_code'] != "") ? $businessinfo['other_code'] : '' ?>">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Other No." name="other_no" id="other_no" maxlength="10" value="<?php echo (!empty($businessinfo) && $businessinfo['other_no'] != "") ? $businessinfo['other_no'] : '' ?>">
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="landline_verified">Landline No. Verified ? </label>
                                                <input type="checkbox" class="" id="landline_verified" name="landline_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->landline == 1) ? 'checked' : ''; ?> >
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="mobileno_verified">Mobile No. Verified ? </label>
                                                <input type="checkbox" class="" id="mobileno_verified" name="mobileno_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->mobile == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <input tyoe="button" class="btn btn-primary" name="add_more_contact" id="add_more_contact" value="Add More Contacts" onclick="add_more_contacts();"/>
                                        </div>
                                        <?php
                                        if (!empty($contact_info)) {
                                            foreach ($contact_info as $contact) {
                                                ?>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                            <div class="input-group-addon codeinput">
                                                                <input type="text" placeholder="Code" class="form-control" name="more_landline_code[]" id="more_landline_code" value="<?php echo (!empty($contact) && $contact->landline_code_number != "") ? $contact->landline_code_number : '' ?>">
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Landline No." name="more_landline_no[]" id="more_landline_no" maxlength="10" value="<?php echo (!empty($contact) && $contact->landline_number != "") ? $contact->landline_number : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                                            <div class="input-group-addon codeinput">
                                                                <input type="text" placeholder="Code" class="form-control" name="more_mobile_code[]" id="more_mobile_code" value="<?php echo (!empty($contact) && $contact->mobile_no_code != "") ? $contact->mobile_no_code : '' ?>">
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Mobile No." name="more_mobile_no[]" id="more_mobile_no" maxlength="10" value="<?php echo (!empty($contact) && $contact->mobile_number != "") ? $contact->mobile_number : '' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div id="add_more_contactinfo">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                <input type="text" class="form-control" placeholder="Establishment Year" name="year_establishment" id="year_establishment" value="<?php echo (!empty($businessinfo) && $businessinfo['year_establishment'] != "") ? $businessinfo['year_establishment'] : '' ?>">
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="establishmentyear_verified">Estabishment Year Verified ? </label>
                                                <input type="checkbox" class="" id="establishmentyear_verified" name="establishmentyear_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->establishment_year == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>
                                                <input type="text" class="form-control" placeholder="Contact Person" name="contact_person_name" id="contact_person_name" value="<?php echo (!empty($businessinfo) && $businessinfo['contact_person_name'] != "") ? $businessinfo['contact_person_name'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-info-circle"></i></div>
                                                <input type="text" class="form-control" placeholder="Website" name="website" id="website" value="<?php echo (!empty($businessinfo) && $businessinfo['website'] != "") ? $businessinfo['website'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" id="btn-step-1" name="btn-step-1" onclick="calculateTotal()">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row setup-content" id="step-2">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3>Step 2 : Company Detail</h3>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <textarea class="form-control" placeholder="About Company" name="about_company" id="about_company"><?php echo (!empty($businessinfo) && $businessinfo['business_description'] != "") ? $businessinfo['business_description'] : '' ?></textarea>
                                            </div>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="aboutbusiness_verified">Business Information Verified ? </label>
                                                <input type="checkbox" class="" id="aboutbusiness_verified" name="aboutbusiness_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->aboutus == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Services You Provide :</h4>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <select multiple data-role="tagsinput" class="form-control" name="services[]" id="services">
                                                <?php
                                                if (!empty($businessinfo) && $businessinfo['services'] != "") {
                                                    $services = explode(',', $businessinfo['services']);
                                                    foreach ($services as $service) {
                                                        echo '<option value="' . $service . '">' . $service . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="services_verified">Services Information Verified ? </label>
                                                <input type="checkbox" class="" id="services_verified" name="services_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->services == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Other Locations :</h4>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <select multiple data-role="tagsinput" class="form-control" name="other_locations[]" id="other_locations">
                                                <?php
                                                if (!empty($businessinfo) && $businessinfo['other_locations'] != "") {
                                                    $locations = explode(',', $businessinfo['other_locations']);
                                                    foreach ($locations as $location) {
                                                        echo '<option value="' . $location . '">' . $location . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>                                            
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="otherlocation_verified">Locations Verified ? </label>
                                                <input type="checkbox" class="" id="otherlocation_verified" name="otherlocation_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->otherlocation == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Keywords :</h4>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Keywords" style="width: 100%" name="keywords[]" id="keywords">                                                
                                                <?php foreach ($keywordinfo as $keywordval) { ?>
                                                    <option value="<?php echo $keywordval->id; ?>" <?php echo (!empty($businessinfo) && in_array($keywordval->id, explode(',', $businessinfo['keywords']))) ? 'selected' : '' ?>><?php echo $keywordval->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Hours Of Operation :</h4>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <?php
                                            $days = array(
                                                0 => 'Monday',
                                                1 => 'Tuesday',
                                                2 => 'Wednesday',
                                                3 => 'Thursday',
                                                4 => 'Friday',
                                                5 => 'Saturday',
                                                6 => 'Sunday');
                                            if (!empty($businessinfo)) {
                                                $from_timings_1 = explode(',', $businessinfo['from_timings_1']);
                                                $to_timings_1 = explode(',', $businessinfo['to_timings_1']);
                                                if ($businessinfo['from_timings_2'] != null) {
                                                    $from_timings_2 = explode(',', $businessinfo['from_timings_2']);
                                                    $to_timings_2 = explode(',', $businessinfo['to_timings_2']);
                                                }
                                            }
                                            ?>
                                            <?php foreach ($days as $key => $day) { ?>
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                        <p><?php echo $day; ?> :</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-5 bootstrap-timepicker">                                                    
                                                        <select class="form-control" name="from_timings[]" id="from_timings<?php echo '-' . $key; ?>">
                                                            <option value="Open 24 Hours" <?php echo (!empty($businessinfo) && $from_timings_1[$key] == 'Open 24 Hours') ? 'selected' : '' ?>>Open 24 Hours</option>
                                                            <option value = '00:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '00:00') ? 'selected' : '' ?>> 00:00 </option>
                                                            <option value = '00:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '00:30') ? 'selected' : '' ?>> 00:30 </option>
                                                            <option value = '01:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '01:00') ? 'selected' : '' ?>> 01:00 </option>
                                                            <option value = '01:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '01:30') ? 'selected' : '' ?>> 01:30 </option>
                                                            <option value = '02:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '02:00') ? 'selected' : '' ?>> 02:00 </option>
                                                            <option value = '02:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '02:30') ? 'selected' : '' ?>> 02:30 </option>
                                                            <option value = '03:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '03:00') ? 'selected' : '' ?>> 03:00 </option>
                                                            <option value = '03:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '03:30') ? 'selected' : '' ?>> 03:30 </option>
                                                            <option value = '04:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '04:00') ? 'selected' : '' ?>> 04:00 </option>
                                                            <option value = '04:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '04:30') ? 'selected' : '' ?>> 04:30 </option>
                                                            <option value = '05:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '05:00') ? 'selected' : '' ?>> 05:00 </option>
                                                            <option value = '05:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '05:30') ? 'selected' : '' ?>> 05:30 </option>
                                                            <option value = '06:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '06:00') ? 'selected' : '' ?>> 06:00 </option>
                                                            <option value = '06:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '06:30') ? 'selected' : '' ?>> 06:30 </option>
                                                            <option value = '07:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '07:00') ? 'selected' : '' ?>> 07:00 </option>
                                                            <option value = '07:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '07:30') ? 'selected' : '' ?>> 07:30 </option>
                                                            <option value = '08:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '08:00') ? 'selected' : '' ?>> 08:00 </option>
                                                            <option value = '08:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '08:30') ? 'selected' : '' ?>> 08:30 </option>
                                                            <option value = '09:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '09:00') ? 'selected' : '' ?>> 09:00 </option>
                                                            <option value = '09:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '09:30') ? 'selected' : '' ?>> 09:30 </option>
                                                            <option value = '10:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '10:00') ? 'selected' : '' ?>> 10:00 </option>
                                                            <option value = '10:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '10:30') ? 'selected' : '' ?>> 10:30 </option>
                                                            <option value = '11:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '11:00') ? 'selected' : '' ?>> 11:00 </option>
                                                            <option value = '11:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '11:30') ? 'selected' : '' ?>> 11:30 </option>
                                                            <option value = '12:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '12:00') ? 'selected' : '' ?>> 12:00 </option>
                                                            <option value = '12:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '12:30') ? 'selected' : '' ?>> 12:30 </option>
                                                            <option value = '13:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '13:00') ? 'selected' : '' ?>> 13:00 </option>
                                                            <option value = '13:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '13:30') ? 'selected' : '' ?>> 13:30 </option>
                                                            <option value = '14:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '14:00') ? 'selected' : '' ?>> 14:00 </option>
                                                            <option value = '14:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '14:30') ? 'selected' : '' ?>> 14:30 </option>
                                                            <option value = '15:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '15:00') ? 'selected' : '' ?>> 15:00 </option>
                                                            <option value = '15:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '15:30') ? 'selected' : '' ?>> 15:30 </option>
                                                            <option value = '16:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '16:00') ? 'selected' : '' ?>> 16:00 </option>
                                                            <option value = '16:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '16:30') ? 'selected' : '' ?>> 16:30 </option>
                                                            <option value = '17:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '17:00') ? 'selected' : '' ?>> 17:00 </option>
                                                            <option value = '17:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '17:30') ? 'selected' : '' ?>> 17:30 </option>
                                                            <option value = '18:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '18:00') ? 'selected' : '' ?>> 18:00 </option>
                                                            <option value = '18:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '18:30') ? 'selected' : '' ?>> 18:30 </option>
                                                            <option value = '19:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '19:00') ? 'selected' : '' ?>> 19:00 </option>
                                                            <option value = '19:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '19:30') ? 'selected' : '' ?>> 19:30 </option>
                                                            <option value = '20:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '20:00') ? 'selected' : '' ?>> 20:00 </option>
                                                            <option value = '20:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '20:30') ? 'selected' : '' ?>> 20:30 </option>
                                                            <option value = '21:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '21:00') ? 'selected' : '' ?>> 21:00 </option>
                                                            <option value = '21:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '21:30') ? 'selected' : '' ?>> 21:30 </option>
                                                            <option value = '22:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '22:00') ? 'selected' : '' ?>> 22:00 </option>
                                                            <option value = '22:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '22:30') ? 'selected' : '' ?>> 22:30 </option>
                                                            <option value = '23:00' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '23:00') ? 'selected' : '' ?>> 23:00 </option>
                                                            <option value = '23:30' <?php echo (!empty($businessinfo) && $from_timings_1[$key] == '23:30') ? 'selected' : '' ?>> 23:30 </option>
                                                            <option value="Closed" <?php echo (!empty($businessinfo) && $from_timings_1[$key] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-2 text-center">
                                                        <p>To</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-5 bootstrap-timepicker">                                                    
                                                        <select class="form-control" name="to_timings[]" id="to_timings<?php echo '-' . $key; ?>">
                                                            <option value="Open 24 Hours" <?php echo (!empty($businessinfo) && $to_timings_1[$key] == 'Open 24 Hours') ? 'selected' : '' ?>>Open 24 Hours</option>
                                                            <option value = '00:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '00:00') ? 'selected' : '' ?>> 00:00 </option>
                                                            <option value = '00:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '00:30') ? 'selected' : '' ?>> 00:30 </option>
                                                            <option value = '01:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '01:00') ? 'selected' : '' ?>> 01:00 </option>
                                                            <option value = '01:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '01:30') ? 'selected' : '' ?>> 01:30 </option>
                                                            <option value = '02:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '02:00') ? 'selected' : '' ?>> 02:00 </option>
                                                            <option value = '02:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '02:30') ? 'selected' : '' ?>> 02:30 </option>
                                                            <option value = '03:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '03:00') ? 'selected' : '' ?>> 03:00 </option>
                                                            <option value = '03:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '03:30') ? 'selected' : '' ?>> 03:30 </option>
                                                            <option value = '04:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '04:00') ? 'selected' : '' ?>> 04:00 </option>
                                                            <option value = '04:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '04:30') ? 'selected' : '' ?>> 04:30 </option>
                                                            <option value = '05:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '05:00') ? 'selected' : '' ?>> 05:00 </option>
                                                            <option value = '05:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '05:30') ? 'selected' : '' ?>> 05:30 </option>
                                                            <option value = '06:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '06:00') ? 'selected' : '' ?>> 06:00 </option>
                                                            <option value = '06:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '06:30') ? 'selected' : '' ?>> 06:30 </option>
                                                            <option value = '07:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '07:00') ? 'selected' : '' ?>> 07:00 </option>
                                                            <option value = '07:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '07:30') ? 'selected' : '' ?>> 07:30 </option>
                                                            <option value = '08:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '08:00') ? 'selected' : '' ?>> 08:00 </option>
                                                            <option value = '08:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '08:30') ? 'selected' : '' ?>> 08:30 </option>
                                                            <option value = '09:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '09:00') ? 'selected' : '' ?>> 09:00 </option>
                                                            <option value = '09:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '09:30') ? 'selected' : '' ?>> 09:30 </option>
                                                            <option value = '10:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '10:00') ? 'selected' : '' ?>> 10:00 </option>
                                                            <option value = '10:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '10:30') ? 'selected' : '' ?>> 10:30 </option>
                                                            <option value = '11:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '11:00') ? 'selected' : '' ?>> 11:00 </option>
                                                            <option value = '11:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '11:30') ? 'selected' : '' ?>> 11:30 </option>
                                                            <option value = '12:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '12:00') ? 'selected' : '' ?>> 12:00 </option>
                                                            <option value = '12:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '12:30') ? 'selected' : '' ?>> 12:30 </option>
                                                            <option value = '13:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '13:00') ? 'selected' : '' ?>> 13:00 </option>
                                                            <option value = '13:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '13:30') ? 'selected' : '' ?>> 13:30 </option>
                                                            <option value = '14:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '14:00') ? 'selected' : '' ?>> 14:00 </option>
                                                            <option value = '14:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '14:30') ? 'selected' : '' ?>> 14:30 </option>
                                                            <option value = '15:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '15:00') ? 'selected' : '' ?>> 15:00 </option>
                                                            <option value = '15:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '15:30') ? 'selected' : '' ?>> 15:30 </option>
                                                            <option value = '16:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '16:00') ? 'selected' : '' ?>> 16:00 </option>
                                                            <option value = '16:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '16:30') ? 'selected' : '' ?>> 16:30 </option>
                                                            <option value = '17:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '17:00') ? 'selected' : '' ?>> 17:00 </option>
                                                            <option value = '17:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '17:30') ? 'selected' : '' ?>> 17:30 </option>
                                                            <option value = '18:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '18:00') ? 'selected' : '' ?>> 18:00 </option>
                                                            <option value = '18:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '18:30') ? 'selected' : '' ?>> 18:30 </option>
                                                            <option value = '19:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '19:00') ? 'selected' : '' ?>> 19:00 </option>
                                                            <option value = '19:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '19:30') ? 'selected' : '' ?>> 19:30 </option>
                                                            <option value = '20:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '20:00') ? 'selected' : '' ?>> 20:00 </option>
                                                            <option value = '20:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '20:30') ? 'selected' : '' ?>> 20:30 </option>
                                                            <option value = '21:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '21:00') ? 'selected' : '' ?>> 21:00 </option>
                                                            <option value = '21:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '21:30') ? 'selected' : '' ?>> 21:30 </option>
                                                            <option value = '22:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '22:00') ? 'selected' : '' ?>> 22:00 </option>
                                                            <option value = '22:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '22:30') ? 'selected' : '' ?>> 22:30 </option>
                                                            <option value = '23:00' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '23:00') ? 'selected' : '' ?>> 23:00 </option>
                                                            <option value = '23:30' <?php echo (!empty($businessinfo) && $to_timings_1[$key] == '23:30') ? 'selected' : '' ?>> 23:30 </option>
                                                            <option value="Closed" <?php echo (!empty($businessinfo) && $to_timings_1[$key] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="check_closed<?php echo '-' . $key; ?>" onclick="set_closed('<?php echo 'from_timings-' . $key; ?>', '<?php echo 'to_timings-' . $key; ?>')">
                                                                Closed
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" class="" id="copy_timings" name="copy_timings">
                                            <label for="copy_timings">Copy Timings from Monday to Saturday</label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="checkbox" <?php echo (!empty($businessinfo) && $businessinfo['from_timings_2'] != null) ? 'checked' : '' ?> id="dual_timings" name="dual_timings" value="1">
                                            <label for="dual_timings">Dual Timings</label>
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>                                            
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="hours_verified">Working Hours Verified ? </label>
                                                <input type="checkbox" class="" id="hours_verified" name="hours_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->hours == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div id="dual_timings_check">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <?php foreach ($days as $key => $day) { ?>
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                                            <p><?php echo $day; ?> :</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-5 bootstrap-timepicker">                                                    
                                                            <select class="form-control" name="from_timings_1[]" id="from_timings_1<?php echo '-' . $key; ?>">
                                                                <option value="Open 24 Hours" <?php echo (!empty($businessinfo) && $from_timings_2[$key] == 'Open 24 Hours') ? 'selected' : '' ?>>Open 24 Hours</option>
                                                                <option value = '00:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '00:00') ? 'selected' : '' ?>> 00:00 </option>
                                                                <option value = '00:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '00:30') ? 'selected' : '' ?>> 00:30 </option>
                                                                <option value = '01:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '01:00') ? 'selected' : '' ?>> 01:00 </option>
                                                                <option value = '01:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '01:30') ? 'selected' : '' ?>> 01:30 </option>
                                                                <option value = '02:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '02:00') ? 'selected' : '' ?>> 02:00 </option>
                                                                <option value = '02:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '02:30') ? 'selected' : '' ?>> 02:30 </option>
                                                                <option value = '03:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '03:00') ? 'selected' : '' ?>> 03:00 </option>
                                                                <option value = '03:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '03:30') ? 'selected' : '' ?>> 03:30 </option>
                                                                <option value = '04:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '04:00') ? 'selected' : '' ?>> 04:00 </option>
                                                                <option value = '04:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '04:30') ? 'selected' : '' ?>> 04:30 </option>
                                                                <option value = '05:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '05:00') ? 'selected' : '' ?>> 05:00 </option>
                                                                <option value = '05:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '05:30') ? 'selected' : '' ?>> 05:30 </option>
                                                                <option value = '06:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '06:00') ? 'selected' : '' ?>> 06:00 </option>
                                                                <option value = '06:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '06:30') ? 'selected' : '' ?>> 06:30 </option>
                                                                <option value = '07:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '07:00') ? 'selected' : '' ?>> 07:00 </option>
                                                                <option value = '07:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '07:30') ? 'selected' : '' ?>> 07:30 </option>
                                                                <option value = '08:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '08:00') ? 'selected' : '' ?>> 08:00 </option>
                                                                <option value = '08:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '08:30') ? 'selected' : '' ?>> 08:30 </option>
                                                                <option value = '09:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '09:00') ? 'selected' : '' ?>> 09:00 </option>
                                                                <option value = '09:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '09:30') ? 'selected' : '' ?>> 09:30 </option>
                                                                <option value = '10:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '10:00') ? 'selected' : '' ?>> 10:00 </option>
                                                                <option value = '10:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '10:30') ? 'selected' : '' ?>> 10:30 </option>
                                                                <option value = '11:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '11:00') ? 'selected' : '' ?>> 11:00 </option>
                                                                <option value = '11:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '11:30') ? 'selected' : '' ?>> 11:30 </option>
                                                                <option value = '12:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '12:00') ? 'selected' : '' ?>> 12:00 </option>
                                                                <option value = '12:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '12:30') ? 'selected' : '' ?>> 12:30 </option>
                                                                <option value = '13:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '13:00') ? 'selected' : '' ?>> 13:00 </option>
                                                                <option value = '13:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '13:30') ? 'selected' : '' ?>> 13:30 </option>
                                                                <option value = '14:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '14:00') ? 'selected' : '' ?>> 14:00 </option>
                                                                <option value = '14:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '14:30') ? 'selected' : '' ?>> 14:30 </option>
                                                                <option value = '15:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '15:00') ? 'selected' : '' ?>> 15:00 </option>
                                                                <option value = '15:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '15:30') ? 'selected' : '' ?>> 15:30 </option>
                                                                <option value = '16:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '16:00') ? 'selected' : '' ?>> 16:00 </option>
                                                                <option value = '16:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '16:30') ? 'selected' : '' ?>> 16:30 </option>
                                                                <option value = '17:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '17:00') ? 'selected' : '' ?>> 17:00 </option>
                                                                <option value = '17:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '17:30') ? 'selected' : '' ?>> 17:30 </option>
                                                                <option value = '18:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '18:00') ? 'selected' : '' ?>> 18:00 </option>
                                                                <option value = '18:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '18:30') ? 'selected' : '' ?>> 18:30 </option>
                                                                <option value = '19:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '19:00') ? 'selected' : '' ?>> 19:00 </option>
                                                                <option value = '19:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '19:30') ? 'selected' : '' ?>> 19:30 </option>
                                                                <option value = '20:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '20:00') ? 'selected' : '' ?>> 20:00 </option>
                                                                <option value = '20:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '20:30') ? 'selected' : '' ?>> 20:30 </option>
                                                                <option value = '21:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '21:00') ? 'selected' : '' ?>> 21:00 </option>
                                                                <option value = '21:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '21:30') ? 'selected' : '' ?>> 21:30 </option>
                                                                <option value = '22:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '22:00') ? 'selected' : '' ?>> 22:00 </option>
                                                                <option value = '22:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '22:30') ? 'selected' : '' ?>> 22:30 </option>
                                                                <option value = '23:00' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '23:00') ? 'selected' : '' ?>> 23:00 </option>
                                                                <option value = '23:30' <?php echo (!empty($businessinfo) && $from_timings_2[$key] == '23:30') ? 'selected' : '' ?>> 23:30 </option>
                                                                <option value="Closed" <?php echo (!empty($businessinfo) && $from_timings_2[$key] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1 col-sm-1 col-xs-2 text-center">
                                                            <p>To</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-5 bootstrap-timepicker">
                                                            <select class="form-control" name="to_timings_1[]" id="to_timings_1<?php echo '-' . $key; ?>">
                                                                <option value="Open 24 Hours" <?php echo (!empty($businessinfo) && $to_timings_2[$key] == 'Open 24 Hours') ? 'selected' : '' ?>>Open 24 Hours</option>
                                                                <option value = '00:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '00:00') ? 'selected' : '' ?>> 00:00 </option>
                                                                <option value = '00:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '00:30') ? 'selected' : '' ?>> 00:30 </option>
                                                                <option value = '01:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '01:00') ? 'selected' : '' ?>> 01:00 </option>
                                                                <option value = '01:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '01:30') ? 'selected' : '' ?>> 01:30 </option>
                                                                <option value = '02:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '02:00') ? 'selected' : '' ?>> 02:00 </option>
                                                                <option value = '02:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '02:30') ? 'selected' : '' ?>> 02:30 </option>
                                                                <option value = '03:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '03:00') ? 'selected' : '' ?>> 03:00 </option>
                                                                <option value = '03:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '03:30') ? 'selected' : '' ?>> 03:30 </option>
                                                                <option value = '04:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '04:00') ? 'selected' : '' ?>> 04:00 </option>
                                                                <option value = '04:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '04:30') ? 'selected' : '' ?>> 04:30 </option>
                                                                <option value = '05:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '05:00') ? 'selected' : '' ?>> 05:00 </option>
                                                                <option value = '05:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '05:30') ? 'selected' : '' ?>> 05:30 </option>
                                                                <option value = '06:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '06:00') ? 'selected' : '' ?>> 06:00 </option>
                                                                <option value = '06:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '06:30') ? 'selected' : '' ?>> 06:30 </option>
                                                                <option value = '07:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '07:00') ? 'selected' : '' ?>> 07:00 </option>
                                                                <option value = '07:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '07:30') ? 'selected' : '' ?>> 07:30 </option>
                                                                <option value = '08:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '08:00') ? 'selected' : '' ?>> 08:00 </option>
                                                                <option value = '08:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '08:30') ? 'selected' : '' ?>> 08:30 </option>
                                                                <option value = '09:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '09:00') ? 'selected' : '' ?>> 09:00 </option>
                                                                <option value = '09:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '09:30') ? 'selected' : '' ?>> 09:30 </option>
                                                                <option value = '10:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '10:00') ? 'selected' : '' ?>> 10:00 </option>
                                                                <option value = '10:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '10:30') ? 'selected' : '' ?>> 10:30 </option>
                                                                <option value = '11:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '11:00') ? 'selected' : '' ?>> 11:00 </option>
                                                                <option value = '11:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '11:30') ? 'selected' : '' ?>> 11:30 </option>
                                                                <option value = '12:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '12:00') ? 'selected' : '' ?>> 12:00 </option>
                                                                <option value = '12:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '12:30') ? 'selected' : '' ?>> 12:30 </option>
                                                                <option value = '13:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '13:00') ? 'selected' : '' ?>> 13:00 </option>
                                                                <option value = '13:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '13:30') ? 'selected' : '' ?>> 13:30 </option>
                                                                <option value = '14:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '14:00') ? 'selected' : '' ?>> 14:00 </option>
                                                                <option value = '14:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '14:30') ? 'selected' : '' ?>> 14:30 </option>
                                                                <option value = '15:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '15:00') ? 'selected' : '' ?>> 15:00 </option>
                                                                <option value = '15:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '15:30') ? 'selected' : '' ?>> 15:30 </option>
                                                                <option value = '16:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '16:00') ? 'selected' : '' ?>> 16:00 </option>
                                                                <option value = '16:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '16:30') ? 'selected' : '' ?>> 16:30 </option>
                                                                <option value = '17:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '17:00') ? 'selected' : '' ?>> 17:00 </option>
                                                                <option value = '17:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '17:30') ? 'selected' : '' ?>> 17:30 </option>
                                                                <option value = '18:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '18:00') ? 'selected' : '' ?>> 18:00 </option>
                                                                <option value = '18:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '18:30') ? 'selected' : '' ?>> 18:30 </option>
                                                                <option value = '19:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '19:00') ? 'selected' : '' ?>> 19:00 </option>
                                                                <option value = '19:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '19:30') ? 'selected' : '' ?>> 19:30 </option>
                                                                <option value = '20:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '20:00') ? 'selected' : '' ?>> 20:00 </option>
                                                                <option value = '20:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '20:30') ? 'selected' : '' ?>> 20:30 </option>
                                                                <option value = '21:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '21:00') ? 'selected' : '' ?>> 21:00 </option>
                                                                <option value = '21:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '21:30') ? 'selected' : '' ?>> 21:30 </option>
                                                                <option value = '22:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '22:00') ? 'selected' : '' ?>> 22:00 </option>
                                                                <option value = '22:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '22:30') ? 'selected' : '' ?>> 22:30 </option>
                                                                <option value = '23:00' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '23:00') ? 'selected' : '' ?>> 23:00 </option>
                                                                <option value = '23:30' <?php echo (!empty($businessinfo) && $to_timings_2[$key] == '23:30') ? 'selected' : '' ?>> 23:30 </option>
                                                                <option value="Closed" <?php echo (!empty($businessinfo) && $to_timings_2[$key] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="check_closed<?php echo '-' . $key; ?>" onclick="set_closed('<?php echo 'from_timings_1-' . $key; ?>', '<?php echo 'to_timings_1-' . $key; ?>')">
                                                                    Closed
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="checkbox" class="" id="copy_timings_dual" name="copy_timings_dual">
                                                <label for="copy_timings_dual">Copy Timings from Monday to Saturday</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Payment Modes Accepted By You :</h4>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Payment Mode" style="width: 100%" name="payment_mode[]" id="payment_mode">
                                                <?php
                                                if (!empty($businessinfo) && $businessinfo['payment_methods'] != "") {
                                                    $payment_methods = explode(',', $businessinfo['payment_methods']);
                                                }
                                                ?>   
                                                <option value="Cash" <?php echo (!empty($businessinfo) && in_array('Cash', $payment_methods)) ? 'selected' : '' ?>>Cash</option>
                                                <option value="Visa Card" <?php echo (!empty($businessinfo) && in_array('Visa Card', $payment_methods)) ? 'selected' : '' ?>>Visa Card</option>
                                                <option value="Master Card" <?php echo (!empty($businessinfo) && in_array('Master Card', $payment_methods)) ? 'selected' : '' ?>>Master Card</option>
                                                <option value="Debit Card" <?php echo (!empty($businessinfo) && in_array('Debit Card', $payment_methods)) ? 'selected' : '' ?>>Debit Card</option>
                                                <option value="Money Order" <?php echo (!empty($businessinfo) && in_array('Money Order', $payment_methods)) ? 'selected' : '' ?>>Money Order</option>
                                                <option value="Financing Available" <?php echo (!empty($businessinfo) && in_array('Financing Available', $payment_methods)) ? 'selected' : '' ?>>Financing Available</option>
                                                <option value="Cheque" <?php echo (!empty($businessinfo) && in_array('Cheque', $payment_methods)) ? 'selected' : '' ?>>Cheque</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Product Rate:</h4>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-8 col-xs-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="min_rate" name="min_rate" placeholder="Minimum Rate(INR)" value="<?php echo (!empty($businessinfo) && $businessinfo['min_price_range'] != "") ? $businessinfo['min_price_range'] : '' ?>">
                                                <span class="input-group-addon">To</span>
                                                <input type="text" class="form-control" id="max_rate" name="max_rate"  placeholder="Maximum Rate(INR)" value="<?php echo (!empty($businessinfo) && $businessinfo['max_price_range'] != "") ? $businessinfo['max_price_range'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-danger prevBtn btn-lg pull-left" type="button">Previous</button>
                                            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row setup-content" id="step-3">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3>Step 3: Upload Photos</h3>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Upload Logo :</h4>
                                            <div class="kv-avatar">
                                                <input id="input-1" type="file" accept="image/*" name="avatar-1" class="file-loading"  data-show-upload="false">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Upload Banner :</h4>
                                            <input id="input-2" name="company_banner" type="file" accept="image/*" class="file-loading" data-show-upload="false">
                                        </div>                                        
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <h4 class="form-title">Upload Images</h4>
                                            <div class="alert alert-info">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                Maximum 50 Files are allowed
                                            </div>
                                            <div class="row oldimage">
                                                <?php foreach ($businessinfo['company_images'] as $image) { ?>                                                
                                                    <div class="col-md-3">
                                                        <div class="thumbnail">
                                                            <a class="close" href="#"><i class="fa fa-times-circle"></i></a>
                                                            <input type="hidden" name="old_company_images[]" id="<?php echo $$image->image; ?>" value="<?php echo $image->image; ?>">
                                                            <img src="<?php echo base_url(); ?>include_files/business_images/<?php echo $image->image; ?>">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <input id="input-3" type="file" accept="image/*" name="userFiles[]" class="file-loading"  multiple  data-show-upload="false">
                                        </div>
                                        <?php if (!empty($businessinfo && isset($businessinfo['id']) && $businessinfo['id'] && $businessinfo['is_approved'] != 1) && $businessinfo['user_id'] != 0) { ?>                                            
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">                                            
                                                <label for="photologo_verified">Photos & Logos Verified ? </label>
                                                <input type="checkbox" class="" id="photologo_verified" name="photologo_verified" value="1" <?php echo (!empty($earninghistory) && $earninghistory->photos == 1) ? 'checked' : ''; ?>>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-danger prevBtn btn-lg pull-left" type="button">Previous</button>
                                            <button class="btn btn-success btn-lg pull-right" type="submit" id="add_busines" name="add_busines">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                   
                </div>

                <?php echo $footer; ?>
            </div>     
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>    
            <script src="<?php echo base_url(); ?>include_files/admin/js/jquery.slimscroll.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/waves.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/custom.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/js/jQuery.dataTables.reloadAjax.js"></script>
            <!-- bt-switch -->
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/imageupload/js/plugins/sortable.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/imageupload/js/fileinput.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/imageupload/themes/explorer/theme.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/select2/select2.full.min.js"></script>        
            <script type="text/javascript" src="<?php echo base_url(); ?>include_files/admin/plugins/taginput/js/bootstrap-tagsinput.js"></script>
            <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
            <script>
                $(".select2").select2();
                $(document).ready(function () {
                var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');



                navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                $item = $(this);

                if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-danger').addClass('btn-default');
                $item.addClass('btn-primary').removeClass('btn-default');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
                }
                });

                allPrevBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

                prevStepWizard.removeAttr('disabled').trigger('click');
                });

                allNextBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url'],input[type='email'],textarea[type='text'],select[name='category']"),
                isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
                }

                if (isValid)
                nextStepWizard.removeClass('disabled').trigger('click');
                });

                $('div.setup-panel div a.btn-danger').trigger('click');
                });

            </script>
            <script type="text/javascript">
                $(document).on('ready', function () {
                var total_earning = 0;
                var business_id = $('#edit_id').val();
                $('.close').click(function () {
                $(this).parents('.oldimage .col-md-3').remove();
                $(this).closest('input').remove();
                });
                var dual_timings = $('#dual_timings').is(':checked');
                $("#input-3").fileinput({
                uploadUrl: '/file-upload-batch/2',
                uploadAsync: false,
                overwriteInitial: false,
                initialPreviewAsData: true,
                purifyHtml: true,
                maxFilePreviewSize: 10240,
                allowedFileExtensions: ["jpg", "png", "gif"],
                previewFileType: "image",
                removeClass: "btn btn-warning",
                removeLabel: "Delete",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                browseClass: "btn btn-danger",
                browseLabel: "Pick Image",
                browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
                });
                if (dual_timings === true) {
                $('#dual_timings_check').show();
                } else {
                $('#dual_timings_check').hide();
                }
                $(".select2").select2();
                $('#find_duplicates').hide();
                $('#pincode, #mobile_no, #other_no, #year_establishment, #landline_code, #mobile_code, #other_code').on('change keyup', function () {
                var sanitized = $(this).val().replace(/[^-.0-9]/g, '');
                sanitized = sanitized.replace(/(.)-+/g, '$1');
                sanitized = sanitized.replace(/\.(?=.*\.)/g, '');
                $(this).val(sanitized);
                });
                $("#landline_no, #mobile_no, #other_no").on('change paste keyup input', function () {
                var landline_no = $("#landline_no").val();
                var mobile_no = $("#mobile_no").val();
                var other_no = $("#other_no").val();
                $.ajax({
                url: "<?php echo base_url(); ?>reseller/check_duplicates/",
                type: "POST",
                data: {landline_no: landline_no, mobile_no: mobile_no, other_no: other_no},
                dataType: "JSON",
                success: function (data)
                {
                if (data > 0) {
                $('#btn-step-1').attr('disabled', true);
                $('#find_duplicates').show();
                } else {
                $('#btn-step-1').attr('disabled', false);
                $('#find_duplicates').hide();
                }
                }
                });
                });
                $('#dual_timings').change(function () {
                if ($(this).is(':checked')) {
                $('#dual_timings_check').show();
                } else {
                $('#dual_timings_check').hide();
                }
                });
                $("#copy_timings").click(function () {
                if ($(this).is(':checked')) {
                var from_time = $('#from_timings-0').val();
                var to_time = $('#to_timings-0').val();
                $('#from_timings-1').val(from_time);
                $('#from_timings-2').val(from_time);
                $('#from_timings-3').val(from_time);
                $('#from_timings-4').val(from_time);
                $('#from_timings-5').val(from_time);
                $('#from_timings-6').val(from_time);
                $('#to_timings-1').val(to_time);
                $('#to_timings-2').val(to_time);
                $('#to_timings-3').val(to_time);
                $('#to_timings-4').val(to_time);
                $('#to_timings-5').val(to_time);
                $('#to_timings-6').val(to_time);
                }
                });
                $("#copy_timings_dual").click(function () {
                if ($(this).is(':checked')) {
                var from_time = $('#from_timings_1-0').val();
                var to_time = $('#to_timings_1-0').val();
                $('#from_timings_1-1').val(from_time);
                $('#from_timings_1-2').val(from_time);
                $('#from_timings_1-3').val(from_time);
                $('#from_timings_1-4').val(from_time);
                $('#from_timings_1-5').val(from_time);
                $('#from_timings_1-6').val(from_time);
                $('#to_timings_1-1').val(to_time);
                $('#to_timings_1-2').val(to_time);
                $('#to_timings_1-3').val(to_time);
                $('#to_timings_1-4').val(to_time);
                $('#to_timings_1-5').val(to_time);
                $('#to_timings_1-6').val(to_time);
                }
                });
                $('#category').change(function () {
                var category_id = $('#category').val();
                $.ajax({
                url: "<?php echo base_url(); ?>reseller/subcategories/",
                type: "POST",
                data: {category_id: category_id},
                dataType: "JSON",
                success: function (data)
                {
                $('#subcategory').empty();
                $('#subcategory').html('<option value="">Select Subcategory</option>');
                $.each(data, function (index, value) {
                $('#subcategory').append($('<option>').text(value.name).attr('value', value.id));
                });
                }
                });
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
                function add_more_contacts() {
                $.ajax({
                url: "<?php echo base_url(); ?>auth/add_more_contacts/",
                type: "POST",
                data: {},
                dataType: "JSON",
                success: function (data)
                {
                $('#add_more_contactinfo').append(data);
                }
                });
                }
                function set_closed(from_id, to_id) {
                $('#' + from_id).val("Closed");
                $('#' + to_id).val("Closed");
                }
                $(document).on('ready', function () {
                $("#input-2").fileinput({
                previewFileType: "image",
                browseClass: "btn btn-danger",
                browseLabel: "Pick Image",
                browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
                removeClass: "btn btn-warning",
                removeLabel: "Delete",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                uploadClass: "btn btn-info",
                uploadLabel: "Upload",
                uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
                allowedFileExtensions: ["jpg", "png", "gif"],
                defaultPreviewContent: '<img src="<?php echo base_url(); ?>include_files/<?php echo (!empty($businessinfo)) ? 'banners/' . $businessinfo['banner'] . '' : 'resseller/plugin/imageupload/img/noimage.jpg' ?>" alt="Your Avatar" style="width:160px;margin:0 auto;display:block">',
                minImageWidth: 800,
                minImageHeight: 500
                });
                var btnCust = '';
                $("#input-1").fileinput({
                previewFileType: "image",
                browseClass: "btn btn-danger",
                browseLabel: "Pick Image",
                browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
                removeClass: "btn btn-warning",
                removeLabel: "Delete",
                removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
                uploadClass: "btn btn-info",
                uploadLabel: "Upload",
                uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> ",
                allowedFileExtensions: ["jpg", "png", "gif"],
                defaultPreviewContent: '<img src="<?php echo base_url(); ?>include_files/<?php echo (!empty($businessinfo)) ? 'logo/' . $businessinfo['logo'] . '' : 'resseller/plugin/imageupload/img/noimage.jpg' ?>" alt="Your Avatar" style="width:160px;margin:0 auto;display:block">',
                maxImageWidth: 80,
                maxImageHeight: 80
                });
                });
            </script>
    </body>
</html>