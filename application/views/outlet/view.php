
<li><a href="<?php echo base_url().'outlet';?>">Outlet</a></li>
<li class="active">Outlet Details</li>
</ul>
<?php 

$_sn        = $_record[0]['ol_sn'];
$_name      = $_record[0]['ol_name'];
$_phone     = $_record[0]['ol_phone'];
$_email     = $_record[0]['ol_email'];
$_address   = $_record[0]['ol_address_line1'];
$_address2  = $_record[0]['ol_address_line2'];
$_city      = $_record[0]['ol_city'];
$_zip       = $_record[0]['ol_zip'];
$_country_key   = $_record[0]['ol_country'];

?>
<section class="panel">
    <header class="panel-heading clearfix">
        Outlet Details
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'outlet/edit/'.$_sn;?>" role="button">Edit this Outlet</a>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutletName" class="col-lg-3 col-sm-3 control-label">Outlet Name *</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_name;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputOutletPhoneNumber" class="col-lg-3 col-sm-3 control-label">Phone Number</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><?php echo $_phone;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 col-sm-3 control-label">Email Address</label>
                        <div class="col-lg-9">
                            <p class="form-control-static"><a href="mailto:<?php echo $_email;?>" target="_blank"><?php echo $_email;?></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
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
                                <?php 
                                foreach($_country as $key=>$value):
                                    echo $key==$_country_key?$value:'';
                                endforeach;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>