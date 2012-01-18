
function proceedToStep(oldStep, newStep, callbackBefore, callbackAfter)
{
    if(callbackBefore.method(callbackBefore.params))
    {
        var $lefty = $("#step_" + oldStep);
        $lefty.animate(
        {
          left: parseInt($lefty.css('left'),10) == 0 ?
            -$lefty.outerWidth() :
            0
        }, 
        "1000", 
        'linear', 
        function() 
        {
            $lefty.hide();            
            var $righty = $("#step_" + newStep);
            $righty.show();
            $righty.animate({
              left: parseInt($righty.css('left'),10) == 0 ?
                -$righty.outerWidth() :
                0
            }, "10", "linear", function() {
                callbackAfter.method(callbackAfter.params);
            });
        }); 
    }
}

function userCreated(data)
{
    if(data.type == "return")
     {
        alert("Ihr Zugang wurde erstellt.");
        window.location="index.php"
     }
     else if(data.type == "error")
     {
        alert(data.message);
     }
}

function checkIfValidEmail(params)
{
    var mode = params.mode;
    
    if(params.mode == undefined)
        mode = true;
        
    if(mode)
    {
        if(!userExists)
        {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            if(pattern.test(params.email))
                return true;
            
            alert("Die Email, die Sie eingegeben haben ist nicht korrekt!");
        }   
    }
    else
    {
        if(userExists)
        {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            if(pattern.test(params.email))
                return true;
            
            alert("Die Email, die Sie eingegeben haben ist nicht korrekt!");
        } 
    }
    
    return false;
}

function getUserImage(params)
{
    yaapps.getUserImage(function(data) {
        $("#img_background").css("background-image",  "url(generated/gallery/large/" + data.value[0].name+ ')');
        $("#img_background").css("background-repeat",  "no-repeat");
    }, params.email);
}

function showBorderForImage(id)
{
    $('.image_div').each(function(obj)
    {
       $(this).css('outline', 'none'); 
    });
    
    $('#'+id+'_div').css('outline', '3px solid green');
}

function moveCarousell(direction)
{

    if(direction == "left")
    {
        var margin = parseInt($('#gallery').css('margin-left'));
        margin-=730;
        var width = 0;
        
        $('#gallery div').each(function(){
            width+= $(this).width();
        });
 
        if(width > (margin - (2 * margin)))
            $('#gallery').css('margin-left',  margin + "px");
    }
    else if(direction == "right")
    {
        var margin = parseInt($('#gallery').css('margin-left'));
        margin+=730;
    
        if(margin <= 0)
            $('#gallery').css('margin-left', margin + "px");
    }
}

function getImages(params)
{
    yaapps.getDefaultImages(function(data) {
         if(data.type == "return")
         {
            var html = "";
            var i=0;
            for (i=0; i < data.value.length; i++)
            {
                html+='<div style="width:240px;height:240px;float: left;margin-right:5px;background-image:url(generated/gallery/'+data.value[i].name+')" class="image_div" id="'+data.value[i].id+'_div" style="float: left;margin-left: 5px;">'
                        + '<a onclick="yaapps.setImage('+data.value[i].id+', \''+data.value[i].name+'\', function() {$(\'#button_gallery\').show();});showBorderForImage(\''+data.value[i].id+'\');" style="cursor: pointer">'
                        + '<img style="margin-top: 180px;" src="resource/images/thisone.png" /></a>'
                    + '</div>';
            }
            
            $("#gallery").html(html);
         }
         else if(data.type == "error")
         {
            yaapps.showMessage(data.message);
         }
    });
}

function emptyField(obj, method, value)
{
    if(method == 'onBlur')
        if($(obj).val()=='')
            $(obj).val(value)
    
    if(method == 'onFocus')
        if($(obj).val()==value) 
            $(obj).val('')
}