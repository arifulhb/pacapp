<section id="container">
    
<?php 

if($_page_class!='front_login'){ ?>
    <header class="header white-bg noprint">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bar"></span>
                    <span class="fa fa-bar"></span>
                    <span class="fa fa-bar"></span>
                </button>
                <!--logo start-->
                <a href="<?php echo base_url();?>home" class="logo" ><?php echo $_site_title;?></a>
                <!--logo end-->
                <div class="horizontal-menu navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>home"><i class="fa fa-plus-circle"></i> New Transaction</a></li>
                        <li><a href="<?php echo base_url();?>home/addCustomer"><i class="fa fa-user"></i> Add Member</a></li>
                        <li><a href="<?php echo base_url();?>home/existingCustomer"><i class="fa fa-user"></i> Existing Member</a></li>
                        <li><a href="<?php echo base_url();?>home/search_member"><i class="fa fa-search"></i> Search Member</a></li>
                        <li><a href="<?php echo base_url();?>home/past_receipt"><i class="fa fa-list-alt"></i> Past Receipts</a></li>                        
                    </ul>
                </div>
                <div class="top-nav ">
                    <ul class="nav pull-right top-menu">
                        <li class="dropdown">
                            <a  data-toggle="dropdown" class="dropdown-toggle"  href="#">
                                <span class="username"><?php echo $this->session->userdata('user_name_front');?> (<?php echo $this->session->userdata('outlet_front');?>)</span>
                                   <b class="caret"></b>
                            </a>
                             <ul class="dropdown-menu">
                                <div class="log-arrow-up"></div>
                                <li><a href="<?php echo base_url().'user/changepin';?>"><i class="fa fa-pencil"></i> Change PIN</a></li>
                                <li><a href="<?php echo base_url().'login/logout';?>"><i class="fa fa-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
  <?php  
}//end if/?>
    <section id="main-content" class="<?php echo $_page_class=='front_login'?'loginPage':'';?>">
        <section class="wrapper">
            
        