function Framework(url) 
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
            alert("You need to choose at least " + this.minimumPoints + " points.");
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
    
    function checkIfUserExists(obj)
    {
        var email = $(obj).val();
        if(email != "")
        {
            
            var callback = function(data) {
                     if(data.type == "return")
                     {
                        if(data.value == "true")
                            alert("The email address you want to register is already taken.");
                     }
                     else if(data.type == "error")
                     {
                        alert(data.message);
                     }};
                     
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
        
      PosX = PosX - ImgPos[0];
      PosY = PosY - ImgPos[1];
        
      if(this.userPoints.length < this.maximumPoints)
        this.userPoints.push({X: PosX, Y: PosY});
      else
        alert("You can only set " + this.maximumPoints + " points.");
        
    }
    
    function getDefaultImages(callback)
    {   
        this.sendRequest("class=images&method=getDefaultImages", callback);  
    }
}

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