
<li><a href="<?php echo base_url().'campaign';?>">Campaign</a></li>
<li class="active"><?php echo $_action=='add'?'Add New':'Update';?> Campaign</li>
</ul>
<?php 
    
    if($_action=='update'){         
        $_name      = $_record[0]['cmpn_name'];
        $_type    = $_record[0]['cmpn_type'];
        $_duration    = $_record[0]['cmpn_expire_duration'];
        $_duration_type   = $_record[0]['cmpn_duration_type'];
        $_button  = $_record[0]['cmpn_visit_active_button'];        
        
    }//end if
    else{
        
        $_name      = '';
        $_type      = '';
        $_duration  = '';
        $_duration_type = '';
        $_button  = '';        
    }
    ?>

<form class="form-horizontal" role="form"  method="POST"
              action="<?php echo base_url().'campaign/save';?>" >
    <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>"/>
 
    <section class="panel">
        <header class="panel-heading clearfix">
            <?php 
            if($_action=='update'){
            ?>
            <input type="hidden" id="_sn" name="_sn" value="<?php echo $_sn;?>"/>
            Update Campaign
            <?php }else{ ?>
            Add New Campaign
                <?php
            } ?>
            
        </header>
        <div class="panel-body">
            <?php
        if(isset($_error)){ ?>
            <div class="alert alert-warning fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Warning!</strong><br>
            <?php echo $_error;?>
        </div>
            <?php            
            //echo ' here too';
            $_name      = '';
            $_type      = '';
            $_duration  = '';
            $_duration_type = '';
            $_button  = '';      
        }//end error
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCampaignName" class="col-lg-3 col-sm-3 control-label">Name *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputCampaignName" name="inputCampaignName"
                                   placeholder="Campaign Name" value="<?php echo $_name;?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCampaignType" class="col-lg-3 col-sm-3 control-label">Campaign Type</label>
                        <div class="col-lg-9">
                            <?php
                            if($_action=='add'){ ?>
                                                                
                                <select class="form-control selectcampaigntype" 
                                        name="inputCampaignType" id="inputCampaignType">
                                                <option value="">Select Campaign Type</option>
                                                <option value="visit" selected="">Visits</option>
                                                <option value="session">Sessions</option>
                                                <option value="giftcard">Gift Card</option>
                                            </select>
                                <?php                                
                            }else{ ?>
                                
                            <input type=hidden name="inputCampaignType" value="<?php echo $_type;?>">
                            <label class="col-lg-3 col-sm-3 control-label disabled">
                                <?php
                                        switch ($_type):
                                            case 'visit':
                                                echo 'Visits';
                                                break;
                                            case 'session':
                                                echo 'Sessions';
                                                break;
                                            case 'giftcard':
                                                echo 'Gift Card';
                                                break;
                                        endswitch;
                                ?>
                            </label>                            
                            <?php
                            }//end else
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    
        switch ($_type):
            case 'visit': ?>
                
            <section class="panel">
            <header class="panel-heading">Visits</header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputVisitActivateButton" class="col-lg-3 col-sm-3 control-label">Activate Button *</label>
                            <div class="col-lg-9">                            
                                <input type="text" class="form-control" id="inputVisitActivateButton" 
                                       value="<?php echo $_record[0]['cmpn_visit_active_button'];?>" name="inputVisitActivateButton" placeholder="Activate Button">                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name="inputExpireDuration" 
                                       value="<?php echo $_record[0]['cmpn_expire_duration'];?>"placeholder="Number of" required>
                            </div>
                            <div class="col-lg-5">                            
                                 <select class="form-control" name="inputExpireDurationType" id="inputExpireDurationType">
                                <option <?php echo $_record[0]['cmpn_duration_type']=='days'?'SELECTED':'';?> value="day">Days</option>
                                <option <?php echo $_record[0]['cmpn_duration_type']=='month'?'SELECTED':'';?> value="month">Months</option>
                                <option <?php echo $_record[0]['cmpn_duration_type']=='year'?'SELECTED':'';?> value="year">Years</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                <?php
            break;
            case 'session': ?>
                <section class="panel">
        <header class="panel-heading">Sessions</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    Redemption: 
                    <input type="hidden" id="totalRedumSessions" name="totalRedumSessions" value="<?php echo count($_session_record);?>">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sessions</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="sessionRedemLevelWrap">
                            <?php
                            $i=1;
                            foreach($_session_record as $row): ?>
                                    <tr id="row_<?php echo $i;?>">
                                        <input type="hidden" id="red_sn_<?php echo $i;?>" 
                                               name="red_sn_<?php echo $i;?>" value="<?php echo $row['redem_sn'];?>"/>
                                        <td><input type="number" class="form-control"  name="red_session_<?php echo $i;?>" 
                                             value="<?php echo $row['red_sessions'];?>"  step="any" novalidate/></td>
                                        <td><input type="text" class="form-control" name="red_name_<?php echo $i;?>" 
                                                   value="<?php echo $row['red_name'];?>" placeholder="Name" maxlength="50"></td>
                                        <td><input type="text" class="form-control" name="red_desc_<?php echo $i;?>" 
                                                   value="<?php echo $row['red_description'];?>" placeholder="Description"></td>
                                        <td>
                                            <div class="input-group">
                                            <label class="checkbox" id="checkbox<?php echo $i;?>">
                                                <input type="checkbox" id="rem_check_<?php echo $i;?>" style="margin-top: 7px;"> Remove 
                                                <button type="button" value="<?php echo $i;?>" title="Remove"
                                                    class="btn btn-sm btn-danger btn-remove-redses"><i class="fa fa-trash-o"></i></button>
                                            </label>                                                                                                                                                
                                             </div>
                                        </td>
                                    </tr>                        
                                <?php
                                $i++;
                            endforeach;
                            ?>                            
                        </tbody>
                    </table>
                    <p class="pull-right">
                        <button type="button" class="btn btn-link" id="btnAddRedemLevel">
                            <i class="fa fa-file-text-o"></i> Add a Redemption Level</button>                        
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-4">
                            <div id="sessionTypeExpDuration">
                                <input type="number" class="form-control" name="inputExpireDuration" 
                                       value="<?php echo $_record[0]['cmpn_expire_duration'];?>"placeholder="Number of" required>
                                
                            </div>
                            
                        </div>
                        <div class="col-lg-5">
                            <select class="form-control" name="inputExpireDurationType" id="inputExpireDurationType">
                                <option <?php echo $_record[0]['cmpn_duration_type']=='days'?'SELECTED':'';?> value="day">Days</option>
                                <option <?php echo $_record[0]['cmpn_duration_type']=='month'?'SELECTED':'';?> value="month">Months</option>
                                <option <?php echo $_record[0]['cmpn_duration_type']=='year'?'SELECTED':'';?> value="year">Years</option>
                            </select>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>                
                <?php                
            break;
            case 'giftcard': ?>    
                <section class="panel ">
            <header class="panel-heading">Gift Cards</header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name="inputExpireDuration" 
                                       value="<?php echo $_record[0]['cmpn_expire_duration'];?>"placeholder="Number of" required>
                            </div>
                            <div class="col-lg-5">
                                  <select class="form-control" name="inputExpireDurationType" id="inputExpireDurationType">
                                <option <?php echo $_record[0]['cmpn_duration_type']=='days'?'SELECTED':'';?> value="day">Days</option>
                                <option <?php echo $_record[0]['cmpn_duration_type']=='month'?'SELECTED':'';?> value="month">Months</option>
                                <option <?php echo $_record[0]['cmpn_duration_type']=='year'?'SELECTED':'';?> value="year">Years</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>                  
                <?php                                
            break;
            default: ?>
      
    <section class="panel campaigntype type-visit" style="display: none;">
        <header class="panel-heading">Visits</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputVisitActivateButton" class="col-lg-3 col-sm-3 control-label">Activate Button *</label>
                        <div class="col-lg-9">                            
                            <input type="text" class="form-control" id="inputVisitActivateButton" 
                                   name="inputVisitActivateButton" placeholder="Activate Button">                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-4">
                            <div id="visitTypeExpDuration"></div>
                        </div>
                        <div class="col-lg-5">                            
                            <div id="visitTypeExpDurationType"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="panel campaigntype type-session"  style="display: none;">
        <header class="panel-heading">Sessions</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    Redemption:
                    <input type="hidden" id="totalRedumSessions" name="totalRedumSessions" value="1">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Sessions</td>
                                <td>Name</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody id="sessionRedemLevelWrap">
                        
                            <tr>
                                <td><input type="number" class="form-control" name="red_session_1" step="any" novalidate/></td>
                                <td><input type="text" class="form-control" name="red_name_1" placeholder="Name" maxlength="50"></td>
                                <td><input type="text" class="form-control" name="red_desc_1" placeholder="Description"></td>
                            </tr>                        
                        </tbody>
                    </table>
                    <p class="pull-right">
                        <button type="button" class="btn btn-link" id="btnAddRedemLevel">
                            <i class="fa fa-file-text-o"></i> Add a Redemption Level</button>                        
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-4">
                            <div id="sessionTypeExpDuration"></div>
                            
                        </div>
                        <div class="col-lg-5">
                            <div id="sessionTypeExpDurationType"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="panel campaigntype type-giftcard" style="display: none;">
        <header class="panel-heading">Gift Cards</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-4">
                            <div id="giftcardTypeExpDuration"></div>                            
                        </div>
                        <div class="col-lg-5">
                            <div id="giftcardTypeExpDurationType"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>      
            <?php
            break;
        endswitch;
    
    ?>
  
      <section class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <input type="submit" class="finish btn btn-primary" value="<?php echo ucfirst($_action);?> Campaign">
                    </p>
                </div>
            </div>
        </div>
    </section>
</form>

<script> require(['page/campaign_add']); </script> 