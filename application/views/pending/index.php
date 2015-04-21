
    <li class="active"><?php echo $_page_title;?></li>
</ul>
<?php
$is_success=$this->session->flashdata('_success');
if($is_success==true){ ?>
    <div class="alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Congratulations!</strong> Subscription data is updated.
    </div>
    <?php
}//end if
?>
<section class="panel">
    <header class="panel-heading clearfix">
        Pending Subscription List
        <?php /* 
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'outlet/add';?>" role="button">Add New Outlet</a>
         * */?>
    </header>    
    <table class="table table-striped table-advance table-hover table-responsive">
        <thead>
            <tr>
                <th style="min-width: 67px;"><i class=" fa fa-edit"></i></th>
                <th style="min-width: 140px;">Date</th>
                <th>Customer Name</th>
                <th>Type</th>
                <th>Campaign</th>                                
                <th>Duration</th>                
                <th>Sessions/<br>Amount</th>
                <th>New <br>Balance</th>                
                <th>Expire</th>                
                <th>Outlet</th>
                <th>User</th>
                <th>Bill Amount</th>
                <th style="min-width: 140px;">Action</th>
            </tr>
        </thead>
        <tbody id="pending_list">
            <?php
            foreach($_list as $row): ?>
            <tr id="row_<?php echo $row['tmp_subs_sn'];?>">
                <td>
					<div class="btn-group">
                    	<a href="<?php echo base_url().'pending/edit/'.$row['tmp_subs_sn'];?>"
					   		class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

						<button class="btn btn-remove_pending btn-danger btn-xs" value="<?php echo $row['tmp_subs_sn'];?>"
								title="Reject"><i class="fa fa-trash-o "></i>
						</button>
					</div>
                </td>                  
                <td><a href='<?php echo base_url().'pending/view/'.$row['tmp_subs_sn'];?>'>
                    <?php echo date('d M \'y h:i a',$row['subs_date']);?>
                    </a>
                    <input type="hidden" id="_date_<?php echo $row['tmp_subs_sn'];?>" 
                           value="<?php echo date('Y-m-d',$row['start_date']);?>">
                    <input type="hidden" id="_req_date_<?php echo $row['tmp_subs_sn'];?>" 
                           value="<?php echo $row['req_date'];?>">
                </td>
                <td><a href='<?php echo base_url().'customer/details/'.$row['cust_sn'];?>'
                       title="View Customer Details"><?php echo $row['cust_first_name'];?></a>
                    <input type="hidden" id="_cust_sn_<?php echo $row['tmp_subs_sn'];?>" 
                           value="<?php echo $row['cust_sn'];?>">
                </td>
                <td><?php echo $row['subs_type'];?>
                <input type="hidden" id="_subs_type_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['subs_type'];?>">
                </td>
                <td><?php echo $row['cmpn_name'];?><br><small><?php echo $row['cmpn_type'];?></small>
                <input type="hidden" id="_cmpn_sn_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['cmpn_sn'];?>">
                </td>                
                <td><?php echo $row['num_of_months'];//cmpn_expire_duration?> months</td>                
                <td><?php echo $row['tran_value'];?>
                <input type="hidden" id="_tran_value_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['tran_value'];?>">
                </td>
                <td><?php echo $row['cust_balance'];?>
                    <input type="hidden" id="_cust_balance_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['cust_balance'];?>">
                </td>
                <td><?php echo date('d M \'y',$row['expire_date']);?>
                    <input type="hidden" id="_expire_date_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo date('Y-m-d',$row['expire_date']);?>">
                </td>                
                <td><?php echo $row['ol_name'];?></td>                
                <td><?php echo $row['user_name'];?>
                <input type="hidden" id="_user_sn_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['user_sn'];?>">
                </td>
                
                <td>$<?php echo number_format($row['subs_bill_amount'],2,'.',',');?>
                    <input type="hidden" id="_subs_bill_no_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['subs_bill_no'];?>">
                    <input type="hidden" id="_subs_bill_amount_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['subs_bill_amount'];?>">
                    
                    <input type="hidden" id="_car_number_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['car_number'];?>">
                    <input type="hidden" id="_car_color_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['car_color'];?>">
                    <input type="hidden" id="_car_model_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['car_model'];?>">
                    
                    <input type="hidden" id="_remark_<?php echo $row['tmp_subs_sn'];?>" 
                       value="<?php echo $row['remark'];?>">
                </td>
                <th>
                    <div class="checkbox" style="margin: 0px;">
                            <label class="control-label check_lebel_<?php echo $row['tmp_subs_sn'];?>">
                            <input type="checkbox" id="check_<?php echo $row['tmp_subs_sn'];?>"> Approve</label>
                    <button class="btn btn-xs btn-approve btn-success" value="<?php echo $row['tmp_subs_sn'];?>"
                            title="Approve">
                        <i class="fa fa-thumbs-up"></i> Ok</button>           
                        </div>                    
                    
                </th>
            </tr>
                <?php
            endforeach;
            ?>                        
        </tbody>
    </table>
</section>
<section class="panel">
  <div class="panel-body">
      <div class="text-center">
          <?php echo $this->pagination->create_links();?>
      </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="remove_pending_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Reject Pending Subscription</h4>
      </div>
      <div class="modal-body">
          Are you sure to remove <strong> Reject Subscription <span id="remove_name"></span></strong>?
          <input type="hidden" value="" id="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" value="" class="btn btn-danger">Reject</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script> require(['page/pending_index']); </script> 