function radCheckValue(fname)
{
  var str='' ;   
  var tform = document.getElementById(fname); 
  for (i=0;i<tform.length;i++) 
  {
	var tempobj=tform.elements[i];
	if (tempobj.type.toLowerCase() =='checkbox') {str=str+check_radio_cbox(tempobj);}
  }
  //alert(str); return;
  return  str;
}


function form_parse(fname){
//alert(fname);return;
var tform = document.getElementById(fname);
 //alert(tform);
var str='' ;
for (i=0;i<tform.length;i++) {
var tempobj=tform.elements[i];
	 //alert(tempobj.name);   
if (tempobj.type.toLowerCase() =='text') {if (tempobj.value!='') str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase() =='hidden') {str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase() =='password') {str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase() =='radio') {str=str+check_radio_cbox(tempobj);}
if (tempobj.type.toLowerCase() =='textarea') {if (tempobj.value!='') str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase() =='submit') {str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase() =='checkbox') {str=str+check_radio_cbox(tempobj);}
if (tempobj.type.toLowerCase() =='image') {str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase() =='file') {str=str+tempobj.name+"="+tempobj.value+"&";}
if (tempobj.type.toLowerCase().substring(0,6) =='select') {if (tempobj.options[tempobj.selectedIndex].value!='') str=str+tempobj.name+"="+tempobj.options[tempobj.selectedIndex].value+"&";}
  //str=str+tempobj.name+"="+tempobj.value+"&";
} 
if (document.getElementById('n_mesaj')) 
{
	var mesaj=document.getElementById('n_mesaj');
	str=str+mesaj.name+"="+mesaj.value+"&";
	
}
str = '?'+str;
//document.write(tempobj.name+" ss "+tempobj.type+' hh '+tempobj.options[tempobj.selectedIndex].value);
//document.write(str);

return str;
}


function check_radio_cbox(f){
var deger='';
		 if (f.checked){ deger=f.name+"="+f.value+"&"; return deger; } 
	return deger;
}

function do_it (fname ){

	if (validate(fname))
	{
		if (fname != ''){
		deger=form_parse(fname);} else { deger='';} ;
		
   //document.write(reqpage+deger);
   // makerequest(reqpage+deger, reqlocate)  ;
	   return deger;
	} else return 'hata';
}

function do_it2 (fname ){

	//alert(fname);return;   
	if (validate(fname))
	{

		if (fname != '')
		{
		//deger=form_parse(fname);} else { deger='';} ;
		var form = document.getElementById(fname); 
		form.submit();
		}
	} else 
	{
		return false;
		
	}
}
function validate(fname){
	var tform = document.getElementById(fname);
	for (i=0;i<tform.length;i++) {
		 
		var tempobj=tform.elements[i]; 
			if ((tempobj.name.substring(0,2) == 'n_' || tempobj.name.substring(0,2) =='r_ ') && tempobj.value == '' ) {
					tempobj.style.border = '1px solid #FF0000';
					tempobj.focus();
					return false;
			}
			if(tempobj.name.substring(0,2) == 'p_' && (tempobj.value == '' || tempobj.value.length <6) )
			{
				tempobj.style.border = '1px solid #FF0000'; 
				tempobj.focus();
				return false;
			}
		
			else if (tempobj.name.substring(0,2) == 'n_' && tempobj.value != '' )
			{
				if (tempobj.name == 'email' || tempobj.name == 'n_email')
				{
						apos = tempobj.value.indexOf('@');
						dotpos = tempobj.value.lastIndexOf('.');
						if (apos<1||dotpos-apos<2 || tempobj.value.length <= dotpos+1)
						{
							tempobj.style.border = '1px solid #FF0000';
							tempobj.focus();
							return false;
						}
				}
				if (tempobj.name.substring(0,3) == 'num' || tempobj.name.substring(0,5) == 'n_num')
				{
					if (tempobj.value.length < 11)
					{
						tempobj.style.border = '1px solid #FF0000';
						tempobj.focus();
						return false;
					}
				}  
				tempobj.style.border = '1px solid #CCCCCC';
			}

	}
	return true;
}

