<div class='av-customer-details-campaign'>
    
<?php

if(count($_visit_subs)>0){ ?>
<section class="panel">
    <div class="panel-heading">Campaigns Subscribe to (Visits)</div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="campaignname">Campaign Name</th>
                <th>Visits</th>
                <th>Expiry</th>                
            </tr>
        </thead>
        <tbody>
            <?php

            foreach($_visit_subs as $row):                 
                
                ?>
            <tr id='row_<?php echo $row['cmpn_sn'];?>'>
                <td class='name'><?php echo $row['cmpn_name'];?></td>
                <td><?php echo $row['cust_balance'];?></td>
                <td><?php echo date('d M, Y',$row['expire_date']);?></td>                
            </tr>
                <?php
            endforeach;
            ?>
            
        </tbody>
    </table>  
</section>
    <?php
}//end if visit type

if(count($_session_subs)>0){ ?>
    <section class="panel">
        <div class="panel-heading">Campaigns Subscribe to (Sessions)</div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="campaignname">Campaign Name</th>
                    <th>Balance</th>
                    <th>Expiry</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach($_session_subs as $row):       
                    
                    ?>
                <tr id='row_<?php echo $row['cmpn_sn'];?>'>
                   <td  class='name'><?php echo $row['cmpn_name'];?></td>
                    <td><?php echo number_format($row['cust_balance'],2,'. ',', ');?></td>
                    <td><?php echo date('d M, Y',$row['expire_date']);?></td>
                </tr>
                    <?php
                endforeach;
                ?>                
            </tbody>
        </table>
    </section>
    <?php
}//end if _session_subs

if(count($_gift_subs)>0){  ?>
    <section class="panel">
        <div class="panel-heading">Campaigns Subscribe to (Gift)</div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="campaignname">Campaign Name</th>
                    <th>Balance</th>
                    <th>Expiry</th>                    
                </tr>
            </thead>
            <tbody>
       <?php
                
                foreach($_gift_subs as $row):                    
                    ?>
                <tr id='row_<?php echo $row['cmpn_sn'];?>'>
                   <td  class='name'><?php echo $row['cmpn_name'];?></td>
                    <td>$<?php echo number_format($row['cust_balance'],0,'.',', ');?></td>
                    <td><?php echo date('d M, Y',$row['expire_date']);?></td>                    
                </tr>
                    <?php
                endforeach;
                ?> 
            </tbody>
        </table>                           
    </section>
    <?php
}///end fi _gift_subs

?>
    
</div>