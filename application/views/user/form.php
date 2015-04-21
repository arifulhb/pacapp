<li><a href="<?php echo base_url().'user';?>">User</a></li>
<?php 
//print_r($_record);
//exit();
if($_action=='update'){ ?>
    <li class="active">Edit User</li>
    <?php
    $_name      = $_record[0]['user_name'];
    $_pin       = $_record[0]['user_pin'];
    $_role_sn   = $_record[0]['user_role_sn'];
    $_ol_sn     = $_record[0]['ol_sn'];    
    $_userID    = $_record[0]['user_id'];
    $_userEmail = $_record[0]['user_email'];

}//end if
else{
    ?>
        <li class="active">Add New User</li>
        <?php
    $_name      = '';
    $_pin       = '';
    $_role_sn   = '';
    $_ol_sn     = '';    
    $_userID    = '';
    $_userEmail = '';
}
?>
</ul>

<section class="panel">
    <header class="panel-heading clearfix">
        <?php echo $_action=='add'?'Add New User':'Edit User';?>
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
                        
            $_name      = $_record[0]['user_name'];
            $_pin       = $_record[0]['user_pin'];
            $_userID    = $_record[0]['user_id'];
            $_userEmail = $_record[0]['user_email'];
            $_role_sn   = $_record[0]['user_role_sn'];
            $_ol_sn     = $_record[0]['ol_sn'];    
            
        }//
        ?>
        <form class="form-horizontal" role="form" method="POST"
              action="<?php echo base_url().'user/save';?>" >
            <input type="hidden" id="_action" name="_action" value="<?php echo $_action;?>"/>
            <?php if($_action=='update'){ ?>
            <input type="hidden" id="_sn" name="_sn" value="<?php echo $_sn;?>"/>
                <?php
            }?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputUserID" class="col-lg-3 col-sm-3 control-label">Username*</label>
                        <div class="col-lg-9">
                            <?php
                            if($_userID==''){ ?>
                            <input type="text" class="form-control" id="inputUserID" maxlength="250"
                                   name="inputUserID" placeholder="User ID" value="<?php echo $_userID;?>" required="">
                                <?php
                            }else{?>
                            <label class="control-label"><?php echo $_userID;?></label>
                                <?php
                            }//end else
                            ?>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutlet" class="col-lg-3 col-sm-3 control-label">Email Address</label>
                        <div class="col-lg-9">                                                        
                            <input type="email" class="form-control" id="inputUserEmail" maxlength="250"
                                   name="inputUserEmail" placeholder="User Email" value="<?php echo $_userEmail;?>" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputUserName" class="col-lg-3 col-sm-3 control-label">Display Name *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputUserName" maxlength="250"
                                   name="inputUserName" placeholder="Display Name" value="<?php echo $_name;?>" required="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutlet" class="col-lg-3 col-sm-3 control-label">Outlet</label>
                        <div class="col-lg-9">
                            
                            <select class="form-control" id="inputOutlet" name="inputOutlet">
                                <?php 
                                foreach($_outlets as $ol): ?>
                                <option <?php echo $ol['ol_sn']==$_ol_sn?'SELECTED':'';?> 
                                    value="<?php echo $ol['ol_sn'];?>"><?php echo $ol['ol_name'];?></option>
                                    <?php
                                endforeach;
                                ?>                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutletPassword" class="col-lg-3 col-sm-3 control-label">Password *</label>
                        <div class="col-lg-9">
                            <?php
                            if($_action=='add'){
                            ?>
                            <input type="password" class="form-control" id="inputOutletPassword" name="inputOutletPassword"
                                   placeholder="Password" required="" maxlength="12">
                            <?php }else{
                                echo '<label for="inputOutletPassword" class="control-label">Can not update password</label>';
                            }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutletPin" class="col-lg-3 col-sm-3 control-label">PIN</label>
                        <div class="col-lg-9">
                            <?php
                            if($_action=='add'){
                            ?>
                            <input type="text" class="form-control" id="inputOutletPin" name="inputOutletPin"
                                   placeholder="PIN" required=""
                                   value="<?php echo $_pin;?>" maxlength="12">
                            <?php }else{
                                echo '<label for="inputOutletPassword" class="control-label">'.$_record[0]['user_pin'].'</label>';
                            }?>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">                        
                        <label for="inputOutletUserRole" class="col-lg-3 col-sm-3 control-label">User Role</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="inputUserRole" name="inputUserRole">
                                <?php
                                foreach($_roles as $r): ?>
                                <option <?php echo $r['user_role_sn']==$_role_sn?'SELECTED':'';?> 
                                    value="<?php echo $r['user_role_sn'];?>"><?php echo $r['user_role'];?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <input type="submit" class="finish btn btn-primary" value="<?php echo ucfirst($_action);?> User">
                    </p>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="panel panel-warning">
    <header class="panel-heading clearfix"><i class="fa fa-unlock-alt"></i> Change Password</header>
    <div class="panel-body">
        <div class='row'>
            <div class='col-sm-6'>
                <div class='form-horizontal'>
                  <div class="form-group">
                      <label for="up_new_password" class="col-md-4 control-label">New Password</label>
                      <div class="col-md-8">
                          <input type="password" class="form-control" id="up_new_password"  value=""
                                 name="up_new_password" placeholder="Password"  maxlength="20">
                      </div>
                  </div>            
                  <div class="form-group">
                      <label for="up_re_new_password" class="col-md-4 control-label">Re New Password</label>
                      <div class="col-md-8">
                          <input type="password" class="form-control" id="up_re_new_password"  value=""
                                 name="up_re_new_password" placeholder="Re Password" maxlength="20">
                      </div>
                  </div>            
                  <div class="form-group">
                      <label for="up_re_new_password" class="col-md-4 control-label"></label>
                      <div class="col-md-8">
                          <button type="button" class="btn btn-sm btn-default" id='change_password'>
                              <i class='fa fa-lock'></i> Change Password</button>
                      </div>
                  </div>            
                  </div>  
            </div>
            <div class='col-sm-6'>      
              <div class="error" style="display: none;">
                  <div class="alert alert-warning alert-dismissable" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p id="error_message_password"></p>
                    
                  </div>
              </div>
                <div class="success" style="display: none;">
                  <div class="alert alert-success alert-dismissable" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Congratulations!</strong> Password updated successfully.
                    
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
<section class="panel panel-default">
    <header class="panel-heading clearfix">Change PIN</header>
    <div class="panel-body">
        <div class='row'>
            <div class='col-sm-6'>
                <div class='form-horizontal'>
                  <div class="form-group">
                      <label for="up_new_pin" class="col-md-4 control-label">New PIN</label>
                      <div class="col-md-8">
                          <input type="password" class="form-control" id="up_new_pin"  value=""
                                 name="up_new_pin" placeholder="PIN"  maxlength="20">
                      </div>
                  </div>            
                  <div class="form-group">
                      <label for="up_re_pin" class="col-md-4 control-label">Re PIN</label>
                      <div class="col-md-8">
                          <input type="password" class="form-control" id="up_re_pin"  value=""
                                 name="up_re_pin" placeholder="Re PIN" maxlength="20">
                      </div>
                  </div>            
                  <div class="form-group">
                      <label for="change_pin" class="col-md-4 control-label"></label>
                      <div class="col-md-8">
                          <button type="button" class="btn btn-sm btn-default" id='change_pin'>
                              <i class='fa fa-lock'></i> Change PIN</button>
                      </div>
                  </div>            
                  </div>  
            </div>
            <div class='col-sm-6'>      
              <div class="error_pin" style="display: none;">
                  <div class="alert alert-warning alert-dismissable" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p id="error_message_password_pin"></p>
                    
                  </div>
              </div>
                <div class="success_pin" style="display: none;">
                  <div class="alert alert-success alert-dismissable" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Congratulations!</strong> PIN updated successfully.                    
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
<script> require(['page/user_form']); </script> 