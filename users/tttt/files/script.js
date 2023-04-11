
$(document).ready(function() {

    
    var bgAnimate = $("#slider_img").bgswitcher({

        images: ["images/slide1.jpg", "images/slide2.jpg", "images/slide3.jpg", "images/slide4.jpg"],

        effect: "drop", // fade, blind, clip, slide, drop, hide

        interval: 5000, // Interval of switching

        loop: true, // Loop the switching

        shuffle: false, // Shuffle the order of an images

        duration: 3000, // Effect duration

        easing: "swing" // Effect easing (swing, linear)

    });


     // $("#next").on("click", function() {
    //   $el.bgswitcher("select", 1); 
    // });

    // Name    Description
    // start   Start the switching
    // stop    Stop the switching
    // toggle  Toggle between start/stop
    // reset   Return to the first switching
    // select  Select the switching at index eg $el.bgswitcher("select", 1);
    // next    Go to the next switching
    // prev    Go to the previous switching
    // destroy !!Destroy BgSwitcher!!

    $("#slides_track").click(function(){
        $("#slider_track_form").slideToggle(200);
        $("#track_input").focus();
    });

    $('#mobile_menu').click(function(){
        $('#menu_wrap').slideToggle(300);
    });
    
    $("#maj_slider_control_next").on("click", function() {
      bgAnimate.bgswitcher("next");
    });


    $("#maj_slider_control_prev").on("click", function() {
      bgAnimate.bgswitcher("prev");
    });

    $("#admin_link [href]").each(function() {
        if(this.href == window.location.href) {
            $(this).addClass("active_link2");
        }
    });


    window.setInterval(function(){
        currentMargLeft = parseInt($("#scroll_wrap p").css('margin-left'));
        scrollElementWidth = parseInt($("#scroll_wrap p").css('width'));
        newMargLeft = currentMargLeft -4; 
        $("#scroll_wrap p").css({'margin-left': newMargLeft + 'px'})
        

        if((scrollElementWidth + newMargLeft) < 0){
            // alert(scrollElementWidth +" "+ newMargLeft);
            newMargLeft = 1300;
            $("#scroll_wrap p").css({'margin-left': newMargLeft + 'px'})

        }

        // console.log(scrollElementWidth +" "+ newMargLeft);
    }, 100)


    window.setInterval(function(){
        currentBottom = parseInt($("#vert_scroll_wrap p").css('bottom'));
        scrollElementWrapHeight = parseInt($("#vert_scroll_wrap").css('height'));
        scrollElementHeight = parseInt($("#vert_scroll_wrap p").css('height'));
        newBottom = currentBottom + 1; 
        $("#vert_scroll_wrap p").css({'bottom': newBottom + 'px'})
        

        if(scrollElementWrapHeight < newBottom){
            // alert(scrollElementWidth +" "+ newMargLeft);
            newBottom = 0 - scrollElementHeight;
            $("#vert_scroll_wrap p").css({'bottom': newBottom + 'px'})

        }

        // console.log(scrollElementWidth +" "+ newMargLeft);
    }, 100)


    var bgCounter = 0;
    window.setInterval(function(){

        

        bg4 = "repeat scroll 0 0, rgba(0, 0, 0, 0) linear-gradient(128deg, #02aab0 0px, #00cdac 100%)"

        bg1 = "repeat scroll 0 0, rgba(0, 0, 0, 0) linear-gradient(128deg, #43cea2 0px, #185a9d 100%)"

        bg2 = "repeat scroll 0 0, rgba(0, 0, 0, 0) linear-gradient(128deg, #4ca1af 0px, #c4e0e5 100%)"

        bg3 = "repeat scroll 0 0, rgba(0, 0, 0, 0) linear-gradient(128deg, #36d1dc 0px, #5b86e5 100%)"

        transition = 'opacity 1s ease-in-out 0s';

        if(bgCounter == 0){
            $("#track_section_scroller .opac").css({'opacity': '0', 'transition': transition});
            $("#track_section_scroller #opac1").css({'opacity': '1', 'transition': transition});
            // $("#track_section_scroller").css({'background': bg1, 'transition': transition});
            // $("#track_section_scroller").css({'background': 'red', 'transition': transition});
            console.log(bg1);
        }else if(bgCounter == 50){
            $("#track_section_scroller .opac").css({'opacity': '0', 'transition': transition});
            $("#track_section_scroller #opac2").css({'opacity': '1', 'transition': transition});
            // $("#track_section_scroller").css({'background': bg2, 'transition': transition});
            // $("#track_section_scroller").css({'background': 'blue', 'transition': transition});

        }else if(bgCounter == 100){
            $("#track_section_scroller .opac").css({'opacity': '0', 'transition': transition});
            $("#track_section_scroller #opac3").css({'opacity': '1', 'transition': transition});
            // $("#track_section_scroller").css({'background': bg3, 'transition': transition});
            // $("#track_section_scroller").css({'background': 'green', 'transition': transition});

        }else if(bgCounter == 150){
            $("#track_section_scroller .opac").css({'opacity': '0', 'transition': transition});
            $("#track_section_scroller #opac4").css({'opacity': '1', 'transition': transition});
            // $("#track_section_scroller").css({'background': bg4, 'transition': transition});
            // $("#track_section_scroller").css({'background': 'gray', 'transition': transition});
            
        }else if(bgCounter == 200){
            bgCounter = -1;

        }

        bgCounter += 1;
        

        currentBottom = parseInt($("#track_section_scroller p").css('bottom'));
        scrollElementWrapHeight = parseInt($("#track_section_scroller").css('height'));
        scrollElementHeight = parseInt($("#track_section_scroller p").css('height'));
        newBottom = currentBottom + 1; 
        $("#track_section_scroller p").css({'bottom': newBottom + 'px'})
        

        if(scrollElementWrapHeight < newBottom){
            // alert(scrollElementWidth +" "+ newMargLeft);
            newBottom = 0 - scrollElementHeight;
            $("#track_section_scroller p").css({'bottom': newBottom + 'px'})

        }

        // console.log(scrollElementWidth +" "+ newMargLeft);
    }, 100)



    $("#menu [href]").each(function() {
    
        if (this.href == window.location.href) {
            $(this).addClass("active_link");
        }

        if(location.pathname.search("services") != -1){
            $("#services").addClass("active_link");
        }

        if(location.pathname.search("tracking") != -1){
            $("#tracking").addClass("active_link");
        }

        if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1) == ""){
            $("#home").addClass("active_link");
        }

    });


    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('.scroll_to_top').show();      
        }else{
            $('.scroll_to_top').hide();
        }
    });


    $('.scroll_to_top').click(function(){
        $('html, body').animate({scrollTop : 0}, 'slow');
        $('.scroll_to_top').hide();
        return false;
    });


    $('.scroll_to_top').hover(function(){
        $(this).fadeTo(500, 1);
    }, function(){
        $(this).fadeTo(500, 0.4);
        
    });




    $('#german').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/de');
    });

    $('#hindi').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/hi');
    });

    $('#spanish').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/es');
    });

    $('#english').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/en');
    });

    $('#russian').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/ru');
    });

    $('#french').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/fr');
    });

    $('#italian').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/it');
    });

    $('#arabic').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/ar');
    });

    $('#portuguese').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/pt');
    });

    $('#turkish').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/tr');
    });

    $('#chinese').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/zh-CN');
    });

    $('#korean').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/ko');
    });

    $('#japanese').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/ja');
    });

    $('#thai').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/th');
    });

    $('#dutch').click(function(){
        $.removeCookie("googtrans", {path: "", domain: ".diamondcouriers.net"});
        $.removeCookie("googtrans", {path: "", domain: "diamondcouriers.net"});
        $.cookie('googtrans', '/en/nl');
    });
    

    (function currentLang(){

        if(typeof $.cookie('googtrans') != 'undefined'){
            var curLang = $.cookie('googtrans');

            if(curLang == '/en/de'){
                $('#german').css({'font-weight': 'bold'});
            }else if(curLang == '/en/hi'){
                $('#hindi').css({'font-weight': 'bold'});
            }else if(curLang == '/en/es'){
                $('#spanish').css({'font-weight': 'bold'});
            }else if(curLang == '/en/en'){
                $('#english').css({'font-weight': 'bold'});
            }else if(curLang == '/en/ru'){
                $('#russian').css({'font-weight': 'bold'});
            }else if(curLang == '/en/fr'){
                $('#french').css({'font-weight': 'bold'});
            }else if(curLang == '/en/it'){
                $('#italian').css({'font-weight': 'bold'});
            }else if(curLang == '/en/ar'){
                $('#arabic').css({'font-weight': 'bold'});
            }else if(curLang == '/en/pt'){
                $('#portuguese').css({'font-weight': 'bold'});
            }else if(curLang == '/en/tr'){
                $('#turkish').css({'font-weight': 'bold'});
            }else if(curLang == '/en/zh-CN'){
                $('#chinese').css({'font-weight': 'bold'});
            }else if(curLang == '/en/ko'){
                $('#korean').css({'font-weight': 'bold'});
            }else if(curLang == '/en/ja'){
                $('#japanese').css({'font-weight': 'bold'});
            }else if(curLang == '/en/th'){
                $('#thai').css({'font-weight': 'bold'});
            }else if(curLang == '/en/nl'){
                $('#dutch').css({'font-weight': 'bold'});
            }

        }else{
             $('#english').css({'font-weight': 'bold'});
        }

        
    })();


    $("#nav_wrapper #nav_bottom  li").hover(function(){
        //$(this).find("a").css({"background-color" : "#fff", "color": "#00897d"});
       // $(this).find("ul").show();
        }, function(){
           // $(this).find("a").css({"background-color" : "#00897d", "color": "#fff"});
            // $(this).find("ul").hide();
            
        }
    );

    
});

