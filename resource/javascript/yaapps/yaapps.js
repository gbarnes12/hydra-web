function yaapps(url) 
{
    
    this.URL = url;
    this.userPoints = new Array();
    this.maximumPoints = 5;
    this.minimumPoints = 3;
    this.userEmail = "";
    
    this.sendRequest = sendRequest;
    this.checkIfUserExists = checkIfUserExists;
    this.getDefaultImages = getDefaultImages;
    this.setPoint = setPoint;
    this.createUser = createUser;
    this.pointsToString = pointsToString;
    this.getUserImage = getUserImage;
    
    function sendRequest(data, callback)
    {
        $.ajax({
			url : this.URL,
			dataType: 'json',
			data: data,
			type: 'POST',
			success: callback
		});
    }
    
    function createUser(callback)
    {
        if(this.userPoints.length >= this.minimumPoints)            
        {
            this.sendRequest("class=user&method=createUser&email="+this.email+"&password="+this.pointsToString(), callback);
        }
        else
        {
            showMessage("You need to choose at least " + this.minimumPoints + " points.");
        }
    }
    
    function pointsToString()
    {
        var string = "";
        
        if(this.userPoints.length > 0)
        {
            var i = 0;
            for(i = 0;i < this.userPoints.length;i++)
            {
                string+="{X:"+this.userPoints[i].X+",Y:"+this.userPoints[i].Y+"}";
                
                if(this.userPoints.length-1 != i)
                    string+=",";
            }
        }
        
        return string;
    }
    
    function checkIfUserExists(obj, showmessage)
    {
        var email = $(obj).val();
        if(email != "")
        {
            
            var callback = function(data) {
                     if(data.type == "return")
                     {
                        if(data.value == "true")
                        {
                            if(showmessage)
                            {
                                showMessage("The email address you want to register is already taken.");
                            }
                                
                            userExists = true;
                        }
                        else
                        {
                            if(!showmessage)
                            {
                                showMessage("The email address you supplied doesn't exist.");
                            }
                            
                            userExists = false;
                        }
                     }
                     else if(data.type == "error")
                     {
                        showMessage(data.message);
                        userExists = true;
                     }
            };
                     
            this.email = email;
            this.sendRequest("class=user&method=checkIfUserExists&email="+email, callback);  
        }
    } 
    
    
    function setPoint(event, obj)
    {
      var PosX = 0;
      var PosY = 0;
      var ImgPos;
      
      ImgPos = FindPosition(obj);
      
      if (!e) var e = event;
      if (e.pageX || e.pageY)
      {
        PosX = e.pageX;
        PosY = e.pageY;
      }
      else if (e.clientX || e.clientY)
      {
          PosX = e.clientX + document.body.scrollLeft
            + document.documentElement.scrollLeft;
          PosY = e.clientY + document.body.scrollTop
            + document.documentElement.scrollTop;
      }
        
      IMGPosX = PosX - ImgPos[0];
      IMGPosY = PosY - ImgPos[1];
        
      if(this.userPoints.length < this.maximumPoints)
      {
        this.userPoints.push({X: IMGPosX, Y: IMGPosY});
      
        // create indicator at the position of the last click
        var div = '<div id="indicator" style="display:none;color: white;position: absolute; z-index: 1;top: ' + (PosY - 20) + 'px; left: ' + (PosX - 20) + 'px"><img src="resource/images/indicator.gif" /></div>';
        $("body").append(div);
        $("#indicator").fadeIn('fast', function(){
            $(this).fadeOut('fast', function(){
                $(this).remove();
            });
        });
      }
      else
        showMessage("You can only set " + this.maximumPoints + " points.");
        
    }
    
    function getUserImage(callback, email)
    {
        this.sendRequest("class=user&method=getUserImages&email="+email, callback);
    }
    
    function getDefaultImages(callback)
    {   
        this.sendRequest("class=images&method=getDefaultImages", callback);  
    }
    
    function hideMessage()
    {
        $("#messagebox").fadeOut('slow', function(){
                $(this).remove();
            });
    }
    
    function showMessage(message)
    {
        var div = '<div id="messagebox" style="display:none;position: absolute;left: 500px;background-color:grey;z-index: 1;padding: 10px;top: 10px;width: 400px;border: 1px solid #FFF" >'+message+'</div>';
        $("body").append(div);
        $("#messagebox").fadeIn('slow', function(){
            window.setTimeout(hideMessage, 1000);
        });
    }
}

// needs to be globally accessible;
var userExists = false;

function FindPosition(oElement)
{
  if(typeof( oElement.offsetParent ) != "undefined")
  {
    for(var posX = 0, posY = 0; oElement; oElement = oElement.offsetParent)
    {
      posX += oElement.offsetLeft;
      posY += oElement.offsetTop;
    }
      return [ posX, posY ];
    }
    else
    {
      return [ oElement.x, oElement.y ];
    }
}