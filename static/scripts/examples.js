$(function(){
    var l = $(".superbox_lists").length;
    l = l*100;
    var W = 100/l*100;
    $(".wrapper_content").css("width",l+"%");
    $(".superbox_lists").css("width",W+"%")
    window.page = 1;
    window.num = 1;
    var arr = {"company":"SST<br>超创思实业贸易公司","position":"ui设计、网站建设","desc":"超创思实业有限公司是促销类商品、礼品赠品、日用品等产品专业生产加工的公司，拥有完整、科学的质量管理体系。我们为他们进行了简洁风格的设计，页面整洁，易于用户操作。"};
    var len = 20;
    showmark();
    
    $(".sorrow_left").on("click",function(){
        pre();
    })
    $(".sorrow_right").on("click",function(){
        next();
    })

    $('.pre').on("click",function() {
        prepage();
    });

    $('.next').on("click",function() {
        nextpage();
    });

    $(".prepage").on("click",function(){
        var w = $(".superbox_lists").width();
        w = -w;
        var temp=$(".wrapper_content .superbox_lists:last-child").clone();
        $(".wrapper_content .superbox_lists:last-child").remove();
        temp.css({marginLeft:w+"px"});
        $(".wrapper_content").prepend(temp);        
        $(".wrapper_content .superbox_lists:first-child").animate({"margin-left":"0px"})
        showmark();
        window.page = window.page-1;
        if(window.page == 4){
            window.page=1;
        }else if(window.page == 0){
            window.page=3;
        }
    })
    $(".nextpage").on("click",function(){
        var w = $(".superbox_lists").width();
        w = -w;
        $(".wrapper_content .superbox_lists:first-child").animate({"margin-left": w+"px"},
        function(){                
            $(".wrapper_content .superbox_lists:first-child").css({"margin-left":"0px"})
            var temp=$(".wrapper_content .superbox_lists:first-child").clone();
            $(".wrapper_content .superbox_lists:first-child").remove();
            $(".wrapper_content").append(temp);
            showmark();            
        });
        window.page = window.page+1;
        if(window.page == 4){
            window.page=1;
        }else if(window.page == 0){
            window.page=3;
        }          
    })

    $(".show_imgs").mouseover(function(){
        clearInterval(window.t)
    })
    $(".show_imgs").mouseout(function(){
        autoplay();
    })

    $('.wrapper_content').on("click",'.superbox1 .superbox-list', function() {
        var num = $(this).children().children("img").data("num");
        if($(".superbox-show").css("display") == "none"){
            openimg();
        }else if($(".superbox-show").css("display") == "block"){
            closeimg();
        }
        setpage(num,1,window.page);
    })
    $('.wrapper_content').on("click",'.superbox2 .superbox-list',function() {
        var num = $(this).children().children("img").data("num");
        if($(".superbox-show").css("display") == "none"){
            openimg();
        }else if($(".superbox-show").css("display") == "block"){
            closeimg();
        }
        setpage(num,2,window.page);
    })

    $('.superbox-close').on('click',function() {               
        closeimg();
    });

    function showmark(){
        $('.superbox-list').hover(function () {
            $(this).children().children(".case_mark").animate({"opacity":"0.9"},"slow");
        },function () {
            $(this).children().children(".case_mark").stop(true).hover();
            $(this).children().children(".case_mark").animate({"opacity":"0"},"slow");
        });
    }

    function openimg(){
        $(".superbox1").animate({"margin-top":"-240px"},"slow")
        $(".superbox2").animate({"margin-top":"494px"},"slow")
        $(".wrapper").css("opacity","0.5")
        $(".superbox-show").show()
        $(".superbox-show").animate({"top":"244px","height":"500px"},"slow");
        setTimeout(function(){
            $(".show_block").fadeIn("slow");
            autoplay();
        },500);
    }
    function closeimg(){
        clearInterval(window.t)
        $(".show_block").fadeOut()
        setTimeout(function(){
            $(".superbox1").animate({"margin-top":"0px"},"slow")
            $(".superbox2").animate({"margin-top":"0px"},"slow")        
            $(".wrapper").css("opacity","1")
            $(".superbox-show").animate({"height":"0px","top":"484px"},"slow");
            $(".superbox-show").hide("slow") 
        },300);                
    }
    function pre(){
        clearInterval(window.t)
        var len = $(".show_imgs ul li").length;
        var w = $(".show_imgs ul li img").width();
        w = -w;
        var temp=$(".show_imgs ul li:last-child").clone();
        $(".show_imgs ul li:last-child").remove();
        temp.css({marginLeft:w+"px"});
        $(".show_imgs ul").prepend(temp);
        
        $(".show_imgs ul li:first-child").animate({"margin-left":"0px"},"slow")
        
        window.num -= 1;
        if(window.num == 0){
            window.num = len;
        }
        $(".page span:nth-child(1)").html(window.num);
        setTimeout(autoplay(),3000);
    }
    function next(){
        clearInterval(window.t)
        var len = $(".show_imgs ul li").length;
        var w = $(".show_imgs ul li img").width();
        w = -w;
        $(".show_imgs ul li:first-child").animate({"margin-left": w+"px"}, "slow",
            function(){
                $(".show_imgs ul li:first-child").css("margin-left","0px")
                var temp=$(".show_imgs ul li:first-child").clone();
                $(".show_imgs ul li:first-child").remove();
                $(".show_imgs ul").append(temp);
        });
      
        window.num += 1;
        if(window.num == len+1){
            window.num = 1;
        }
        $(".page span:nth-child(1)").html(window.num);
        setTimeout(autoplay(),3000);
    }
    function autoplay(){
        window.t = setInterval(function(){
            next();
        },3000);
    }
    function nextpage(){
        var num = parseInt($(".show_imgs").data("num"))+1;
        if(num == len+1){
            num = 1;
        }
        if(num > 10){
            setpage(num,2,window.page)
        }else{
            setpage(num,1,window.page)
        }
    }
    function prepage(){
        var superboximg   = $(".show_imgs ul li:nth-child(1) img");
        var num = parseInt($(".show_imgs").data("num"))-1;
        if(num == 0){
            num = len;
        }     
        if(num > 10){
            setpage(num,2,window.page)
        }else{
            setpage(num,1,window.page)
        }
    }
    // function setpage(num,i,page){
    //     var n = num;
    //     if(i == 1){
    //         n = num-(page-1)*20;
    //         var currentimg = $(".wrapper_content .superbox_lists:nth-child(1) .superbox1 .superbox-list:nth-child("+n+") a img");
    //     }else if(i == 2){
    //         n = num-(page*20-10);
    //         var currentimg = $(".wrapper_content .superbox_lists:nth-child(1) .superbox2 .superbox-list:nth-child("+n+") a img");
    //     }
    //     var imgData = currentimg.data('img');
    //     var imgLen = currentimg.data('len');
    //     var str = "<li><img src=''/></li>";
    //     for (var i = 1; i <= imgLen; i++) {
    //         $(".show_imgs ul").append(str);
    //         if(i == 1){
    //             $(".show_imgs ul li:nth-child(1) img").attr('src',imgData);
    //         }else{
    //             $(".show_imgs ul li:nth-child("+i+") img").attr('src',"../static/images/case_"+i+".jpg");
    //         }
    //     };
    //     $(".page span:nth-child(2)").html("/"+imgLen);
    //     $(".show_imgs").data("num",num);
    //     $(".show_right h4").html(arr['company']+num)
    //     $(".show_right h5").html(arr['position']+num)
    //     $(".show_right .desc").html(arr['desc']+num)
    //     $(".show_imgs ul").css("margin-left","0px")
    //     window.num = 1;
    //     $(".page span:nth-child(1)").html(window.num);
    // }
    function setpage(num,i,page){
        $.post("/product/one",{"id",num},function(response) {
            if (response.code == "success") {
                var imgData = response['data']['images'];
                var imgLen = imgData.length;
                var str = "<li><img src=''/></li>";
                for (var i = 0; i < imgLen; i++) {
                    $(".show_imgs ul").append(str);
                    $(".show_imgs ul li:nth-child("+i+") img").attr('src',imgData[i]);
                };
                window.num = 1;
                $(".page span:nth-child(1)").html(window.num);
                $(".page span:nth-child(2)").html("/"+imgLen);
                $(".show_imgs").data("num",response['data']['id']);
                $(".show_right h4").html(response['data']['name']);
                var tags = response['data']['tag'];
                tags.join("、");
                $(".show_right h5").html(tags);
                $(".show_right .desc").html(response['data']['jianjie']);
                $(".show_imgs ul").css("margin-left","0px");
            } else {
                
            }
        });
    }
});