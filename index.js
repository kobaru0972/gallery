
$(function(){
    $(function(){
        $(".popup").css("display","none");

    });
    $(".image").click(function(){

        var name =$(this).attr("name");
        if(name == "image0"){
            var popup_image = $fullPath_js_data[0];
        }
        else if(name == "image1"){
            var popup_image = $fullPath_js_data[1];
        }
        else if(name == "image2"){
            var popup_image = $fullPath_js_data[2];
        }
        else if(name == "image3"){
            var popup_image = $fullPath_js_data[3];
        }
        else if(name == "image4"){
            var popup_image = $fullPath_js_data[4];
        }
        else{
            var popup_image = $fullPath_js_data[5];
        }
        var img = new Image();
        img.src = popup_image;
        var img_width = img.width;
        var img_height = img.height;

        var new_img_width ="";
        var new_img_height ="";        
        if (img_width > img_height) {
            new_img_width ="700px";
            new_img_height ="auto" ;
        }
        else{
            new_img_width ="auto";
            new_img_height ="700px" ;
        }

        $(".popup_img").attr({"src": popup_image,"width": new_img_width,"height": new_img_height});

        $(".popup").fadeIn(2000);
    });

    $(".popup").click(function(e){
        if($(e.target).is(".popup_img")) {
            
        } else {
            $(".popup").fadeOut(500);
        }
    });
});