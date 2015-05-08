var xmlHttp;
var name = false, username = false, pwd1 = false, pwd2 = false, email = false;
var reg=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/; 

function GetXmlHttpObject() {
	var objxmlHttp = null;
	
	if ( window.XMLHttpRequest ) {
		objxmlHttp = new XMLHttpRequest();
	}
	else if ( window.ActiveXObject ) {
		objxmlHttp = new ActiveXObject("Microsoft.XMLHttp");
	}
	return objxmlHttp;
}

function chkUsername(str) {
	//check  whether username is valid
	if (str == '') {
		document.getElementById("userInfor").innerHTML='Please input username!';
		username = false;
	} else {
		xmlHttp = GetXmlHttpObject();
		if( xmlHttp == null ) {
			alert( "Browser does not support HTTP Request" );
			return;
		}
		var url = "checkuser.php";
		url = url + "?userName=" + str;
		url = url+ "&sid=" + Math.random();
		xmlHttp.onreadystatechange = function(){
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
				var content = xmlHttp.responseText;
				if (content == 0) {
					document.getElementById("userInfor").innerHTML='Available!';
					username = true;
				} else {
					document.getElementById("userInfor").innerHTML='The username has been used!';
					username = false;
				}
			}
		} 
		xmlHttp.open("GET", url, true);
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.send(null);
	}
}

//check password1 and password2
function chkPwd1(str) {
	if( str =='' ){
		document.getElementById("pwdInfor").innerHTML='Please input password!';
		pwd1 = false;
	} else if ( str.length < 6 || str.length > 30) {
		document.getElementById("pwdInfor").innerHTML = 'Password need 6-30 characters!';
		pwd1 = false;
	} else if( document.getElementById("Reg_paswdCk").value == str ){
		document.getElementById("pwdInfor").innerHTML='Available!';
		document.getElementById("pwdCheckInfor").innerHTML='Available!';
		pwd1 = true;
		pwd2 = true;
	} else{
		document.getElementById("pwdInfor").innerHTML='Available!';
		document.getElementById("pwdCheckInfor").innerHTML='Please input password again!';
		pwd1 = true;
		pwd2 = false;
	}
}

function chkPwd2(str){
	if(str =='' ){
		document.getElementById("pwdCheckInfor").innerHTML='Please input password again!';
		pwd2 = false;
	} else if( document.getElementById("Reg_paswd").value == str){
		if ( str.length > 5) {
			document.getElementById("pwdCheckInfor").innerHTML='Available!';
			pwd2 = true;
		}
	} else{
		document.getElementById("pwdCheckInfor").innerHTML='The passwords you entered do not match!';
		pwd2 = false;
	}
}

//check email
function chkEmail(str) {
	if(str==''){
		document.getElementById("emailCheckInfor").innerHTML="Please input your email!";
		email=false;
	} else if(!reg.test(str)){  
			document.getElementById("emailCheckInfor").innerHTML="That is not a valid email address!";
			email=false;
		}else{  
			document.getElementById("emailCheckInfor").innerHTML="Available!";
			email=true;
		}
}

//output comment to the page
function chkComment() {
	var comment = document.getElementById('Com_txtArea').value;
	var com_pic_name = document.getElementById("picName2").value;
	var username2 = document.getElementById("userName2").value;
	if ( comment == '') {
		alert('Comment can\'t be empty!');
	} else {
		if (com_pic_name != 0) {
			xmlHttp = GetXmlHttpObject();
			if( xmlHttp == null ) {
				alert( "Browser does not support HTTP Request" );
				return;
			}
			var url = "checkcomment.php";
			url = url + "?comment=" + comment;
			url = url + "&com_pic_name=" + com_pic_name;
			url = url + "&username2=" + username2;
			url = url+ "&sid=" + Math.random();
			
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
					var content = xmlHttp.responseText;
					var strs= new Array(); 
					strs=content.split("@@@");
					//alert('comment = ' + comment + ' com_pic_name = ' + com_pic_name + ' username2 = ' +username2 +' content = '+content);
					if (strs[0] == 1 && strs[3] == 1) {
						alert('Comment success!');
						window.self.location = 'index.php?adminPicNum='+strs[1];
						//window.self.location
					} else if (strs[0] == 1 && strs[3] != 1) {
						alert('Comment success!');
						window.self.location = 'index.php?usePicNum='+strs[2];
					} else if (strs[0] == 0){
						alert('Comment failed!');
						history.go(-1);
					}
				}
			}
			xmlHttp.open("GET", url, true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send(null);
		} else {
			alert('There is no photo!');
		}
	}
}

//check submit
function checkSubmit(){ 
	if (username&&pwd1&&pwd2&&email) {
		return true;	
	} else {
		alert('Please input correct information!');
		return false;
	}
}