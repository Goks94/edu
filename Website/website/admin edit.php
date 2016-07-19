<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  $user_check=$_SESSION['MM_Username'];
  $password_check=$_SESSION['MM_Password'];
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);

  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<?php require_once('Connections/con_db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE `admin` SET name=%s, desig=%s, email=%s, mobileno=%s WHERE adminID='$user_check'",
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['select'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['tel'], "double"));
					   
  if($_POST['password3'] != NULL) {
 		$passwordUpdateSQL = sprintf("UPDATE `admin` SET password=%s WHERE adminID='$user_check'",
                       GetSQLValueString($_POST['password3'], "text"));
	
		mysql_select_db($database_con_db, $con_db);					   
 		$Result2 = mysql_query($passwordUpdateSQL, $con_db) or die(mysql_error());
  }
 
  mysql_select_db($database_con_db, $con_db);
  $Result1 = mysql_query($updateSQL, $con_db) or die(mysql_error());

  $updateGoTo = "admin settings.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_con_db, $con_db);
$query_rs_adminEdit = "SELECT * FROM `admin` WHERE adminID='$user_check'";
$rs_adminEdit = mysql_query($query_rs_adminEdit, $con_db) or die(mysql_error());
$row_rs_adminEdit = mysql_fetch_assoc($rs_adminEdit);
$totalRows_rs_adminEdit = mysql_num_rows($rs_adminEdit);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edu</title>
<link rel="shortcut icon" href="edu_icon.ico" type="image/ico" />
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
.header1 {
	position: absolute;
	left: 9px;
	top: 27px;
	width: 1245px;
}
.header2 {
	position: absolute;
	left: 1246px;
	top: 17px;
}
body {
	background-size: cover;
}
</style>
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-effects.custom.min.js" type="text/javascript"></script>
<script type="text/javascript">
var password_check = '<?php echo $_SESSION["MM_Password"]; ?>';
function checkForm(form)
  { if(form.password1.value == "" && form.password2.value == "" && form.password3.value == "") {
	 return true;
    }
	else {
  	if(form.password1.value != password_check) {
		alert("Error: Enter a valid current password!");
		return false;
    }
	else {
	if(form.password2.value != "" && form.password2.value == form.password3.value) {
	  if(form.password2.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.password2.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.password2.value)) {
        alert("Error: Your password must contain atleast one number (0-9)!");
        form.password2.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.password2.value)) {
        alert("Error: Your password must contain atleast one lowercase letter (a-z)!");
        form.password2.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.password2.value)) {
        alert("Error: Your password must contain atleast one uppercase letter (A-Z)!");
        form.password2.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed the same password!");
      form.password2.focus();
      return false;
    }

    alert("Password changed.");
    return true;
	}
   }
  }
</script>
</head>

<body background="images/background.jpg">
<p><div class="header1"><img src="images/edu logo.png" width="50" height="50"  alt=""/>

&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

<span class="header2">
 <form method="POST" name="logout" action="<?php echo $logoutAction; ?>">
  <input name="submit" type="submit" class="ui-corner-all" id="submit" value="LOGOUT" align="right">
 </form>
</span>

&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  
<div class="header2"></div>
</div>

<span class="header1">
<div id="navBar" align="center">
  <ul>
     <li><a href="admin home.php">HOME</a></li>
     <li><a href="stafflist.php">Staff List</a></li>
    <li><a href="studentlist.php">Student List</a></li>
      <li><a href="all marks.php">Marks Sheet</a></li>
     <li><a href="all attendance.php">Attendance Sheet</a></li>
     <li class="currentpage"><a href="admin settings.php">Profile</a></li>
  </ul>
</div></span><p>&nbsp;</p>

<h1 align="center" style="color: #333; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</h1>
<h1 align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Profile</strong></h1>
<p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</p>

<form method="POST" action="<?php echo $editFormAction; ?>" name="form" onSubmit="return checkForm(this);">
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;">&nbsp;Name </span>
   <input name="textfield" type="text" class="ui-corner-all" id="textfield" value="<?php echo $row_rs_adminEdit['name']; ?>">
   
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> Designation</span>
     <select name="select" class="ui-corner-all" id="select">
       <option>Head of the Department</option>
   </select>
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Department</span>
       <select name="select2" class="ui-corner-all" id="select2">
         <option>Computer Science and Engineering</option>
       </select>
       
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;">E-mail </span>
       <input name="email" type="email" class="ui-corner-all" id="email" value="<?php echo $row_rs_adminEdit['email']; ?>">
       
<p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">
   <label for="tel">Mobile</label>
  <input name="tel" type="tel" class="ui-corner-all" id="tel" value="<?php echo $row_rs_adminEdit['mobileno']; ?>">
  
<p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">  <p>&nbsp;&nbsp;&nbsp;</p>

 <p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">Change Password 

 <p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;Current Password
   <label for="password"></label>
   <input name="password1" type="password" class="ui-corner-all" id="password1">  

 <p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; New Password
   <input name="password2" type="password" class="ui-corner-all" id="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="
  this.setCustomValidity(this.validity.patternMismatch ?);
  if(this.checkValidity()) form.password3.pattern = this.value;
" title="Password must contain atleast 6 characters including uppercase [A-Z], lowercase [a-z] and numbers [0-9]">  
 
 <p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">Confirm Password
   <input name="password3" type="password" class="ui-corner-all" id="password3" title="Please enter the same Password as above" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="
  this.setCustomValidity(this.validity.patternMismatch ?);">
 
<p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"> 
<p align="center" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">
   <input name="submit" type="submit" class="ui-corner-all" id="submit" value="UPDATE">  
   <input type="hidden" name="MM_update" value="form">
</form>

<p>&nbsp;</p>
<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
</body>
</html>
<?php
mysql_free_result($rs_adminEdit);
?>
