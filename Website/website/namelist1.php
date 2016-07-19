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

mysql_select_db($database_con_db, $con_db);
$query_rs_namelist = "SELECT * FROM student";
$rs_namelist = mysql_query($query_rs_namelist, $con_db) or die(mysql_error());
$row_rs_namelist = mysql_fetch_assoc($rs_namelist);
$totalRows_rs_namelist = mysql_num_rows($rs_namelist);
?>

<?php
    $conn = mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("db",$conn);
	
	$MM_redirectLoginSuccess = "namelist1.php";
    
   if(isset($_POST['submit']))
	 {
  	  $file=$_FILES['file']['tmp_name'];
	  $handle = fopen($file,"r");
	  $i=0;
      while(($fileop = fgetcsv($handle,1000,",")) !== false)
      {
       if($i>0)
	   {
        $rollno = $fileop[0];
	    $name = $fileop[1];

	    $sql = mysql_query("INSERT INTO student(rollno, name) VALUES ('$rollno', '$name')");
       }
       $i++;
      }
	  if($sql)
	  {
	   header("Location: " . $MM_redirectLoginSuccess );
      } 
	 }

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
	top: 10px;
	width: 1332px;
}
.header2 {
	position: absolute;
	left: 1247px;
	top: 15px;
}
.line {
	color: #999;
}
</style>
</head>

<body background="images/background.jpg">
<p>  
<div class="header1"><img src="images/edu logo.png" width="50" height="50"  alt=""/>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

<span class="header2">
<input name="LOGOUT" type="button" class="ui-corner-all" id="LOGOUT" value="LOGOUT" align="right">
</span>

&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
<div class="header2"></div>
</div>
<div id="navBar" align="center">
   <ul>
     <li><a href="teacher home.php">HOME</a></li>
     <li class="currentpage"><a href="namelist1.php">Student List</a></li>
     <li><a href="marks.php">Marks Sheet</a></li>
     <li><a href="attendance.php">Attendance Sheet</a></li>
     <li><a href="settings.php">Profile</a></li>
   </ul>
 </div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<h1 align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Upload Student Namelist</strong></h1>

<p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</p>

<form method="post" action="namelist.php" enctype="multipart/form-data">

<p align="center"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Select Namelist    &nbsp;  </strong></span>

  <input align="middle" name="file" type="file" autofocus class="ui-widget-overlay" id="file">
    &nbsp; 
    <input name="submit" type="submit" class="ui-corner-all" id="submit" value="Upload">
</p>
</form>

<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
  if(($row_rs_namelist['rollno']) != NULL) {
  ?>

  <table align="center" width="683">
    <tr>
      <th width="184" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center;" scope="col">Roll Number</th>
      <th width="157" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: left;" scope="col">Name</th>
      <th width="157" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: left;" scope="col">Username</th>
      <th width="157" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: left;" scope="col">Password</th>
    </tr> 
    
    <?php do { ?>
    <tr>
      <td style="color: #FFF; text-align: center; font-size: larger; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['rollno']; ?></td>
      <td style="color: #FFF; text-align: left; font-size: larger; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['name']; ?></td>
      <td style="color: #FFF; text-align: left; font-size: larger; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['studentID']; ?></td>
      <td style="color: #FFF; text-align: left; font-size: larger; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['password']; ?></td>
    </tr>
  	<?php } while ($row_rs_namelist = mysql_fetch_assoc($rs_namelist)); ?>
  </table>  
  
<?php } ?>  
  
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p align="center" class="line"></p>
<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>

</body>
</html>
<?php
mysql_free_result($rs_namelist);
?>
