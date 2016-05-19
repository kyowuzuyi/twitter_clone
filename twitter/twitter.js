// JavaScript Document

function resettext(id){ //恢復文字(onblur)
	   if(id.value == "")
	   {
		   id.value = id.defaultValue;
           id.className ="t1";   
	   }
	             }
function cleartext (id){ //清除文字(onfocus)
	  id.value ="";
      d.className ="";   
	  }
	  