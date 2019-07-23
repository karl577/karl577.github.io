function findObj(theObj, theDoc){  var p, i, foundObj;    if(!theDoc) theDoc = document;  if( (p = theObj.indexOf("?")) > 0 && parent.frames.length)  {    theDoc = parent.frames[theObj.substring(p+1)].document;    theObj = theObj.substring(0,p);  }  if(!(foundObj = theDoc[theObj]) && theDoc.all) foundObj = theDoc.all[theObj];  for (i=0; !foundObj && i < theDoc.forms.length; i++)     foundObj = theDoc.forms[i][theObj];  for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++)     foundObj = findObj(theObj,theDoc.layers[i].document);  if(!foundObj && document.getElementById) foundObj = document.getElementById(theObj);    return foundObj;}


function testFetch(){
  document.getElementById("saction").value='testFetch';
  document.getElementById("myform").submit();
}

function showHTML(){
 var s=document.getElementById("ap_content_s").value;
  if(s==0){
    jQuery("#ap_content").hide();
	jQuery("#ap_content_html").show();
	document.getElementById("ap_content_s").value=1;
  }else{
	jQuery("#ap_content_html").hide();
	jQuery("#ap_content").show();
	document.getElementById("ap_content_s").value=0;  
  }
}

function Delete(id){
  if(confirm("Confirm Delete?")){ 
	 document.getElementById("saction").value='deleteSubmit';
	 document.getElementById("configId").value=id;
     document.getElementById("myform").submit();
  }else return false; 
}