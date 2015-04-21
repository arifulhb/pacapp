require(['order!jquery','order!apppath'], function($,apppath){ 
    
    ///////////////////////////////////////////////////////////////
    //REMOVE CUSTOMER
    ///////////////////////////////////////////////////////////////
    $('.unsubs').click(function(){
        var id=$(this).val();
        
        var _name=$('#row_'+id).find('.name').text();
        $('#remove_name').text(_name);
        $('#remove_id').val(id);
        $('#remove_customer_modal').modal('show');        
        
    });// row delete button click
    
    $('#btn_delete').click(function(){
        var id=$('#remove_id').val();
        var cust_sn=$('#cust_sn').val();
        $.ajax({
            type: "POST",
            url: apppath+'/customer/unsubscribe',
            data: '_cmpn_sn='+id+'&_cust_sn='+cust_sn,
            success: function(data) {
                if(data==1){
                    $('#row_'+id).remove();
                    $('#remove_customer_modal').modal('hide');
                }
            },
            error:function(error){
                console.log('ERROR: '+error);
            }
        });
    });
    
});