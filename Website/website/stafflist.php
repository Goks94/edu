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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "teacher")) {
  $insertSQL = sprintf("INSERT INTO teacher (name) VALUES (%s)",
                       GetSQLValueString($_POST['Name'], "text"));

  mysql_select_db($database_con_db, $con_db);
  $Result1 = mysql_query($insertSQL, $con_db) or die(mysql_error());

  $insertGoTo = "stafflist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if(isset($_POST['remove'])) {
	$username = $_POST['username'];	
	$deleteSQL = "DELETE FROM teacher WHERE teacherID = $username";
	mysql_select_db($database_con_db, $con_db);
	$Result1 = mysql_query($deleteSQL, $con_db) or die(mysql_error());
	if ( mysql_affected_rows()!=0) {
    	 header(sprintf("Location: stafflist.php"));
	} else {
		echo '<script type="text/javascript"> alert("ERROR : Enter a valid username for teacher!"); </script>';
	}
}
?>

<?php
mysql_select_db($database_con_db, $con_db);
$query_rs_teacher = "SELECT * FROM teacher";
$rs_teacher = mysql_query($query_rs_teacher, $con_db) or die(mysql_error());
$row_rs_teacher = mysql_fetch_assoc($rs_teacher);
$totalRows_rs_teacher = mysql_num_rows($rs_teacher);
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
     <li  class="currentpage"><a href="stafflist.php">Staff List</a></li>
     <li><a href="studentlist.php">Student List</a></li>
   <li><a href="all marks.php">Marks Sheet</a></li>
     <li><a href="all attendance.php">Attendance Sheet</a></li>
    <li><a href="admin settings.php">Profile</a></li>
   </ul>
 </div>
</span>  

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<h1 align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Add Teacher</strong></h1>

<p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</p>

<form method="POST" action="<?php echo $editFormAction; ?>" name="teacher">
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> &nbsp;Name</span>	
    <input name="Name" type="text" required class="ui-corner-all" id="fullname">&nbsp; 
    <input name="submit2" type="submit" class="ui-corner-all" id="submit2" value="Add">
</p>
<input type="hidden" name="MM_insert" value="teacher">
</form>

<p>&nbsp;</p>

<?php
  if(($row_rs_teacher['name']) != NULL) {
  ?>

<table width="700" border="1" align="center">
    <tr>
      <th width="300" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Name</th>
      <th width="120" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Username</th>
      <th width="120" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Mobile</th>
      <th width="250" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">E-mail</th>
    </tr> 
    
    <?php do { ?>
    <tr>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_teacher['name']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_teacher['teacherID']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">
	  <?php
	  	if($row_rs_teacher['mobileno'] == NULL) {echo "NIL";} 
		else {echo $row_rs_teacher['mobileno'];}
	  ?>
      </td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">
	  <?php
	  	if($row_rs_teacher['email'] == NULL) {echo "NIL";} 
		else {echo $row_rs_teacher['email'];}
	  ?>
      </td>
    </tr>
  	<?php } while ($row_rs_teacher = mysql_fetch_assoc($rs_teacher)); ?>
  </table>     

<p>&nbsp;</p> 
<p>&nbsp;</p>
 
<form name="remove" method="POST" action="<?php echo $editFormAction; ?>">
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> &nbsp;Remove Teacher</span>	
    <input name="username" type="text" pattern="[0-9].{4,}" title="Username must be numeric with atleat 5 numbers." required class="ui-corner-all" id="username" placeholder="Enter Username">&nbsp;
    <input name="remove" type="submit" class="ui-corner-all" id="remove" value="Remove">
</p>
</form>
  
<?php } ?> 

<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
</body>
</html>
<?php
mysql_free_result($rs_teacher);
?>