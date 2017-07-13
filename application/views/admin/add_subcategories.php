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
                            <h4 class="page-title">Subcategories</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>auth_admin/dashboard">Dashboard</a></li>
                                <li class="active">Subcategories</li>
                            </ol>
                        </div>

                    </div>                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">Subcategories</h3>
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
                                        <label class="col-sm-12">Category</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->id; ?>" <?php echo (!empty($subcategory_info) && ($subcategory_info['category_id'] == $category->id)) ? 'selected' : ''; ?> ><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="<?php echo (!empty($subcategory_info) && $subcategory_info['name'] != "") ? $subcategory_info['name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" for="example-email">Description</label>
                                        <div class="col-md-12">
                                            <textarea id="description" name="description" class="form-control" placeholder="Description for category"  rows="4" ><?php echo (!empty($subcategory_info) && $subcategory_info['description'] != "") ? $subcategory_info['description'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo (!empty($subcategory_info) && isset($subcategory_info['id'])) ? $category_info['id'] : "" ?>">                                   
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