requirejs.config({
    //By default load any module IDs from js/lib
    //baseUrl: 'assets/js',
    urlArgs:'v=150327',
    paths: {
        'apppath'   :'page/apppath',
        'jquery'    :'//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min',
        'jquery18'  :'lib/jquery-1.8.3.min',
        'jquery-ui' :'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min',
        'bootstrap' :'../plugins/bootstrap/js/bootstrap',
        'dtpicker'  :'../plugins/bootstrap-datepicker/js/bootstrap-datepicker',
        'dcjqaccordion' :'../plugins/jquery.dcjqaccordion.2.7',
        'scrollTo'  :'../plugins/jquery.scrollTo.min',
        'nicescroll':'../plugins/jquery.nicescroll',
        'inputmask'  :'../plugins/jquery-inputmask/dist/jquery.inputmask.bundle.min',
        'sparkline':'../plugins/jquery.sparkline',
        'customSelect':'../plugins/jquery.customSelect.min',
        'respondmin':'../plugins/respond.min',
        
        'common_scripts':'lib/common-scripts',
        'count'     :'lib/count',                
        'parsly'    :'../plugins/parsley/parsley',        
        'moment'    :'../plugins/momentjs/moment.min',        
        'nprogress'  :'../plugins/nprogress/nprogress',        
        'order'     :'lib/order',        
        'json2'     :'lib/json2'        
    },
    shim: {
        "bootstrap": {deps: ["jquery"]},
        "dtpicker": {deps: ["bootstrap"]},
        "inputmask": {deps: ["jquery"]},
        "parsly": {deps: ["jquery"]},              
        "nprogress": {deps:['jquery']},        
        "jquery-ui": {deps:['jquery']},
        "scrollTo": {deps:['jquery']},
        "dcjqaccordion":{deps:['jquery']},
        "common_scripts": {deps:['nicescroll','dcjqaccordion']},
        "nicescroll": {deps:['jquery']},
        "sparkline": {deps:['jquery']}
    }
});


require(['order!jquery','order!bootstrap','order!nprogress'],function($){
    console.log('LOADED require.js');   
    //alert('HOST: '+window.location.origin);
});