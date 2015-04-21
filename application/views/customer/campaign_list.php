<?php
//print_r( $_cl[0]);
?>
<section class="panel customerinfo">
    <header class="panel-heading">
        <dl>
            <dt><a href="<?php echo base_url().'home/member/'.$_cl[0]['cust_sn'];?>" target="_blank"><?php echo $_cl[0]['cust_first_name'];?></a></dt>
            <dd><span>Card No:</span> <?php echo $_cl[0]['cust_card_id'];?></dd>
            <dd><span>Car Number:</span> <?php echo $_cl[0]['cust_car_no'];?></dd>
        </dl>
    </header>
</section>

<section class="panel">
    <header class="panel-heading">
        Campaign List
    </header>
    <div class="list-group">
        <?php
        
        foreach($_cl as $row):                    
            $_today= strtotime("now");            
            $_expire=$row['expire_date'];                        
            $sec_diff   =  $_expire-$_today;
            $_diff=  ($sec_diff/3600)/24;
            
            
            
            if($row['cmpn_type']!=''){
                
            switch ($row['cmpn_type']):
                case 'visit':
                    $_type='Visits - '.$row['cust_balance'].' left';
                    //$_type='Visits';
                    $_seturl='customer/campaign_visit_activate';
                    break;
                case 'session':
                    $_type='Sessions - '.$row['cust_balance'].' left';
                    //$_type='Sessions';
                    $_seturl='customer/campaign_sessions_redeem';
                    break;
                case 'giftcard':
                    $_type='Gift Card - Balance $'.number_format($row['cust_balance'],2,'.',',').' left';
                    //$_type='Gift Card';
                    $_seturl='customer/campaign_giftcard';
                    break;
            endswitch;
            
            if($_diff>0){            
            ?>
                <a class="list-group-item cmlist_submit" href="#">
                <?php 
            }//diff control
            else{
                echo '<div style="padding:10px 20px;">';
            }
            ?>    
                    <h4 class="list-group-item-heading"><?php echo $row['cmpn_name'];?></h4>
                    <p class="list-group-item-text"><?php echo $_type;?></p>
                    <p class="list-group-item-text">Expire Date: <?php echo date('d M, Y',$row['expire_date']);?></p>
                
                    <form method="POST" class="newform"
                      action="<?php echo base_url().$_seturl;?>">    
                        <input type="hidden" name="subs_sn" value="<?php echo $row['subs_sn'];?>">
                        <input type="hidden" name="cmpn_sn" value="<?php echo $row['cmpn_sn'];?>">
                        <input type="hidden" name="cmpn_type" value="<?php echo $row['cmpn_type'];?>">
                        <input type="hidden" name="cust_sn" value="<?php echo $row['cust_sn'];?>">
                        <input type="hidden" name="cmpn_name" value="<?php echo $row['cmpn_name'];?>">
                        <input type="hidden" name="cmpn_visit_active_button" value="<?php echo $row['cmpn_visit_active_button'];?>">
                        <input type="hidden" name="cust_name" value="<?php echo $row['cust_first_name'];?>">
                        <input type="hidden" name="cust_card_no" value="<?php echo $row['cust_card_id'];?>">
                        <input type="hidden" name="cust_car_no" value="<?php echo $row['cust_car_no'];?>">
                        <input type="hidden" name="balance" value="<?php echo $row['cust_balance'];?>">
                    </form>
                <?php
                if($_diff>0){
                ?>
                </a>
            <?php 
                }//end diff control
                else{
                    echo '</div>';
                }
            }//end if
        endforeach;
        ?>
    </div>
</section>
<script>require(['page/campaign_list']);</script>