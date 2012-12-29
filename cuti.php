<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type='Text/JavaScript' src='include/scw.js'></script>

<script type="text/javascript">
function blank(a) { if(a.value == a.defaultValue) a.value = ""; }

function unblank(a) { if(a.value == "") a.value = a.defaultValue; }

function prosesFunc() {
	var xmlhttp;
	var tglAwal = document.getElementById("startDate").value;
	var tglAkhir = document.getElementById("endDate").value;
	
	if (tglAwal == "" || tglAkhir == "") {
		alert("Ada field yang masih kosong");
	}
	else {
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("warning").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","cuti_process.php?tglAwal="+tglAwal+"&tglAkhir="+tglAkhir,false);
		xmlhttp.send();
	}
}
</script>
</head>

<body>
<div>
	<form>
	<table>
    	<tr>
        	<td>Tanggal Awal Cuti : 
            	<input value="" name="startDate" id="startDate" type="text" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)">
            </td>
            <td>Tanggal Akhir Cuti : 
            	<input value="" name="endDate" id="endDate" type="text" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)">
            </td>
            <td>
            	<input type="button" value="Submit" onclick="prosesFunc()" />
            </td>
        </tr>
    </table>
    </form>
</div>
<div id="warning">
</div>
</body>
</html>
