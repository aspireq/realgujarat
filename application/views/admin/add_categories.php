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
                            <h4 class="page-title">Categories</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Categories</li>
                            </ol>
                        </div>

                    </div>                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">Categories</h3>
                                <hr>                                
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" >
                                    <?php
                                    if ($message != "") {
                                        ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $message; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="col-md-12">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="<?php echo (!empty($category_info) && $category_info['name'] != "") ? $category_info['name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Image [Standard : 64 * 64]</label>
                                        <div class="col-sm-12">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="image" id="image">
                                                </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" for="example-email">Description</label>
                                        <div class="col-md-12">
                                            <textarea id="description" name="description" class="form-control" placeholder="Description for category"  rows="4" ><?php echo (!empty($category_info) && $category_info['description'] != "") ? $category_info['description'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo (!empty($category_info) && isset($category_info['id'])) ? $category_info['id'] : "" ?>">
                                    <input type="hidden" name="old_image" id="old_image" value="<?php echo (!empty($category_info) && isset($category_info['image'])) ? $category_info['image'] : "" ?>">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <button type="button" class="btn btn-inverse waves-effect waves-light" onclick="window.location.href = '<?php echo base_url(); ?>auth_admin/categories'">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $footer; ?>
            </div>            
        </div>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/js/jasny-bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>include_files/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>        
    </body>
</html>