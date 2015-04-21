
    <li><a href="<?php echo base_url().'customer/';?>">Customer</a></li>
    <li><a href="<?php echo base_url().'customer/details/'.$_sn;?>">Customer Details</a></li>
    <li class="active">Campaigns</li>
</ul>

<section class="panel av-customer-details">
    <header class="panel-heading clearfix">
        Customer Campaign Details
    </header>
    <div class="panel-body">
      <?php
     // print_r($_record[0]);
      ?>
        <div class="row">
            <div class="col-md-6">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Name</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_record[0]['cust_first_name'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Card ID</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_record[0]['cust_card_id'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Car Number</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_record[0]['cust_car_no'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Campaign Name</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><label><?php echo $_record[0]['cmpn_name'];?></label></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Expiry Date</label>
                        <div class="col-lg-9">
                            <p class="form-control-static">
                                <span id="expire_date"><?php echo date('d M, Y',$_record[0]['expire_date']);?> </span>                                                                                                
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 currentbalance">
                <div class="well">
                    Current Balance:
                    <p><span id="current_balance" style="font-size: 48px;">
                        <?php
                        //echo $_record[0]['cmpn_type'];
                        if($_record[0]['cmpn_type']=='session'){
                         echo number_format($_record[0]['cust_balance'],2,'.',',');   
                        }else{
                         echo $_record[0]['cust_balance'];   
                        }?></span>
                            <?php
                        switch ($_record[0]['cmpn_type']):
                            case 'visit':?>
                            <span>Visits</span>
                                <?php
                            break;
                            case 'session':?>
                            <span>Sessions</span>
                                    <?php
                                break;
                            case 'giftcard':?>
                            <span>Dollars</span>
                                    <?php
                                break;
                        endswitch;                        
                        ?>                        
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="panel">
    <table id="flip-scroll" class="table table-striped table-hover">
        <thead>
            <tr>                
                <th>Trans ID</th>
                <th>Date</th>
                <th>Activity</th>
                <th>Visits</th>
                <th>Recorded By</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody id="transections">
            <?php
            foreach($_transections as $row): ?>
                <tr id="row_<?php echo $row['trn_sn'];?>">                    
                    <td><?php echo $row['trn_sn'];?></td>
                    <td><?php echo date('d M, Y h:ia ',$row['trn_date']);?></td>
                    <td><?php echo $row['tran_activity'];?></td>
                    <td><?php echo $row['tran_value'];?></td>
                    <td><?php echo $row['user_name'];?></td>
                    <td><?php echo $row['tran_description'];?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>

</section>