function ismaxlength(obj){
var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
if (obj.getAttribute && obj.value.length>mlength)
obj.value=obj.value.substring(0,mlength)
}
/*POPUP SHOW AND CAN BE MOVABLE*/
function popup_show(id, position, x, y, position_id)
{ 
  //alert('drag'+drag_id);
  var element      = document.getElementById(id);
  var width        = window.innerWidth  ? window.innerWidth  : document.documentElement.clientWidth;
  var height       = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;
  
  element.style.position = "absolute";
  element.style.display  = "block";

  if (position == "element" || position == "element-right" || position == "element-bottom")
  {
	var position_element = document.getElementById(position_id);

	for (var p = position_element; p; p = p.offsetParent)
	  if (p.style.position != 'absolute')
	  {
		x += p.offsetLeft;
		y += p.offsetTop;
	  }

	if (position == "element-right" ) x += position_element.clientWidth;
	if (position == "element-bottom") y += position_element.clientHeight;

	element.style.left = x+'px';
	element.style.top  = y+'px';
  }

  if (position == "mouse")
  {
	element.style.left = (document.documentElement.scrollLeft+popup_mouseposX+x)+'px';
	element.style.top  = (document.documentElement.scrollTop +popup_mouseposY+y)+'px';
  }

  if (position == "screen-top-left")
  {
	element.style.left = (document.documentElement.scrollLeft+x)+'px';
	element.style.top  = (document.documentElement.scrollTop +y)+'px';
  }

  if (position == "screen-center")
  {
	element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )/2+x)+'px';
	element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)/2+y)+'px';
  }

}


/*CREATE A CUSTOME DIV*/
function create_foo_costum (ust,sol,divid)
{

	var width_cont = document.body.scrollLeft;
	var height_cont = document.body.scrollTop;
	var padding_left = (width_cont/2) - 25;
	var padding_top = height_cont/2-25;
	var buyuk_div = document.createElement('DIV');
	buyuk_div.id = 'biggerdv';
	buyuk_div.style.width = width_cont+"px";
	buyuk_div.style.height = height_cont+"px";
	buyuk_div.style.position = 'absolute';
	buyuk_div.style.left = (0)+"px";
	buyuk_div.style.top = (0)+"px";
	buyuk_div.style.bgcolor = '#EEEEEE';
	window.document.body.appendChild(buyuk_div);

	var div = document.createElement('DIV');
	div.id = divid;
	div.style.width='60%'; 
	div.style.MOZwidth='60%';
	//div.style.height = '250';
	div.style.position = 'absolute';

	 div.style.left = sol+"px";
	div.style.top = ust+"px";
   
	
	div.style.zIndex=90;
	div.style.color="#000000";
	
	document.body.appendChild(div);             
	
	
	popup_show(divid, 'screen-center',0,-120);	
}
/*DELETE CUSTOME FOO*/
function delete_foo_custom(id)
{
  //  opacity('foo', 80, 0, 500);
	  var div = document.getElementById(id);
				var buyuk_div =  document.getElementById('biggerdv');
				document.body.removeChild(div);
				document.body.removeChild(buyuk_div);
}


function FilterInput(filterType, evt, allowDecimal, allowCustom)
{
	 var keyCode, Char, inputField, filter = '';
	 var alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 var num   = '0123456789';

	 // Get the Key Code of the Key pressed if possible else - allow
	 if(window.event) {keyCode = window.event.keyCode; evt = window.event;} else if(evt) {keyCode = evt.which;} else {return true;}

	 // Setup the allowed Character Set
	 if(filterType == 0) {filter = alpha;} else if(filterType == 1) {filter = num;} else if(filterType == 2) {filter = alpha + num;}
	 if(allowCustom) {filter += allowCustom;}
	 if(filter == '') {return true;}

	 // Get the Element that triggered the Event
	 inputField = evt.srcElement ? evt.srcElement : evt.target || evt.currentTarget;

	 // If the Key Pressed is a CTRL key like Esc, Enter etc - allow
	 if((keyCode==null) || (keyCode==0) || (keyCode==8) || (keyCode==9) || (keyCode==13) || (keyCode==27)) {return true;}

	 // Get the Pressed Character
	 Char = String.fromCharCode(keyCode);

	 // If the Character is a number - allow
	 if((filter.indexOf(Char) > -1)) {return true;} else if(filterType == 1 && allowDecimal && (Char == '.') && inputField.value.indexOf('.') == -1) {return true;} else {return false;}
}

