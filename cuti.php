<?php
session_start();

$jabatan = $_SESSION['level'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pengajuan Cuti</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
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
<div id="container">
	<div id="top">
        <img src="include/HR_logo.gif" />
            <div style="margin-top:50px; padding-left:40px; padding-right:100px; float:right">
            <h1>Human Resource Management System</h1>
            </div>
    </div>
    <div>
        <?php 
        if($jabatan == "admin") {
            include "include/link_admin.php"; 
        }
        else if($jabatan == "boss") {
            include "include/link_boss.php";
        }
        else {
            include "include/link_user.php";
        }
        ?>
    </div>
    <br  />
    <div id="content">
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
    </div>
    <br  />
    <br  />
    <div id="bottom">
        <?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
