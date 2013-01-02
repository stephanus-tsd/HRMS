<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGIN</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>

<body>
<div id="content" align="center" style="width:900px; border-color:#FFCC00; float:center; margin:90px auto;">
	<div id="top">
        <img src="include/HR_logo.gif" />
            <div style="margin-top:50px; padding-left:40px; padding-right:100px; float:right">
            <h1>Human Resource Management System</h1>
            </div>
    </div>
    <hr />
	<div>Login</div>
	<div>
        <form method="post" action="login_verification.php">
            <table>
            	<tr>
                	<td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="user" /></td>
                </tr>
                <tr>
                	<td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="pass" /></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
