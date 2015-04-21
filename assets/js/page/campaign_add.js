require(['order!jquery','order!apppath','order!customSelect'], function($,apppath){ 
  
  var _action=$('#_action').val();
  var _total_red_sessions =0;
  
  if(_action==='add'){
      $(".selectcampaigntype").val($(".selectcampaigntype option:first").val());
      _total_red_sessions=1;
  }else{
      _total_red_sessions=$('#totalRedumSessions').val();
  }
  //console.log('total redim sessions : '+_total_red_sessions);
  $('#totalRedumSessions').val();
  $('#btnAddRedemLevel').click(function(){
      _total_red_sessions++;
      var _row='<tr>';
            _row+='<td><input type="number" class="form-control" name="red_session_'+_total_red_sessions+'" step="any" novalidate/></td>';
            _row+='<td><input type="text" class="form-control" name="red_name_'+_total_red_sessions+'"  placeholder="Name" maxlength="50"/></td></td>';
            _row+='<td><input type="text" class="form-control"  name="red_desc_'+_total_red_sessions+'" placeholder="Description"/></td></td>';
            _row+='<td></td>';
          _row+='</tr>';
        $('#sessionRedemLevelWrap').append(_row);
        
        $('#totalRedumSessions').val(_total_red_sessions);
  });
  
  //PREVIOUS CODE FROM HTML TEMPLATE
    //custom select box
    $(function(){
        //$('select.styled').customSelect();
    });

    campaigntype_hide();
    // Select Campaign Type
    function campaigntype_hide () {
        $('.campaigntype').hide(); 
    }
    
    
    
    $('.selectcampaigntype').change(function(){
        var _dtype='<select class="form-control" name="inputExpireDurationType" id="inputExpireDurationType">';
            _dtype+='<option value="day">Days</option>';
            _dtype+='<option value="month">Months</option>';
            _dtype+='<option value="year">Years</option> </select>';            
                    
        if ($('.selectcampaigntype').val() == 'visit') {
                campaigntype_hide();
                $('#inputVisitActivateButton').attr('required');
                $('#visitTypeExpDuration').append('<input type="number" class="form-control" name="inputExpireDuration" placeholder="Number of" required>');                
                $('#visitTypeExpDurationType').append(_dtype);     
                //remove session
                $('#sessionTypeExpDuration').empty();
                $('#sessionTypeExpDurationType').empty();
                //Remove giftcard
                $('#giftcardTypeExpDuration').empty();
                $('#giftcardTypeExpDurationType').empty();
                $('.type-visit').show(); 
            } else if ($('.selectcampaigntype').val() == 'session') {
                campaigntype_hide();
                $('#inputVisitActivateButton').removeAttr('required');
                $('#sessionTypeExpDuration').append('<input type="number" class="form-control" name="inputExpireDuration" placeholder="Number of" required>');                
                $('#sessionTypeExpDurationType').append(_dtype);
                //remove visit
                $('#visitTypeExpDuration').empty();
                $('#visitTypeExpDurationType').empty();
                //Remove giftcard
                $('#giftcardTypeExpDuration').empty();
                $('#giftcardTypeExpDurationType').empty();
                $('.type-session').show(); 
            } else if ($('.selectcampaigntype').val() == 'giftcard') {
                //prepare for GIFT 
                
                campaigntype_hide();
                $('#inputVisitActivateButton').removeAttr('required');
                $('#giftcardTypeExpDuration').append('<input type="number" class="form-control" name="inputExpireDuration" placeholder="Number of" required>');                
                $('#giftcardTypeExpDurationType').append(_dtype);
                 //remove visit
                $('#visitTypeExpDuration').empty();
                $('#visitTypeExpDurationType').empty();
                //Remove session
                $('#sessionTypeExpDuration').empty();
                $('#sessionTypeExpDurationType').empty();
                $('.type-giftcard').show(); 
            }       
    });
       
    $('.btn-remove-redses').click(function(){
        
        var _this_sn=$(this).val();
        
        if($('#rem_check_'+_this_sn).is(':checked')==true){
            var _id=$('#red_sn_'+_this_sn).val();
                $.ajax({
                type: "POST",
                url: apppath+'/campaign/delete_sesred',
                data: '_id='+_id,
                success: function(res) {
                    if(res==1){
                        console.log('SUCCESS');
                        $('#row_'+_this_sn).remove();
                    }
                },
                error:function(error){

                }
            });//end ajax
        }else{
            $('#checkbox'+_this_sn).css('color','red');
        }        
        
    });
});