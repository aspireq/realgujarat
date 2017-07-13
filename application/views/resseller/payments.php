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
                            <h3><i class="fa fa-money"></i>&nbsp;&nbsp;Payment History</h3>
                            <hr class="form-hr" />
                            <?php
                            if (!empty($results)) {
                                array_pop($results);
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Payment Mode</th>
                                            <th>Transaction Id</th>
                                            <th>Cheque No.</th>
                                            <th class="text-right">Amount</th>
                                            <th class="text-right">Tax</th>
                                            <th class="text-right">Net Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results as $data) { ?>
                                            <tr>                                       
                                                <td><?php echo date("d-m-Y", strtotime($data->date)); ?></td>
                                                <td><?php echo $data->payment_method; ?></td>
                                                <td><?php echo ($data->transaction_id != "") ? $data->transaction_id : $data->bank_transaction_id; ?></td>
                                                <td><?php echo $data->chequeno; ?></td>
                                                <td class="text-right"><?php echo $data->amount; ?></td>
                                                <td class="text-right"><?php echo ($data->tax != null) ? $data->tax.'%' : '' ; ?></td>
                                                <td class="text-right"><?php echo $data->netamount; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php
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
        <script src="<?php echo base_url(); ?>include_files/resseller/js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url(); ?>include_files/resseller/js/resseller.js"></script>   
    </body>
</html>