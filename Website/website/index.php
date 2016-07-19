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
?>

<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['textfield'])) {
  $loginUsername=$_POST['textfield'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "email";
  
  $selected_radio = $_POST['login'];
  if ($selected_radio == 'admin') {
  	$MM_redirectLoginSuccess = "admin form.php";
  	$MM_redirectLoginFailed = "index1.php";
  	$MM_redirecttoReferrer = false;
  	mysql_select_db($database_con_db, $con_db);
  
  	$LoginRS__query=sprintf("SELECT adminID, password, email FROM `admin` WHERE adminID=%s AND password=%s",
    	GetSQLValueString($loginUsername, "int"), GetSQLValueString($password, "text")); 
  }
  else if($selected_radio == 'teacher') {
  	$MM_redirectLoginSuccess = "teacher form.php";
  	$MM_redirectLoginFailed = "index1.php";
  	$MM_redirecttoReferrer = false;
  	mysql_select_db($database_con_db, $con_db);
  
  	$LoginRS__query=sprintf("SELECT teacherID, password, email FROM `teacher` WHERE teacherID=%s AND password=%s",
    GetSQLValueString($loginUsername, "int"), GetSQLValueString($password, "text")); 
  }
  $LoginRS = mysql_query($LoginRS__query, $con_db) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
	$loginStrGroup = mysql_result($LoginRS,0,'email');
	
	if( $loginStrGroup != NULL){
		$selected_radio = $_POST['login'];
  		if ($selected_radio == 'admin') {
			$MM_redirectLoginSuccess = "admin home.php";
			header("Location: " . $MM_redirectLoginSuccess );
		}
		else if($selected_radio == 'teacher') {
			$MM_redirectLoginSuccess = "teacher home.php";
			header("Location: " . $MM_redirectLoginSuccess );
		}
	}
	
	if (PHP_VERSION >= 5.1) {
		session_regenerate_id(true);
	} 
	else {
		session_regenerate_id();
	}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
	$_SESSION['MM_Password'] = $password;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
       
    if (isset($_SESSION['PrevUrl']) && false) {
   		$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edu</title>
<link rel="shortcut icon" href="edu_icon.ico" type="image/ico" />
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<style type="text/css">
.footer {
	position: absolute;
	left: -2px;
	top: 805px;
	width: 1738px;
} 
body {
	background-size: cover;
}
</style>
</head>

<body background="images/background.jpg">

<form ACTION="<?php echo $loginFormAction; ?>" name="login" method="POST">
  <div align="center">
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  <p><img src="images/edu logo.png" width="100" height="100"  alt=""/></p>
  
  <p><span style="color: #CCC">________________________________</span></p>
  
  <p>
    <label>
    <input <?php if (!(strcmp("teacher","teacher"))) {echo "checked=\"checked\"";} ?> type="radio" name="login" value="teacher" id="login_0">
    <span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #D6C6C4"><strong>Teacher</strong>&nbsp; &nbsp; &nbsp; </span>
    </label>
     
    <label style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif">
    <input <?php if (!(strcmp("teacher","admin"))) {echo "checked=\"checked\"";} ?> type="radio" name="login" value="admin" id="login_1">
    <strong><span style="color: #D6C6C4">Admin</span></strong> 
    </label>
  </p>
  
  <p><span style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-style: normal;"><strong>Username </strong></span>
    <input name="textfield" type="text" class="ui-corner-all" id="textfield">
  </p>
  
  <p>
    <label for="password" style="color: #FFF; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Password&nbsp; </strong></label>
    <input name="password" type="password" class="ui-corner-all" id="password">
  </p>
  
  <p>
    <span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif"></span>
    <input name="submit" type="submit" class="ui-corner-all" id="submit" value="LOGIN">
  </p>

  </div>
</form>
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  <p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
 
</body>
</html>