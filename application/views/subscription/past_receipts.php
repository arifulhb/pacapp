
<section class="panel panel-info">
    <div class="panel-heading">Past Receipts <small>(Subscriptions Only)</small></div>
    <div class='panel-body'>
        <?php //print_r($_list);?>
        <table class="table table-bordered  table-condensed table-responsive table-striped table-hover"
               style="font-size: 0.9em;">
            <thead>
                <tr>
                    <th style="width: 195px;">Date</th>
                    <th style="">Subs' No</th>
                    <th>Customer</th>
                    <th>Plan</th>
                    <th>Start</th>
                    <th>Expire</th>                    
                    <th style="width: 100px;">Current Balance</th>           
                    <th>Bill No</th>          
                    <th>Bill Amount</th>          
                             
                </tr>
            </thead>
            <tbody>
                <?php 
                
                foreach($_list as $row):
                    
                    if($row['subs_status']=='approved'){
                        $_class='';
                    }elseif($row['subs_status']=='pending'){
                        $_class='';//warning
                    }
                    ?>
                    <tr class="<?php echo $_class;?>">
                        <td>
                            <a href="<?php echo base_url().'subscription/receipt/'.$row['subs_sn'].'?status='.$row['subs_status'];?>"
                               title="Print Receipt">
                            <?php echo $row['req_date']!=''?date('d M, Y h:s a',$row['req_date']):'';?>
                                </a>
                        </td>
                        <td><a href='<?php echo base_url().'subscription/receipt/'.$row['subs_sn'].'?status='.$row['subs_status'];?>'
                               title="Print Receipt"><?php echo $row['subs_sn'];?></a>
                        </td>
                        <td> <a href="<?php echo base_url().'home/member/'.$row['cust_sn'];?>"
                                       title="View Member">
                            <?php echo $row['cust_first_name'];?>
                                       </a>
                        </td>
                        <td><?php echo $row['cmpn_name'];?></td>
                        <td><?php echo date('d M, Y',$row['start_date']);?></td>
                        <td><?php echo date('d M, Y', $row['end_date']);?></td>
                        <td><?php echo $row['cust_balance'];?></td>
                        <td><?php echo $row['subs_bill_no'];?></td>
                        <td><?php echo $row['subs_bill_amount'];?></td>
                    </tr>
                    <?php
                endforeach;
                ?>                
            </tbody>
        </table>
    </div>
</section>