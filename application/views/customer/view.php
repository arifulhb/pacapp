
<li><a href="<?php echo base_url() . 'customer'; ?>">Customer</a></li>
<li class="active">Customer Details</li>
</ul>
<?php

  $_sn        = $_record[0]['cust_sn'];
  
  $_card_id      = $_record[0]['cust_card_id'];
  $_cust_id      = $_record[0]['cust_id'];  
  $_first_name      = $_record[0]['cust_first_name'];

  $_mobile       = $_record[0]['cust_mobile'];
  $_phone       = $_record[0]['cust_phone'];
  $_email       = $_record[0]['cust_email'];

  $_dob         = $_record[0]['cust_dob']==0?"":date('d M Y',strtotime($_record[0]['cust_dob']));
  $_address     = $_record[0]['cust_address_line1'];
  $_address2    = $_record[0]['cust_address_line2'];
  $_city        = $_record[0]['cust_city'];
  $_zip         = $_record[0]['cust_zip'];
  $_country_key = $_record[0]['cust_country'];
  
  $_car_no          = $_record[0]['cust_car_no'];
  $_car_model       = $_record[0]['cust_car_model'];
  $_car_color       = $_record[0]['cust_car_color'];
  $_car_additional  = $_record[0]['cust_additional'];
 
?>
<section class="panel">
    <header class="panel-heading clearfix">
        Customer Details
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'customer/edit/'.$_sn;?>" role="button">Edit this Customer</a>
    </header>
    <input type='hidden' id='cust_sn' value='<?php echo $_sn;?>'>
    <div class="panel-body">
        <form class="form-horizontal" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCardID" class="col-lg-3 col-sm-3 control-label">Card ID</label>
                        <div class="col-lg-9">
                            <label class="form-control-static"><strong><?php echo $_card_id;?></strong></label>
							<?php

								echo '<ul class="card_id_list">';
								foreach($_card_ids as $id):

									$color ='black';
									if($id['blocked_card']!=null){
										$color='red';
									}
									?>
									<li style="height: 22px;border-bottom: #eee dotted 1px; color: <?php echo $color;?>;"
										id="card_<?php echo $id['cust_card_id'];?>"><?php echo $id['cust_card_id'];?>&nbsp;
									</li>
								<?php
								endforeach;
								echo '</ul>';
							?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputIDNumber" class="col-lg-3 col-sm-3 control-label">ID Number</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_cust_id;?></p>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputFirstName" class="col-lg-3 col-sm-3 control-label">Name</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_first_name;?></p>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputMobileNo" class="col-lg-3 col-sm-3 control-label">Mobile Number</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_mobile;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputPhoneNumber" class="col-lg-3 col-sm-3 control-label">Phone Number</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_phone;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 col-sm-3 control-label">Email Address</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><a href="mailto:<?php echo $_email;?>"><?php echo $_email;?></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputBirthday" class="col-lg-3 col-sm-3 control-label">Birthday</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_dob;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-lg-3 col-sm-3 control-label">Address</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_address;?><br><?php echo $_address2;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCity" class="col-lg-3 col-sm-3 control-label">City</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_city;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputZipcode" class="col-lg-3 col-sm-3 control-label">ZipCode</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_zip;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCountry" class="col-lg-3 col-sm-3 control-label">Country</label>
                        <div class="col-lg-9">
                            <p class="form-control-static">
                               <?php foreach($_country as $key => $value): 
                                        echo $_country_key==$key?$value:'';   
                                    endforeach;
                                ?>                                 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCarNumber" class="col-lg-3 col-sm-3 control-label">Car Number</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_car_no;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCarModel" class="col-lg-3 col-sm-3 control-label">Model</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_car_model;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCarColor" class="col-lg-3 col-sm-3 control-label">Color</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_car_color;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCarColor" class="col-lg-3 col-sm-3 control-label">Additional Information</label>
                        <div class="col-lg-9">

							<table class="table table-condensed table-striped">
								<thead>
									<tr>
										<th style="width: 15%;" ">Date</th>
										<th>Campaign</th>
										<th>Car Number</th>
										<th>Car Model</th>
										<th>Activity</th>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach($_history as $row){
										?>
										<tr>
											<td><?php echo date("j M 'y", $row['trn_date']);?><br>
											<small><?php echo date('h:i:s a', $row['trn_date']);?></small></td>
											<td><?php echo $row['cmpn_name'];?></td>
											<td><?php echo $row['car_number'];?></td>
											<td><?php echo $row['car_model'];?></td>
											<td><?php echo $row['tran_description']. '<br><small>'.$row['tran_activity'].'</small>';?></td>

										</tr>
									<?php
									}
									?>

								</tbody>

							</table>
							<hr/>
							<p class="form-control-static"><?php echo $_car_additional;?></p>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="panel">
    <header class="panel-heading clearfix">Customer Subscription Requests</header>
    <div class="panel-body">
                
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Start Date</th>
                    <th>Type</th>
                    <th>Plan</th>
                    <th>Duration</th>
                    <th>New Balance</th>
                    <th>Expire Date</th>
                    <th>Outlet</th>
                    <th>User</th>
                    <th>Bill Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($_request_history as $row):?>
                <tr>
                    <td>
                        <?php                        
                        if($row['_status']=='Approved'){ ?>
                        <a href="<?php echo base_url().'subscription/view/'.$row['subs_sn'];?>"
                           title="Subscription View"><?php echo date('d M, Y',$row['subs_date']);?></a>
                            <?php
                        }else{ ?>
                        <a href="<?php echo base_url().'pending/view/'.$row['subs_sn'];?>"
                           title="Pending View"><?php echo date('d M, Y',$row['subs_date']);?></a>
                            <?php
                        }//end else
                        ?>
                        
                    </td>
                    <td>
                           <?php                        
                        if($row['_status']=='Approved'){ ?>
                        <a href="<?php echo base_url().'subscription/view/'.$row['subs_sn'];?>"
                           title="Subscription View"><?php echo $row['subs_type'];?></a>
                            <?php
                        }else{ ?>
                        <a href="<?php echo base_url().'pending/view/'.$row['subs_sn'];?>"
                           title="Pending View"><?php echo $row['subs_type'];?></a>
                            <?php
                        }//end else
                        ?>                        
                    </td>
                    <td><?php echo $row['cmpn_name'];?></td>
                    <td><?php echo $row['cmpn_expire_duration'];?> months</td>
                    <td><?php echo $row['cust_balance'];?></td>
                    <td><?php echo $row['expire_date'];?></td>
                    <td><?php echo $row['ol_name'];?></td>
                    <td><?php echo $row['user_name'];?></td>
                    <td><?php echo $row['subs_bill_amount'];?></td>
                    <td><?php echo $row['_status'];?></td>
                </tr>
                    <?php
                endforeach;
                ?>                
            </tbody>
        </table>
        <?php 
        //print_r($_request_history);
        ?>
    </div>
    
</section>
<?php 
$this->load->view('customer/customer_subscription_edit');
?>
<div class="modal fade" id="remove_customer_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Unsubscribe Campaign</h4>
      </div>
      <div class="modal-body">
          Are you sure to unsubscribe <strong><span id="remove_name"></span></strong>?
          <input type="hidden" value="" id="remove_id">          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" class="btn btn-danger">Remove</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script> require(['page/customer_subs']); </script> 