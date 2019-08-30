        <!--sidebar start-->
        <?php
        $thisPage='homePage';
        ?>
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="<?php if ($thisPage=="homePage")      echo "active"; ?>" 
                           href="<?php echo base_url().'admin';?>">
                            <i class="fa fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php if ($thisPage=="customerPage")  echo "active"; ?>" 
                           href="<?php echo base_url().'customer';?>">
                            <i class="fa fa-users"> </i>
                            <span>Customer</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php if ($thisPage=="campaignPage")  echo "active"; ?>" 
                           href="<?php echo base_url().'campaign';?>">
                            <i class="fa fa-asterisk"></i>
                            <span>Campaign</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php if ($thisPage=="outletPage")    echo "active"; ?>" 
                           href="<?php echo base_url().'outlet';?>">
                            <i class="fa fa-map-marker"></i>
                            <span>Outlet</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php if ($thisPage=="userPage")      echo "active"; ?>" 
                           href="<?php echo base_url().'user';?>">
                            <i class="fa fa-user"></i>
                            <span>User</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php if ($thisPage=="userPending")      echo "active"; ?>" 
                           href="<?php echo base_url().'pending';?>">
                            <i class="fa fa-folder-open"></i>
                            <span>Pending</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php if ($thisPage=="ban")      echo "active"; ?>" 
                           href="<?php echo base_url().'customer/blockcardid';?>">
                            <i class="fa fa-ban"></i>
                            <span>Block Card ID</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->