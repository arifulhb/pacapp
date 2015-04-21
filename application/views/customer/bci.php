<li><a href="<?php echo base_url() . 'customer'; ?>">Customer</a></li>
<li class="active">Block Card ID</li>
</ul>
<section class="panel">
    <div class="panel-heading">Block Card ID</div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="newCardID" class="col-md-3 control-label">Add Card ID</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="newCardID"  value=""
                           name="newCardID" placeholder="Add Card ID" maxlength="255">
                </div>
            </div> 
            <div class="form-group">
                <label for="newCardID" class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary btn-lg" id="btn-add-block-code">
                        <i class="fa fa-file-o"></i> Add</button>
                </div>
            </div> 
            <div class="form-group">
                <label for="newCardID" class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <div class="error" style="display: none;">
                            <div class="alert alert-danger alert-dismissable" style="margin-bottom: 0px;">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <p id="error_message"></p>

                            </div>
                    </div>
                    <br>
                    <div class="panel panel-warning">
                        <div class="panel-heading"><strong>Blocked Card ID List</strong></div>
                        <div class="panel-body">                            
                            <ul class="block_list">
                                <?php 
                                    foreach($_block_ids as $id): ?>
                                <li id='id_<?php echo $id['card_id'];?>'>
                                    <?php echo $id['card_id'];?> 
                                    <button class="btn btn-xs btn-link pull-right btn-danger btn-remove-block-id"
                                            value="<?php echo $id['card_id'];?>" title="Remove Card ID">
                                        <i class="fa fa-trash-o"></i></button></li>
                                    <?php
                                    endforeach;
                                    
                                    ?>
                            </ul>
                        </div>
                    </div>                                           
                </div>
            </div>
        </div>        
        
    </div>
</section>
<script> require(['page/customer_banid']); </script> 