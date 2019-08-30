
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
                            <p class="form-control-static"><?php echo $_record[0]['cmpn_name'];?></p>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Outlet</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_record[0]['ol_name'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">User</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_record[0]['user_name'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 col-md-3 control-label">Expiry Date</label>
                        <div class="col-lg-5 col-sm-9 col-md-5">
                            <p class="form-control-static">
                                <span id="expire_date"><?php echo date('d M, Y',$_record[0]['expire_date']);?> </span>

                                <button type="button" class="btn btn-danger change_expire_date btn-xs"
                                        data-date-format="yyyy-mm-dd"
                                        data-date="<?php echo date('Y-m-d',$_record[0]['expire_date']);?>">
                                        <i class="fa fa-edit"></i>
                                </button>
                                <br>
                                <div class="form-group">

                                    <div id="changeDateWell" class="well well-sm" style="display: none;">
                                        <div class="input-group">
                                            <input  type="text" id="newExpireDate" style="display: none;"
                                                    data-inputmask="'alias': 'date'"    class="form-control" maxlength="12"
                                                    value="<?php echo date('Y-m-d',$_record[0]['expire_date']);?>">

                                             <span class="input-group-btn">
                                                <button type="button" class="btn btn-info"
                                                    id="update_expire_date" style="display: none;"
                                                    value="<?php echo $_record[0]['subs_sn'];?>">
                                                    <i class="fa fa-upload"></i> Update</button>
                                                 <button class="btn btn-default" type="button"
                                                     id="btnCloseExpireDateUpdate">Cancel</button>
                                             </span>
                                        </div>
                                        <p class="text-center"><br>
                                            <label  style="font-size: 2em;"
                                                    class="text-info txt-date"></label>
                                        </p>

                                    </div>
                                    <p>
                                        <label id="updateSuccess" class="label label-success" style="display: none;"
                                            >Expire Date updated successfully!</label>
                                    </p>


                                </div>
                                <!--<input type="hidden" id="newExpireDate" value="">
                                <button type="button" class="btn btn-info btn-xs" id="update_expire_date" style="display: none;"
                                        value="<?php /*echo $_record[0]['subs_sn'];*/?>"><i class="fa fa-upload"></i> Update</button>
                                <br>   <br>   
                                <label id="updateSuccess" class="label label-success" style="display: none;"
                                       >Expire Date updated successfully!</label>-->
                            </p>
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

<section class="panel visits">
    <div class="panel-heading">
        <?php
                switch ($_record[0]['cmpn_type']):
                    case 'visit':
                        $_camp_type='Visits';                        
                    break;
                    case 'session':
                        $_camp_type='Sessions';                        
                        break;
                    case 'giftcard':
                        $_camp_type='Gift Cards';                        
                        break;
                endswitch;   
                
                //PRINT HEADLINE
                echo $_camp_type;
        ?>        
        <input type="hidden" id="_cmpn_type" value="<?php echo $_record[0]['cmpn_type'];?>">
    </div>
    <div class="panel-body">
        <form action="#">
            <input type='hidden' id='cust_sn' value="<?php echo $_sn;?>">
            <input type='hidden' id='cmpn_sn' value="<?php echo $_cmpn_sn;?>">
            <input type='hidden' id='subs_sn' value="<?php echo $_record[0]['subs_sn'];?>">
            <div class="row">
                <div class="col-md-4 col-md-offset-1 text-center">
                    <div class="form-group">
                        <label for="">Add <?php echo $_camp_type;?></label>
                        <input type="number" id="add_value" class="form-control"  step="any" novalidate="">
                    </div>
                    <button type="button" id='btn-add' class="btn btn-primary">Add</button>
                </div>
                <div class="col-md-4 col-md-offset-1 text-center">
                    <div class="form-group">
                        <label for="">Deduct <?php echo $_camp_type;?></label>
                        <input type="number" id="deduct_value" class="form-control">
                    </div>
                    <button type="button" id='btn-deduct' class="btn btn-danger">Deduct</button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="panel">
    <table id="flip-scroll" class="table table-striped table-hover">
        <thead>
            <tr>
                <th><i class=" fa fa-edit"></i></th>
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
                    <td>
                        <button class="btn btn-danger remove-transection btn-xs"
                                value="<?php echo $row['trn_sn'];?>">
                            <i class="fa fa-trash-o "></i></button>
                    </td>
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
          Are you sure to delete <strong>Transection <span id="remove_name"></span></strong> ?
          <input type="hidden" value="" id="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" class="btn btn-danger">Remove</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script> require(['page/transection']); </script> 