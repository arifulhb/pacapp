
<li><a href="<?php echo base_url() . 'campaign'; ?>">Campaign</a></li>
<li class="active">View Campaign</li>
</ul>
<form class="form-horizontal" role="form">
    <section class="panel">
        <header class="panel-heading clearfix">
            Campaign Details
            <a class="btn btn-primary pull-right" href="<?php echo base_url().'campaign/edit/'.$_record[0]['cmpn_sn'];?>" role="button">Edit this Campaign</a>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCampaignName" class="col-lg-3 col-sm-3 control-label">Name</label>
                        <p class="form-control-static"><?php echo $_record[0]['cmpn_name'];?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputCampaignType" class="col-lg-3 col-sm-3 control-label">Campaign Type</label>
                        <div class="col-lg-9">
                            <p class="form-control-static">                                
                                <?php 
                                switch ($_record[0]['cmpn_type']){
                                    case 'visit':
                                        echo 'Visits';
                                        break;
                                    case 'session':
                                        echo 'Sessions';
                                        break;
                                    case 'giftcard':
                                        echo 'Gift Cards';
                                        break;
                                }//end switch                                
                                ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>        
    
    <?php
    switch ($_record[0]['cmpn_type']){
        case 'visit':?>
    <section class="panel type-visit">
        <header class="panel-heading">Visits</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputVisitActivateButton" class="col-lg-3 col-sm-3 control-label">Activate Button</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_record[0]['cmpn_visit_active_button'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-9">
                            <p class="form-control-static">
                                <?php echo $_record[0]['cmpn_expire_duration'].' '.
                                ucfirst($_record[0]['cmpn_duration_type']);
                                echo $_record[0]['cmpn_expire_duration']>1?'s':'';?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <?php
            break;
        case 'session':?>
    <section class="panel type-session">
        <header class="panel-heading">Sessions</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    Redemption:
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sessions</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($_session_record as $row): ?>
                            <tr>
                                <td><?php echo $row['red_sessions'];?></td>
                                <td><?php echo $row['red_name'];?></td>
                                <td><?php echo $row['red_description'];?></td>
                            </tr>
                                <?php
                            endforeach;
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"> 
                                <?php echo $_record[0]['cmpn_expire_duration'].' '.
                                ucfirst($_record[0]['cmpn_duration_type']);
                                echo $_record[0]['cmpn_expire_duration']>1?'s':'';?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <?php
            break;
        case 'giftcard':?>
    <section class="panel type-giftcard">
        <header class="panel-heading">Gift Cards</header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-sm-3 control-label">Expiry Duration</label>
                        <div class="col-lg-9">
                            <p class="form-control-static">
                                <?php echo $_record[0]['cmpn_expire_duration'].' '.
                                ucfirst($_record[0]['cmpn_duration_type']);
                                echo $_record[0]['cmpn_expire_duration']>1?'s':'';?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <?php
            break;
    }//end switch
    ?>    
        
</form>
<!-- page end-->