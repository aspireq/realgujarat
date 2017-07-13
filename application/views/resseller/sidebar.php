<div class="col-md-3 col-sm-4 vertical-nav" id="resseller-sidebar">
    <div class="sidebar-info">
        <h3><i class="fa fa-user-circle-o"></i> <?php echo ucfirst($userinfo['uacc_username']); ?></h3>
        <p>Earnings : <span><?php echo $userinfo['earnings']; ?></span></p>
        <p>Pending Businesses : <span><?php echo $business_counts->pendingbusinesses; ?></span></p>
        <p>Approved Businesses : <span><?php echo $business_counts->approvedbusinesses; ?></span></p>
    </div>
    <ul class="list">
        <li>
            <a href="<?php echo base_url(); ?>reseller/account">Profile<span><i class="fa fa-angle-double-right"></i></span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>reseller/businesses">Your Ads<span><i class="fa fa-angle-double-right"></i></span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>reseller/payments">Payment History<span><i class="fa fa-angle-double-right"></i></span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>reseller/add_business">Submit New Ads<span><i class="fa fa-angle-double-right"></i></span></a>
        </li>
    </ul>
</div>