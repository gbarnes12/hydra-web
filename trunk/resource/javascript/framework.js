function Framework(url) 
{
    
    this.URL = url;
    this.sendRequest = sendRequest;
    this.checkIfUserExists = checkIfUserExists;
    this.getDefaultImages = getDefaultImages;
    
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
            
            this.sendRequest("class=user&method=checkIfUserExists&email="+email, callback);  
        }
    } 
    
    
    function getDefaultImages(callback)
    {   
        this.sendRequest("class=images&method=getDefaultImages", callback);  
    }
}