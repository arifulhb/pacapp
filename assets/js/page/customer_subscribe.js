require(['order!jquery','order!moment','order!apppath','order!jquery-ui'], function($,moment,apppath){ 
      
   $('.btn-subscribe').click(function(){
       
       var id=$(this).val();
       
       var chk= $('#check_'+id).prop('checked');
       if(chk==true){
        
       
       var m = moment()
                     
       var cust_id=$('#_sn').val();
       var expire=$('#expire_'+id).val();
       //alert(id);
       $.ajax({
            type: "POST",
            url: apppath+'/customer/subscribe_campaign',
            data: '_cust_sn='+cust_id+'&_cmpn_sn='+id+'&_expire='+expire,
            success: function(data) {
                console.log(data);
                if(data==1){                    
                    
                    var name=$('#row_'+id+' .camp_name').text();
                    var row='<tr>';
                        row+='<td>'+name+'</td>'
                        row+='<td>'+m.format('D MMM YYYY')+'</td>'
                        row+='<td>'+moment(expire).format('D MMM YYYY')+'</td>'
                        row+='</tr>';
                    $('#currect_subscription').append(row);
                    $('#row_'+id).remove();
                }//end if
            },
            error:function(error){
                console.log('ERROR: '+error);
            }
       });
       }//end chk true
       else{
           alert('Please Check Subscribe Checkbox to Subscribe!');
           $('.check_lebel_'+id).css('color','red');
       }
       
   });//end function
    
});