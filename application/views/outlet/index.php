
    <li class="active"><?php echo $_page_title;?></li>
</ul>
<section class="panel">
    <header class="panel-heading clearfix">
        Outlet
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'outlet/add';?>" role="button">Add New Outlet</a>
    </header>
    
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th><i class=" fa fa-edit"></i></th>
                <th>Outlet Name</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($_list as $row): ?>
            <tr id="row_<?php echo $row['ol_sn'];?>">
                <td>
                    <a href="<?php echo base_url().'outlet/edit/'.$row['ol_sn'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <button class="btn remove_outlet btn-danger btn-xs" value="<?php echo $row['ol_sn'];?>"><i class="fa fa-trash-o "></i></button>
                </td>
                <td><a href="<?php echo base_url().'outlet/details/'.$row['ol_sn'];?>"><span class="ol_name"><?php echo $row['ol_name'];?></span></a></td>
                <td><a href="mailto:<?php echo $row['ol_email'];?>" target="_blank"><?php echo $row['ol_email'];?></a></td>
                <td><?php echo $row['ol_phone'];?></td>
            </tr>
                <?php
            endforeach;
            ?>                        
        </tbody>
    </table>
</section>
<section class="panel">
  <div class="panel-body">
      <div class="text-center">
          <?php echo $this->pagination->create_links();?>
      </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="remove_outlet_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Remove Outlet</h4>
      </div>
      <div class="modal-body">
          Are you sure to delete <strong><span id="remove_name"></span></strong> Outlet?
          <input type="hidden" value="" id="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" class="btn btn-danger">Remove</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script> require(['page/outlet_index']); </script> 