function validateHomeTrack(){

    if(document.getElementById('track_input').value ==''){

        document.getElementById('track_submit').style.marginTop = '4px';
        document.getElementById('home_track_warning').innerHTML = 'Enter a tracking number.';
        document.getElementById('home_track_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('home_track_warning').style.color = '#CC0000';
        document.getElementById('home_track_warning').style.fontSize = '13px';

        return false;

    }else if(document.getElementById('track_input').value.length < 10){

        document.getElementById('track_submit').style.marginTop = '4px';
        document.getElementById('home_track_warning').innerHTML = 'Invalid tracking number.';
        document.getElementById('home_track_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('home_track_warning').style.color = '#CC0000';
        document.getElementById('home_track_warning').style.fontSize = '13px';


        return false;
    }


    return true;
}


function validateHomeQuote(){

    if(document.getElementById('slider_quote_name').value =='' ||
        document.getElementById('slider_quote_email').value =='' ||
        document.getElementById('slider_quote_phone').value ==''){

        document.getElementById('slider_quote_submit').style.marginTop = '-0px';
        document.getElementById('home_quote_warning').innerHTML = 'Fill all required fields.';
        document.getElementById('home_quote_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('home_quote_warning').style.color = '#CC0000';
        document.getElementById('home_quote_warning').style.fontSize = '11px';


        return false;

    }else if(document.getElementById('slider_quote_name').value.length < 2 ||
        document.getElementById('slider_quote_email').value.length < 5 ||
        document.getElementById('slider_quote_phone').value.length < 3 ){

        document.getElementById('slider_quote_submit').style.marginTop = '-2px';
        document.getElementById('home_quote_warning').innerHTML = 'Fill all fields accurately.';
        document.getElementById('home_quote_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('home_quote_warning').style.color = '#CC0000';
        document.getElementById('home_quote_warning').style.fontSize = '13px';


        return false;
    }else{

        var emailEntered = document.getElementById('slider_quote_email').value;
        var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var bool = regex.test(emailEntered);
        
        if( bool == true){

            return true;

        }else{
            
            document.getElementById('slider_quote_submit').style.marginTop = '-2px';
            document.getElementById('home_quote_warning').innerHTML = 'Invalid email.';
            document.getElementById('home_quote_warning').style.textAlign = 'center';
            document.getElementById('home_quote_warning').style.fontFamily = 'arial, sans-serif';
            document.getElementById('home_quote_warning').style.color = '#CC0000';
            document.getElementById('home_quote_warning').style.fontSize = '13px';

            return false;

        }

    }




    return true;
}


function validateQuote(){

    if(document.getElementById('quote_name').value =='' ||
        document.getElementById('quote_email').value =='' ||
        document.getElementById('quote_telephone').value ==''){

        //document.getElementById('quote_submit').style.marginTop = '-2px';
        document.getElementById('quote_warning').innerHTML = 'Fill all required fields.';
        document.getElementById('quote_warning').style.textAlign = 'center';
        document.getElementById('quote_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('quote_warning').style.color = '#CC0000';
        document.getElementById('quote_warning').style.fontSize = '13px';


        return false;

    }else if(document.getElementById('quote_name').value.length < 2 ||
        document.getElementById('quote_email').value.length < 5 ||
        document.getElementById('quote_telephone').value.length < 3 ){

        //document.getElementById('slider_quote_submit').style.marginTop = '-2px';
        document.getElementById('quote_warning').innerHTML = 'Fill all fields accurately.';
        document.getElementById('quote_warning').style.textAlign = 'center';
        document.getElementById('quote_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('quote_warning').style.color = '#CC0000';
        document.getElementById('quote_warning').style.fontSize = '13px';


        return false;
    }else{

        var emailEntered = document.getElementById('quote_email').value;
        var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var bool = regex.test(emailEntered);
        
        if( bool == true){

            return true;

        }else{
            
            document.getElementById('quote_warning').innerHTML = 'Invalid email.';
            document.getElementById('quote_warning').style.textAlign = 'center';
            document.getElementById('quote_warning').style.fontFamily = 'arial, sans-serif';
            document.getElementById('quote_warning').style.color = '#CC0000';
            document.getElementById('quote_warning').style.fontSize = '13px';

            return false;

        }

    }




    return true;
}


function validateContact(){

    if(document.getElementById('contact_name').value =='' ||
        document.getElementById('contact_email').value =='' ||
        document.getElementById('contact_telephone').value ==''){

        //document.getElementById('contact_submit').style.marginTop = '-2px';
        document.getElementById('contact_warning').innerHTML = 'Fill all required fields.';
        document.getElementById('contact_warning').style.textAlign = 'center';
        document.getElementById('contact_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('contact_warning').style.color = '#CC0000';
        document.getElementById('contact_warning').style.fontSize = '13px';


        return false;

    }else if(document.getElementById('contact_name').value.length < 2 ||
        document.getElementById('contact_email').value.length < 5 ||
        document.getElementById('contact_telephone').value.length < 3 ){

        //document.getElementById('slider_contact_submit').style.marginTop = '-2px';
        document.getElementById('contact_warning').innerHTML = 'Fill all fields accurately.';
        document.getElementById('contact_warning').style.textAlign = 'center';
        document.getElementById('contact_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('contact_warning').style.color = '#CC0000';
        document.getElementById('contact_warning').style.fontSize = '13px';


        return false;
    }else{

        var emailEntered = document.getElementById('contact_email').value;
        var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var bool = regex.test(emailEntered);
        
        if( bool == true){

            return true;

        }else{
            
            document.getElementById('contact_warning').innerHTML = 'Invalid email.';
            document.getElementById('contact_warning').style.textAlign = 'center';
            document.getElementById('contact_warning').style.fontFamily = 'arial, sans-serif';
            document.getElementById('contact_warning').style.color = '#CC0000';
            document.getElementById('contact_warning').style.fontSize = '13px';

            return false;

        }

    }



    return true;
}



function validateTrack(){

    if(document.getElementById('main_track_input').value ==''){

        //document.getElementById('track_submit').style.marginTop = '4px';
        document.getElementById('track_warning').innerHTML = 'Enter a tracking number.';
        document.getElementById('track_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('track_warning').style.color = '#CC0000';
        document.getElementById('track_warning').style.fontSize = '13px';

        return false;

    }else if(document.getElementById('main_track_input').value.length < 10){

        //document.getElementById('track_submit').style.marginTop = '4px';
        document.getElementById('track_warning').innerHTML = 'Invalid tracking number.';
        document.getElementById('track_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('track_warning').style.color = '#CC0000';
        document.getElementById('track_warning').style.fontSize = '13px';


        return false;
    }


    return true;
}


function validateNewsletter(){

    if(document.getElementById('newsletter_input').value ==''){

        //document.getElementById('track_submit').style.marginTop = '4px';
        document.getElementById('newsletter_warning').innerHTML = 'Enter an email.';
        document.getElementById('newsletter_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('newsletter_warning').style.color = '#fff';
        document.getElementById('newsletter_warning').style.fontSize = '13px';

        return false;

    }else if(document.getElementById('newsletter_input').value.length < 5){



        //document.getElementById('newsletter_submit').style.marginTop = '4px';
        document.getElementById('newsletter_warning').innerHTML = 'Invalid email.';
        document.getElementById('newsletter_warning').style.fontFamily = 'arial, sans-serif';
        document.getElementById('newsletter_warning').style.color = '#fff';
        document.getElementById('newsletter_warning').style.fontSize = '13px';


        return false;
    }else{

        var emailEntered = document.getElementById('newsletter_input').value;
        var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var bool = regex.test(emailEntered);
        
        if( bool == true){

            return true;

        }else{
            
            document.getElementById('newsletter_warning').innerHTML = 'Invalid email.';
            document.getElementById('newsletter_warning').style.fontFamily = 'arial, sans-serif';
            document.getElementById('newsletter_warning').style.color = '#fff';
            document.getElementById('newsletter_warning').style.fontSize = '13px';

            return false;

        }

    }


    return true;
}