/*load a content  by ajax with drop down option*/
function bring_page(page,namee,id,divname,str)
{
	 /*
	  page: the server page where an ajax trigers
	  name: drop down name
	  id: user specify where the drop down value assaigns
	  divname: where to display the server response text
	  str: string where a user can send custome post data
	 */
     var dropdownIndex = document.getElementById(namee).selectedIndex;
     //alert(dropdownIndex);
	 var dropdownValue = document.getElementById(namee)[dropdownIndex].value;
     
	 var url=page;
	 var params='&'+id+'='+dropdownValue+'&'+str;
	 //call ajax 
	 makerequest_sp(url, params, divname);
}
//show hide 2 div
function showhideD(name1,name2,type)
{
	//DISPLAY STYLE
	var d1=document.getElementById(name1).style; 
	var d2=document.getElementById(name2).style; 
	if(type ==1)
	{
		 d1.display ='block';  
		 d2.display ='none';  
	}
	else
	{
		 d2.display ='block';  
		 d1.display ='none';
	}
	return;
   
}



//hide show one dive
function showhideOneD(divname,name)
{
	//DISPLAY STYLE
	var dropdownIndex = document.getElementById(name).selectedIndex;
	var dropdownValue = document.getElementById(name)[dropdownIndex].value;
	var d1=document.getElementById(divname).style; 
	if(dropdownValue ==1)
	{
		 d1.display ='block';   
	}
	else
	{
		 d1.display ='none';
	}
	return;
   
}


function showhide(checkboxname,name1)
{

	//DISPLAY STYLE
	var d1=document.getElementById(name1).style; 
	 
	if(document.getElementById(checkboxname).checked)
	{
		 d1.display ='block';    
	}
	else
	{ 
		 d1.display ='none';
	}
	return;
}


function popWindow(mypage){

	if( typeof( window.innerWidth ) == 'number' ) {
	//Non-IE
	myWidth = window.innerWidth;
	myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
	//IE 6+ in 'standards compliant mode'
	myWidth = document.documentElement.clientWidth;
	myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
	//IE 4 compatible
	myWidth = document.body.clientWidth;
	myHeight = document.body.clientHeight;
  }

	myWidth -= 470;

	var property = 'width = ' + myWidth + ', height = ' + myHeight+50 + ', toolbar=no, scrollbars=yes, resizable=yes';
	var naw = window.open(mypage, 'document', property);
	if (window.focus)
	{
		naw.focus();
	}
}

/* a popupt window opener with exact x y coordinate and screen specific positions
   screen-center,
*/
function popup_show(id, position, x, y, position_id)
{ 
  //alert('drag'+drag_id);
  var element      = document.getElementById(id);
  var width        = window.innerWidth  ? window.innerWidth  : document.documentElement.clientWidth;
  var height       = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;
  
  element.style.position = "absolute";
  element.style.display  = "block";

  if (position == "element" || position == "element-right" || position == "element-bottom")
  {
	var position_element = document.getElementById(position_id);

	for (var p = position_element; p; p = p.offsetParent)
	  if (p.style.position != 'absolute')
	  {
		x += p.offsetLeft;
		y += p.offsetTop;
	  }

	if (position == "element-right" ) x += position_element.clientWidth;
	if (position == "element-bottom") y += position_element.clientHeight;

	element.style.left = x+'px';
	element.style.top  = y+'px';
  }

  if (position == "mouse")
  {
	element.style.left = (document.documentElement.scrollLeft+popup_mouseposX+x)+'px';
	element.style.top  = (document.documentElement.scrollTop +popup_mouseposY+y)+'px';
  }

  if (position == "screen-top-left")
  {
	element.style.left = (document.documentElement.scrollLeft+x)+'px';
	element.style.top  = (document.documentElement.scrollTop +y)+'px';
  }

  if (position == "screen-center")
  {
	element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )/2+x)+'px';
	element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)/2+y)+'px';
  }

}
function windowwidth(divname,leftdiv,rightdiv)
{
	var leftdiv=parseInt(leftdiv);
	var rightdiv=parseInt(rightdiv);
	var clientwidth=document.body.clientWidth;
	var clientheight=document.documentElement.clientHeight;
	// out target div
	var targetdiv=document.getElementById(divname);
	// setting the width
	document.getElementById(divname).style.width=clientwidth-(rightdiv+leftdiv)+"px";
	document.getElementById(divname).style.height=(parseInt(clientheight)-(40))+"px";
}

