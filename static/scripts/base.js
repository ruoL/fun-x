$(function(){

        $(".p-list-one").hover(function(){
            $(this).children(".p-list-c").fadeIn();
        },function(){
            $(this).children(".p-list-c").fadeOut();
        })

        $(window).scroll(function() {
          if($(document).scrollTop()>10){
            $(".header-nav").slideUp();
            $(".header-menu-wrapper").slideDown();
          }else{
            $(".header-nav").slideDown();
            $(".header-menu-wrapper").slideUp();
          }
        });

})