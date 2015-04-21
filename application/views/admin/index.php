
    <li class="active"><?php echo $_page_title;?></li>
</ul>

<section class="panel">
    <header class="panel-heading">Page List</header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <dl>
                    <dt><a href="<?php echo base_url().'customer';?>"><i class="fa fa-user"></i> Customer</a></dt>
                    <dd><a href="<?php echo base_url().'customer/add';?>">Add Customer</a></dd>                                        
                </dl>
            </div>
            <div class="col-md-3">
                <dl>
                    <dt><a href="<?php echo base_url().'campaign';?>"><i class="fa fa-bullhorn"></i> Campaign</a></dt>
                    <dd><a href="<?php echo base_url().'campaign/add';?>">Add Campaign</a></dd>                    
                </dl>
            </div>
            <div class="col-md-3">
                <dl>
                    <dt><a href="<?php echo base_url().'outlet';?>"><i class="fa fa-building-o"></i> Outlet</a></dt>
                    <dd><a href="<?php echo base_url().'outlet/add';?>">Add Outlet</a></dd>                    
                </dl>
            </div>
            <div class="col-md-3">
                <dl>
                    <dt><i class="fa fa-bar-chart-o"></i> Report</dt>
                    <dd><a href="<?php echo base_url().'report/signups';?>">New Signups</a></dd>
                    <dd><a href="<?php echo base_url().'report/transactions';?>">Transactions</a></dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                
            </div>
        </div>
    </div>
</section>
<!--notification start-->
<?php /*
<section class="">
    <div class="-body">
        <div class="alert alert-success alert-block fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <h4>
                <i class="fa fa-ok-sign"></i>
                Success!
            </h4>
            <p>Best check yo self, you're not looking too good...</p>
        </div>
        <div class="alert alert-block alert-danger fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
        </div>
        <div class="alert alert-success fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Well done!</strong> You successfully read this important alert message.
        </div>
        <div class="alert alert-info fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
        </div>
        <div class="alert alert-warning fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Warning!</strong> Best check yo self, you're not looking too good.
        </div>

    </div>
</section>*/?>
<!--notification end-->