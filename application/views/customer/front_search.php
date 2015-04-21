<?php 
$_s=$this->input->get('by');
//echo 'keyword: '.$_s;
?>
<div class="panel panel-default">
    <div class="panel-heading">Search</div>
    <div class="panel-body">
        <form class="form-inline" method="GET" action="<?php echo base_url();?>home/search">
            <div class="form-group col-sm-3">
                <select class="form-control" id="search_by" name="by">
                    <option <?php echo ($_s=='name' ||$_s=='')?'SELECTED':'';?> value="name">Search by Name</option>
                    <option <?php echo $_s=='nric'?'SELECTED':'';?> value="nric">Search by NRIC</option>
                    <option <?php echo $_s=='card_number'?'SELECTED':'';?> value="card_number">Search by Card Number</option>
                    <option <?php echo $_s=='car_number'?'SELECTED':'';?>  value="car_number">Search by Car number</option>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <div class="input-group">
                    <input type="text" id="search_keyword" name="s" value="" class="form-control" placeholder="Customer Search Keyword">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
if(isset($_list)){ ?>
<section class="panel panel-primary">
    <div class="panel-heading">Member Search Result</div>
    <div class="panel-body">
        <table class="table table-striped table-advance table-hover table-condensed">
        <thead>
            <tr>
                <?php /*
                <th style="width: 90px!important;"><i class=" fa fa-edit"></i></th>
                */?>
                <th style="min-width: 200px;">Contact Name</th>
                <th>Card ID</th>
                <th>Campaigns</th>
                <th>Car No.</th>
                <th>Hp No.</th>
                <th style="width: 180px;">Additional Info</th>
                <th style="width: 220px!important;">Date Added.</th>
            </tr>
        </thead>
        <tbody id="customer-list">
            <?php
            foreach ($_list as $row): ?>
            <tr id='row_<?php echo $row['cust_sn'];?>'>
                <?php /*
                <td>
                    <a href="<?php echo base_url().'customer/edit/'.$row['cust_sn'].'/#subscribe';?>" 
                       title="Subscribe"
                       class="btn btn-info btn-xs"><i class="fa fa-thumb-tack"></i></a>
                    <a href="<?php echo base_url().'customer/edit/'.$row['cust_sn'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <button class="btn btn-danger remove_cust btn-xs" value='<?php echo $row['cust_sn'];?>'>
                        <i class="fa fa-trash-o "></i></button>
                </td>*/?>
                <td><a href="<?php echo base_url().'home/member/'.$row['cust_sn'];?>">
                        <span class='name'><?php echo $row['cust_first_name'].' '.$row['cust_last_name'];?></span></a></td>
                <td><?php echo $row['cust_card_id'];?></td>
                <td>
                    <?php echo $row['cmpn_name'];?>
                </td>
                <td><?php echo $row['cust_car_no'];?></td>
                <td><?php echo $row['cust_mobile'];?></td>
                <td><?php echo $row['cust_additional'];?></td>
                <td><?php echo $row['date_added']!=0?date('d M Y : h:i A',$row['date_added']):'';?></td>
            </tr>            
                <?php
            endforeach;
            ?>            
        </tbody>
    </table>
    </div>
</section>
    <?php
}//end if
?>