require(['order!jquery','order!apppath','order!jquery-ui'], function($,apppath){ 
    
    $('.remove_outlet').click(function(){
        var id=$(this).val();
        
        var _name=$('#row_'+id).find('.ol_name').text();
        $('#remove_name').text(_name);
        $('#remove_id').val(id);
        $('#remove_outlet_modal').modal('show');        
        
    });// row delete button click
    
    $('#btn_delete').click(function(){
        var id=$('#remove_id').val();
                
        $.ajax({
            type: "POST",
            url: apppath+'/outlet/delete',
            data: '_sn='+id,
            success: function(data) {
                if(data==1){
                    $('#row_'+id).remove();
                    $('#remove_outlet_modal').modal('hide');
                }
            },
            error:function(error){
                console.log('ERROR: '+error);
            }
        });
    });
});