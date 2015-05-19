require(['order!jquery','order!apppath','order!moment','order!json2'], function($,apppath,moment){ 
    
   // console.log('page confirm');

    $('.btn-approve').click(function(){
        
       var tmpsn=$(this).val();
       var chk= $('#check_'+tmpsn).prop('checked');
        
       if(chk==true){
            //alert('approve: '+tmpsn);   
            approveSubscription(tmpsn);
            
       }else{
           alert('Please Check to Approve');
           $('.check_lebel_'+tmpsn).css('color','red');
       }       
        
    });
  
  $('.btn-remove_pending').click(function(){
      var id=$(this).val();
      
      //var _name=$('#row_'+id).find('.ol_name').text();
        $('#remove_name').text(id);        
        $('#btn_delete').val(id);
        $('#remove_pending_modal').modal('show');    
      
      
  });
    
    /* REJECT*/
  $('#btn_delete').click(function(){
      var id=$(this).val();
      
      $.ajax({
           type: "POST",
            url: apppath+'/pending/delete',
            data: '_sn='+id,
            success: function(data) {
                if(data==1){
                    $('#row_'+id).remove();
                    $('#remove_pending_modal').modal('hide');
                }
            },
            error:function(error){
                console.log('ERROR: '+error);
                alert('Can not perform Remove Operation');
            }
      });
      
  });
  
   var approveSubscription=function(tmpsn){
           
        var _subs_type      = $('#_subs_type_'+tmpsn).val();
        var _cust_sn        = $('#_cust_sn_'+tmpsn).val();
        var _date           = $('#_date_'+tmpsn).val();        
        var _req_date           = $('#_req_date_'+tmpsn).val();   
        var _cmpn_sn        = $('#_cmpn_sn_'+tmpsn).val();
        var _expire_date    = $('#_expire_date_'+tmpsn).val();
        var _cust_balance  = $('#_cust_balance_'+tmpsn).val();
        var _user_sn        = $('#_user_sn_'+tmpsn).val();                
        var _tran_value     = $('#_tran_value_'+tmpsn).val();               
        var _bill_no        = $('#_subs_bill_no_'+tmpsn).val();
        var _bill_amount    = $('#_subs_bill_amount_'+tmpsn).val();
        var _remark         = $('#_remark_'+tmpsn).val();
        var _user_sn        = $('#_user_sn_'+tmpsn).val();
        
        var _car_number         = $('#_car_number_'+tmpsn).val();
        var _car_color         = $('#_car_color_'+tmpsn).val();
        var _car_model         = $('#_car_model_'+tmpsn).val();
        
        var _post_data='_tempsn='+tmpsn;
            _post_data+='&_subs_type='+_subs_type;
            _post_data+='&_cust_sn='+_cust_sn;
            _post_data+='&_date='+_date;
            _post_data+='&_req_date='+_req_date;
            _post_data+='&_cmpn_sn='+_cmpn_sn;
            _post_data+='&_expire_date='+_expire_date;
            _post_data+='&_cust_balance='+_cust_balance;
            _post_data+='&_user_sn='+_user_sn;
            _post_data+='&_tran_value='+_tran_value;
            _post_data+='&_bill_no='+_bill_no;
            _post_data+='&_bill_amount='+_bill_amount;
            _post_data+='&_user_sn='+_user_sn;
            _post_data+='&_car_number='+_car_number;
            _post_data+='&_car_color='+_car_color;
            _post_data+='&_car_model='+_car_model;
            _post_data+='&_remark='+_remark;
            
        //alert(_post_data);
        //return 0;
        $.ajax({
                type: "POST",                
                url: apppath+'/pending/approve',
                data: _post_data,                
                success: function(_data) {     
                    //console.log(_data);
                    if(_data==true){
                        alert('Approved Successfully');
                        $('#row_'+tmpsn).remove();
                    }else{
                        alert('Was Not Successful');
                    }
                },
                error:function(error){
                    console.log('ERROR: '+error);
                }
            });
            
                      
   }//end function         
  
  
});//END 