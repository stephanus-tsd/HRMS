<?php
session_start();
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$array = $sql->getYear();
$num = $sql->get_num_rows();

$sql->close_connection();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
<script type="text/javascript">
function getGraph() {
	var year = document.getElementById("year").options[document.getElementById("year").selectedIndex].text;
	var open = window.open("cuti_graph.php?year="+year);
	open.form = form;
}
</script>
</head>

<body>
<div>
<form>
<table>
	<tr>
    	<td>Tahun</td>
        <td>:</td>
        <td><select name="year" id="year">
        	<?php for($i = 0 ; $i < $num ; $i++) { ?>
            <option value="<?php echo $array[0][$i] ?>"><?php echo $array[0][$i] ?></option>
            <?php } ?>
        </select>
        </td>
        <td><input type="button" onclick="getGraph()" value="submit" />
    </tr>
</table>
</form>
</div>
<br  />
<div id="graph">
</div>
</body>
</html>
