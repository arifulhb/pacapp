<li class="active">Customer</li>
</ul>
<?php

$data=array();

$this->load->view('customer/search',$data);
//$this->view('customer/search',$data,true);
?>   

<section class="panel">
    <header class="panel-heading clearfix">
        Customer
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'customer/add';?>" 
           role="button">Add New Customer</a>
    </header>    
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th style="width: 90px!important;"><i class=" fa fa-edit"></i></th>
                <th>Contact Name</th>
                <th>Card ID</th>
                <th>Campaigns</th>
                <th>Car No.</th>
                <th>Hp No.</th>
                <th style="width: 180px;">Additional Info</th>
                <th style="width: 170px!important;">Date Added.</th>
            </tr>
        </thead>
        <tbody id="customer-list">
            <?php
            foreach ($_list as $row): ?>
            <tr id='row_<?php echo $row['cust_sn'];?>'>
                <td>
					<div class="btn-group">
						<a href="<?php echo base_url().'customer/edit/'.$row['cust_sn'].'/#subscribe';?>"
						   title="Subscribe"
						   class="btn btn-info btn-xs"><i class="fa fa-thumb-tack"></i></a>
						<a href="<?php echo base_url().'customer/edit/'.$row['cust_sn'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger remove_cust btn-xs" value='<?php echo $row['cust_sn'];?>'>
							<i class="fa fa-trash-o "></i></button>
					</div>
                </td>
                <td><a href="<?php echo base_url().'customer/details/'.$row['cust_sn'];?>">
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
</section>
<section class="panel">
  <div class="panel-body">
      <div class="text-center">
          <?php echo $this->pagination->create_links();?>
      </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="remove_customer_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Remove Customer</h4>
      </div>
      <div class="modal-body">
          Are you sure to delete <strong><span id="remove_name"></span></strong>?
          <input type="hidden" value="" id="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" class="btn btn-danger">Remove</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script> require(['page/customer_index']); </script> 