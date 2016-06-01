var xmlhttp_sp = false;

try {
//If the Javascript version is greater than 5.
	  xmlhttp_sp = new ActiveXObject("Msxml2.XMLHTTP");

	} catch (e) {
//If not, then use the older active x object.
try {

	   xmlhttp_sp = new ActiveXObject("Microsoft.XMLHTTP");

} catch (E) {
//Else we must be using a non-IE browser.
			  xmlhttp_sp = false;
			}
}

if (!xmlhttp_sp && typeof XMLHttpRequest != 'undefined') {
		  xmlhttp_sp = new XMLHttpRequest();

}
/*ajax request function*/
function makerequest_sp(serverPage, params, objID)
{  
	/*display loading inside a custom created DIV*/
	create_foo_costum(100,250,'myFoo');
	/*load loading image*/
	document.getElementById('myFoo').innerHTML ='<div align="center"><image src="/expenseManagement/images/loading.gif" border="0"></div>';
	/*add a random number at the end of parammeters*/
	var myRandom=parseInt(Math.random()*99999999);
	params+='&'+myRandom;
	//set url
	var url = serverPage;
	//set xml method to POST
	xmlhttp_sp.open("POST", url, true);
	//Send the proper header information along with the request
	xmlhttp_sp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp_sp.setRequestHeader("Content-length", params.length);
	xmlhttp_sp.setRequestHeader("Connection", "close");
	xmlhttp_sp.onreadystatechange = function() {//Call a function when the state changes.
		if(xmlhttp_sp.readyState == 4 && xmlhttp_sp.status == 200) {
			document.getElementById(objID).innerHTML = xmlhttp_sp.responseText;
			delete_foo_custom('myFoo');
		}
	}
	//send parameters
	xmlhttp_sp.send(params);    
   
}

function language_change(serverPage, sel, c_url)
{  
	var lang = sel[sel.selectedIndex].value;
	var myRandom=parseInt(Math.random()*99999999);
	var params ='&lang='+lang+'&'+myRandom;
	//set url
	var url = serverPage;
	//set xml method to POST
	xmlhttp_sp.open("POST", url, true);
	//Send the proper header information along with the request
	xmlhttp_sp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp_sp.setRequestHeader("Content-length", params.length);
	xmlhttp_sp.setRequestHeader("Connection", "close");
	xmlhttp_sp.onreadystatechange = function() {//Call a function when the state changes.
		if(xmlhttp_sp.readyState == 4 && xmlhttp_sp.status == 200) {
			if(xmlhttp_sp.responseText == 1)
			{
			   window.location = c_url;
			}
		}
	}
	//send parameters
	xmlhttp_sp.send(params);
	   
   
}
