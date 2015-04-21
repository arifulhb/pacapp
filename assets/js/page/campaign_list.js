require(['order!jquery','order!apppath'], function($,apppath){ 
    
    $('.cmlist_submit').click(function(){ 
        $(this).find('.newform').submit();
    });
    
});