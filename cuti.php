<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type='Text/JavaScript' src='include/scw.js'></script>

<script type="text/javascript">
function blank(a) { if(a.value == a.defaultValue) a.value = ""; }
	function unblank(a) { if(a.value == "") a.value = a.defaultValue; }

</script>
</head>

<body>
<div>
	<form>
	<table>
    	<tr>
        	<td>Tanggal Awal Cuti : 
            	<input value="Tanggal Cuti" name="startDate" id="startDate" type="text" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)">
            </td>
            <td>Tanggal Akhir Cuti : 
            	<input value="Tanggal Cuti" name="endDate" id="endDate" type="text" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)">
            </td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>
