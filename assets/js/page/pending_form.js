require(['order!jquery','order!apppath','order!moment','order!inputmask'], function($,apppath,moment){ 
    
    $('#inputExpireDate, #inputSubsDate').inputmask('dd/mm/yyyy',
        {"placeholder": "dd/mm/yyyy",
        "oncomplete": function(){                                         
                var _duration=Number($('#number_of_months').val());
                //console.log(_duration+' months');
                var _from=moment($('#inputSubsDate').val(),'DD/MM/YYYY').format('YYYY-MM-DD');
                //console.log(_from+' from ');
                $('#inputExpireDate').val(moment(_from).add('months',_duration).format('DD/MM/YYYY'));
                $('#new_expire_date_text').text(moment(_from).add('months',_duration).format('DD MMMM, YYYY'));
                
        }});
    
    //number of months change
    $('#number_of_months').bind('change keypress keydown keyup',function(){
        
        var _duration=Number($('#number_of_months').val());        
        var _from=moment($('#inputSubsDate').val(),'DD/MM/YYYY').format('YYYY-MM-DD');
        
        $('#inputExpireDate').val(moment(_from).add('months',_duration).format('DD/MM/YYYY'));
        $('#new_expire_date_text').text(moment(_from).add('months',_duration).format('DD MMMM, YYYY'));
        
    });
    
      $('#inputOldBalance, #inputRedemption, #inputTranValue').bind('keypress change keydown keyup',function(){
            
      var _old_balance  = Number($('#inputOldBalance').val());    
      
      var _redemption   = Number($('#inputRedemption').val());
      var _session      = Number($('#inputTranValue').val());
      
      calculateBalance(_old_balance,_redemption,_session);
      
  });
  
  var calculateBalance=function(_old_balance,_redemption,_session){
      
      var _bal=Number(_old_balance-_redemption)+_session;
      $('#inputNewBalance').val(_bal);
      $('#inputNewBalance_text').text(_bal);
      
  }//end function

    //Campaign Plan
   $('#inputCampaign').bind('change',function(){
       
       var _cmpn_sn=$(this).val();
       //console.log('test :'+_cmpn_sn);
       
        //ON CHANGE EVENT
         
        //IF _action==add [bring only expire_duration and duration_type for this plan id ]
        //ELSE
        // IF current user has active subsciption of this campaign, bring current balance 
        // and subscription expire date
        
        //var _cmpn_sn=$('#inputPlan option:selected').val();
        //var _action=$('#_action').val();
        
        //if (_action=='add'){
            //
            getCampaign(_cmpn_sn);
           
        //}else{            
        //   var _cust_sn=$('#inputcustsn').val();
        //   getCampaingForCustomer(_cust_sn,_cmpn_sn);                       
        //}//end else
       
   });//end function

       
   var getCampaign=function(_cmpn_sn){
           
        $.ajax({
                type: "POST",                
                url: apppath+'/customer/getCampaignDetails',
                data: '_cmpn_sn='+_cmpn_sn,
                
                success: function(_data) {     
                    //console.log(_data);
                    var returnedData = JSON.parse(_data);
                    $(returnedData).each(function(i,val){
                   // console.log('data: '+val);    
                   //console.log('date:'+moment().format('DD/MM/YYYY'));
                   
                        //$('#campaign_duration_type').text(val.cmpn_duration_type+'s');                        
                        //$('#inputNumberOfMonths').val(val.cmpn_expire_duration);
                        $('#number_of_months').val(val.cmpn_expire_duration);
                        
                        //add start date
                        //$('#new_start_date_text').text(moment().format('DD MMMM, YYYY'));
                        $('#new_start_date').val(moment().format('DD/MM/YYYY'));
                        
                        //add new expire date
                        var _expire_date='';
                        if(val.cmpn_duration_type==='day'){
                            _expire_date=moment().add('days',val.cmpn_expire_duration).format('DD MMMM, YYYY');
                            $('#new_expire_date').val(moment().add('days',val.cmpn_expire_duration).format('YYYY-MM-DD'));
                        }else if(val.cmpn_duration_type==='month'){
                            _expire_date=moment().add('months',val.cmpn_expire_duration).format('DD MMMM, YYYY');
                            $('#new_expire_date').val(moment().add('months',val.cmpn_expire_duration).format('YYYY-MM-DD'));
                        }else if(val.cmpn_duration_type==='year'){
                            _expire_date=moment().add('years',val.cmpn_expire_duration).format('DD MMMM, YYYY');
                            $('#new_expire_date').val(moment().add('years',val.cmpn_expire_duration).format('YYYY-MM-DD'));
                        }
                        
                        $('#new_expire_date_text').text(_expire_date);
                                                
                    });

                },
                error:function(error){
                    console.log('ERROR: '+error);
                }
            });
            
                      
   }//end function
   
          
   var getCampaingForCustomer =function(_cust_sn, _cmpn_sn){
       
       //console.log('for existing: '+apppath+'/customer/getCampaignByCustomer');
       
            $.ajax({
                type: "POST",
                url: apppath+'/customer/getCampaignByCustomerAjax',
                data: '_cmpn_sn='+_cmpn_sn+'&_cust_sn='+_cust_sn,          
                success: function(_data) {
                    
                    ///console.log(_data);  
                    var returnedData = JSON.parse(_data);                    
                    var _size=Number($(returnedData).size());
                     console.log('size: '+_size);
                     if(_size>0){
                        console.log('show');
                        $(returnedData).each(function(i,val){
                                               
                            console.log('val: '+val);
                            $('#campaign_duration_type').text(val.cmpn_duration_type+'s');                        
                            $('#inputNumberOfMonths').val(val.cmpn_expire_duration);

                            $('#inputOldCardBalance').val(val.cust_balance);

                            //add start date
                            $('#new_start_date_text').text(moment().format('DD MMMM, YYYY'));
                            $('#new_start_date').val(moment().format('YYYY-MM-DD'));

                            //add new expire date
                            var _expire_date='';
                            if(val.cmpn_duration_type==='day'){
                                _expire_date=moment().add('days',val.cmpn_expire_duration).format('DD MMMM, YYYY');
                                $('#new_expire_date').val(moment().add('days',val.cmpn_expire_duration).format('YYYY-MM-DD'));
                            }else if(val.cmpn_duration_type==='month'){
                                _expire_date=moment().add('months',val.cmpn_expire_duration).format('DD MMMM, YYYY');
                                $('#new_expire_date').val(moment().add('months',val.cmpn_expire_duration).format('YYYY-MM-DD'));
                            }else if(val.cmpn_duration_type==='year'){
                                _expire_date=moment().add('years',val.cmpn_expire_duration).format('DD MMMM, YYYY');
                                $('#new_expire_date').val(moment().add('years',val.cmpn_expire_duration).format('YYYY-MM-DD'));
                            }
                            $('#new_expire_date_text').text(_expire_date);                               
                        });                    
                        
                     }else{
                         //clear the plan section
                        //console.log('hide');
                        
                        $('#campaign_duration_type').text('');                        
                        $('#inputNumberOfMonths').val('');
                        $('#inputOldCardBalance').val('');
                        //add start date
                        $('#new_start_date_text').text('');
                        $('#new_start_date').val('');
                        $('#new_expire_date').val('');
                        $('#new_expire_date_text').text('');
                        getCampaign(_cmpn_sn);
                     }//end else
                        

                },
                error:function(error){
                    console.log('ERROR: '+error);
                }
            });
                    
   }//end function
  

});//END 