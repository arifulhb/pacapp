  <li class="active">Campaign</li>
</ul>

<section class="panel">
    <header class="panel-heading clearfix">
        Campaign
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'campaign/add';?>" role="button">Add New Campaign</a>
    </header>
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th><i class=" fa fa-edit"></i></th>
                <th>Campaign Name</th>
                <th>Type</th>
                <th>Subscribers</th>
                <th>Transactions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($_list as $row): ?>
            <tr id="row_<?php echo $row['cmpn_sn'];?>">
                <td>
                    <a href="<?php echo base_url().'campaign/edit/'.$row['cmpn_sn'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>                    
                    <button class="btn btn-danger remove_campaign btn-xs" type="button" value="<?php echo $row['cmpn_sn'];?>"><i class="fa fa-trash-o "></i></button>
                </td>
                <td><a href="<?php echo base_url().'campaign/details/'.$row['cmpn_sn'];?>">
                        <span class="campaign_name"><?php echo $row['cmpn_name'];?></span></a></td>
                <td><?php 
                switch ($row['cmpn_type']):
                    case 'visit':
                        echo 'Visits';
                        break;
                    case 'session':
                        echo 'Sessions';
                        break;
                    case 'giftcard':
                        echo 'Gift Cards';
                        break;
                endswitch;?></td>
                <td><?php echo $row['subs'];?></td>
                <td><?php echo $row['trns'];?></td>
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
<div class="modal fade" id="remove_campaign_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Remove Outlet</h4>
      </div>
      <div class="modal-body">
          Are you sure to delete <strong><span id="remove_name"></span></strong> campaign?
          <input type="hidden" value="" id="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" class="btn btn-danger">Remove</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script> require(['page/campaign_index']); </script> 