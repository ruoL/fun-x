$(function(){
    var l = $(".superbox_lists").length;
    if(l>1){
        $(".control").show()
    }else{
        $(".control").hide()
    }
    l = l*100;
    var W = 100/l*100;
    var length = $(".superbox-list").length;
    $(".wrapper_content").css("width",l+"%");
    $(".superbox_lists").css("width",W+"%")
    window.page = 1;
    window.num = 1;
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
        if(window.page > l){
            window.page=1;
        }else if(window.page <= 0){
            window.page=l;
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
        if(window.page > l){
            window.page=1;
        }else if(window.page <= 0){
            window.page=l;
        }
    })

    $(".show_imgs").mouseover(function(){
        clearInterval(window.t)
    })
    $(".show_imgs").mouseout(function(){
        autoplay();
    })

    $('.wrapper_content').on("click",'.superbox .superbox-list', function() {
        var num = $(this).children().children("img").data("num");
        if($(".superbox-show").css("display") == "none"){
            var no = $(this).children().children().data("no");
            openimg(no);
        }else if($(".superbox-show").css("display") == "block"){
            closeimg();
        }
        setpage(num,window.page);
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

    function openimg(no){
        $(".show_imgs").data("num",no);
        $(".superbox1").animate({"margin-top":"-238px"},"slow")
        $(".superbox2").animate({"margin-top":"494px"},"slow")
        $(".wrapper").css("opacity","0.5")
        $(".superbox-show").show()
        $(".superbox-show").animate({"top":"242px","height":"500px"},"slow");
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
            $(".superbox-show").animate({"height":"0px","top":"482px"},"slow");
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

        window.num = window.num-1;
        if(window.num <= 0){
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
        window.num = window.num+1;
        if(window.num > len){
            window.num = 1;
        }
        $(".page span:nth-child(1)").html(window.num);
        setTimeout(autoplay(),3000);
    }
    function autoplay(){
        window.t = setInterval(function(){
            next();
        },2000);
    }
    function nextpage(){
        var no = $(".show_imgs").data("num");
        no = no+1;
        if(no > length){
            no = 1;
        }
        example(no);
    }
    function prepage(){
        var no = $(".show_imgs").data("num");
        no = no-1;
        if(no <= 0){
            no = length;
        }
        example(no);
    }
    function example(no){
        var page = parseInt(no/20+1)
        var i = parseInt(no/10);
        if(i>0){
            i = parseInt((i%2==0)?1:2)
        }else{
            i = 1;
        }
        var n = parseInt(no%10)
        $(".show_imgs").data("num",no)
        var num = $(".wrapper_content .superbox_lists:nth-child("+page+") .superbox"+i+" .superbox-list:nth-child("+n+")").children().children().data("num")
        setpage(num,window.page)
    }
    function setpage(no,page){
        $.post("/product/one",{"id":no},function(response) {
            if (response.code === "success") {
                var imgData = response['data']['anli'];
                var imgLen = imgData.length;
                var str = "<li><img src=''/></li>";
                $(".show_imgs ul").html('')
                for (var i = 1; i <= imgLen; i++) {
                    $(".show_imgs ul").append(str);
                    $(".show_imgs ul li:nth-child("+i+") img").attr('src','/'+imgData[i-1]);
                };
                window.num = 1;
                $(".page span:nth-child(1)").html(window.num);
                $(".page span:nth-child(2)").html("/"+imgLen);
                $(".show_right h4").html(response['data']['name']);
                var tags = response['data']['tag'];
                tags = tags.join("、");
                $(".show_right h5").html(tags);
                $(".show_right .desc").html(response['data']['jianjie']);
                var colors = response['data']['color'];
                $(".color_block ul").html('');
                for (var i = 0; i < colors.length; i++) {
                    $(".color_block ul").append("<li></li>");
                    $(".color_block ul li:nth-child("+(i+1)+")").css("background",colors[i]);
                };
                $(".show_imgs ul").css("margin-left","0px");
            } else {
                console.log("error")
            }
        }, 'json');
    }
});