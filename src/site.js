function verifyForm(){
		
	//Verify user input, then submit form if all is in order.
			
	var subFlag=true;
	var err="";
			
	var user=document.getElementByID("username");
	var pass1=document.getElementByID("password1");
	var pass2=document.getElementByID("password2");
	var email1=document.getElementByID("email1");
	var email2=document.getElementByID("email2");
	
	function verify(){
		if(user.value==""){
			err+="Please enter a username!<br>";
			document.getElementsByClassName("user").style.color="red";
			subFlag=false;
		}
				
		if(pass1.value!=pass2.value){
			err+="Passwords do not match!<br>";
			document.getElementsByClassName("pass").style.color="red";
			subFlag=false;
		}
				
		if(email1.value!=email2.value){
			err+="Emails do not match!<br>";
			document.getElementsByClassName("email").style.color="red";
			subFlag=false;
		}	
			
		console.log(subFlag);			
		console.log(err);
			
		if(subFlag==true){
			document.getElementByID("regForm").submit;
		}
		
		//return 0;
	}
	
}