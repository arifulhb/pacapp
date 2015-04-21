<section class="panel customerinfo">
    <header class="panel-heading">
        <dl>
            <dt><?php echo $cust_name?></dt>
            <dd><span>Card No:</span> <?php echo $cust_card_no;?></dd>
            <dd><span>Car Number:</span> <?php echo $cust_car_no;?></dd>
        </dl>
    </header>
</section>
<div class="row">
    <div class="col-sm-12">
        <section class="panel panel-warning">
            <header class="panel-heading text-center">Warning Message</header>
            <div class="panel-body">
                <h3 class="text-center">Sorry! Subscription of <strong><?php echo $cmpn_name;?></strong> has expired!</h3>
            </div>
        </section>
        
    </div>
</div>    