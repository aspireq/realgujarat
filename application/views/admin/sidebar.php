<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <!--        <div class="user-profile">  
                    <div class="dropdown user-pro-body">               
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $admininfo['uacc_username']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>auth_admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>-->
        <ul class="nav" id="side-menu">
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li> <a href="<?php echo base_url(); ?>auth_admin/dashboard" class="waves-effect"><i class="fa fa-dashboard"></i>&nbsp;<span class="hide-menu" >Dashboard</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>auth_admin/users" class="waves-effect"><i class="fa fa-user"></i>&nbsp;<span class="hide-menu" >Users</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>auth_admin/businesses" class="waves-effect"><i class="fa fa-black-tie"></i>&nbsp;<span class="hide-menu">Businesses</span></a></li>
            <li> <a href="<?php echo base_url(); ?>auth_admin/visitor_adds" class="waves-effect"><i class="fa fa-align-left"></i>&nbsp;<span class="hide-menu">Visitor Ads</span></a></li>           
            <li> <a href="<?php echo base_url(); ?>auth_admin/keywords" class="waves-effect"><i class="fa fa-ambulance"></i>&nbsp;<span class="hide-menu">Keywords</span></a></li>
            <li class="nav-small-cap m-t-10">--- Categories</li>
            <li> <a href="<?php echo base_url(); ?>auth_admin/categories" class="waves-effect"><i class="fa fa-folder"></i>&nbsp;<span class="hide-menu">Categories</span></a></li>
            <li> <a href="<?php echo base_url(); ?>auth_admin/subcategories" class="waves-effect"><i class="fa fa-folder-open"></i>&nbsp;<span class="hide-menu">Subcategories</span></a></li>

        </ul>
    </div>
</div>