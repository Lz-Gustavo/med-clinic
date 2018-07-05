
(function ($) {
    "use strict";


    /*==================================================================
    [ Change login ]*/
    var login;

    $('.choice-adm-form-btn').click(function(){
        $('body').get(0).style.setProperty('--main-color', '#4dc0d7');
        $('.choice-adm-form-btn').css({'background':'var(--main-color'})                
        $('.choice-med-form-btn').css({'background':'#bfbfbf'})
        $('.hide_div').css({'visibility':'visible'});
        login = 'adm';                          
    });

    $('.choice-med-form-btn').click(function(){
        $('body').get(0).style.setProperty('--main-color', '#785066');
        $('.choice-med-form-btn').css({'background':'var(--main-color'})                        
        $('.choice-adm-form-btn').css({'background':'#bfbfbf'})
        $('.hide_div').css({'visibility':'visible'});    
        login = 'doc';                          
    });
    

    /*==================================================================
    [ Focus Contact2 ]*/
    
  
  
    /*==================================================================
    [ Validate ]*/
    

})(jQuery);