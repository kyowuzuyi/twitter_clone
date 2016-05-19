// JavaScript Document

i=1;
function fnsubmit()
{
	
	var NowDate=new Date();
　var h=NowDate.getHours();
　var m=NowDate.getMinutes();
　var s=NowDate.getSeconds();　
  var time=h+"時"+m+"分"+s+"秒"+"：";

  var odiv=document.getElementById("box");
  var oem=odiv.getElementsByTagName("em")[0];
  var otext=document.getElementById("text");
  var oli=odiv.getElementsByTagName("li");
  var add_li=document.createElement("li");
  var o_span=document.createElement("span");
  
  	if(otext.value=="")
	{
		alert("内容を入れてください！");
		return;
	}
  
  oem.style.display="none";
  o_span.style.position="absolute";
  o_span.style.top="-20px";
  o_span.style.right="20px";
  o_span.style.background="#cccccc";
  
  add_li.style.position="relative";
  add_li.index=i;
  add_li.style.background="#cccccc";
  add_li.style.marginBottom="20px";
  
  var str=document.createTextNode(time+otext.value);
  var strspan=document.createTextNode(time+otext.value+"内容？");
  add_li.appendChild(o_span);
  o_span.style.display="none";
  o_span.appendChild(strspan);
  add_li.appendChild(str);
  
  odiv.appendChild(add_li);
  i++;
  
  for(j=0;j<oli.length;j++)
  {
  	var m=j;
  	oli[j].onmouseover=function()
	{
		this.style.background="#ffff00";
		(this.childNodes(o_span)).style.display="block";
			
	};
	 oli[j].onmouseout=function()
	{
		this.style.background="#cccccc";
		(this.childNodes(o_span)).style.display="none";
	};
	 oli[j].onclick=function()
	{
		
		m--;
		odiv.removeChild(this);	
		if(m<0)
		{
			oem.style.display="block";
		};
	};
  };
  
  document.getElementById("text").value="What's happen";
}


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
	  