/*load a content  by ajax with drop down option and input box paragraph id*/
function bring_page_parag(page,name,dep,inputboxid,id,divname,str)
{
	 /*
	  page: the server page where an ajax trigers
	  name: drop down name
	  id: user specify where the drop down value assaigns
	  inputboxid: get input box value and send
	  divname: where to display the server response text
	  str: string where a user can send custome post data
	 */
	 
	 var parag=document.getElementById(inputboxid).value;  
	 var dropdownIndex = document.getElementById(name).selectedIndex;
	 var dropdownValue = document.getElementById(name)[dropdownIndex].value;
	 
	 
	 //department
	 var depIndex = document.getElementById(dep).selectedIndex;
	 var depValue = document.getElementById(dep)[depIndex].value;
	 
	 var url=page;
	 var params='&'+id+'='+dropdownValue+'&parag='+parag+'&dep='+depValue+'&'+str;
	
	 //call ajax 
	 makerequest_sp(url, params, divname);
}

/*load a content  by ajax with strign post data*/
function load_page_pagination(page,divname,starting,str)
{
	 /*
	  page: the server page where an ajax trigers
	  starting: starting record 
	  divname: where to display the server response text
	  str: string where a user can send custome post data
	 */
	 var url=page;
	 var params='&starting='+starting+'&'+str;
	 //call ajax 
	 makerequest_sp(url, params, divname);
}
/*
 load a page with the form via ajax request
*/
function  load_page_wform(page,divid,formid)
{
	 var formvalues = do_it(formid);  
	 if(formvalues!='hata')
	 {
		  url=page;
		  formvalues=formvalues.substring(1,formvalues.length);  
		  var params=formvalues+'&';
		  makerequest_sp(url, params, divid);
	 }
}


/*show and hide a div*/
//show hide 2 div
function ShowHideDiv(name1,type)
{

	//emtpy text box in order not to include in search
	document.getElementById('keyword'+name1).value='';
	//DISPLAY STYLE
	var d1=document.getElementById(name1).style; 
	if(type ==1)
	{
		 d1.display ='block';   
	}
	else
	{
		 d1.display ='none';
	}
	return;
   
}
//redirect to modules
function redirect_module(sel)
{
	var module = sel[sel.selectedIndex].value; 
	window.location = module;
}

function redirectITLang (sel,page,c_url) {
    var url = sel[sel.selectedIndex].value;
    window.location = page+"/"+url+"/"+c_url;
}

function popitup(url) {
    var width  = 600;
    var height = 300;
    var left   = (screen.width  - width)/2;
    var top    = (screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    params += ', directories=no';
    params += ', location=no';
    params += ', menubar=no';
    params += ', resizable=no';
    params += ', scrollbars=no';
    params += ', status=no';
    params += ', toolbar=no';
    newwin=window.open(url,'windowname5', params);
    if (window.focus) {newwin.focus()}
    return false;
}

//close popup window and refresh the parent window
function CloseAndRefresh() 
{
    window.close();
    if (window.opener && !window.opener.closed) {
    window.opener.location.reload();
    } 
}

function checkEnableSubmit(sname) {
  if (sname.options[sname.selectedIndex].value==='') // some logic to determine if it is ok to go
    {document.getElementById("sbutton").disabled = true;}
  else // in case it was enabled and the user changed their mind
    {document.getElementById("sbutton").disabled = false;}
}

 