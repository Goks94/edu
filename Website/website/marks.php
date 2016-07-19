<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  $user_check=$_SESSION['MM_Username'];
  $password_check=$_SESSION['MM_Password'];
}
if(MM_Username!=NULL){
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
}
?>
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
<?php require_once('Connections/con_db.php'); ?>

<?php
mysql_select_db($database_con_db, $con_db);
$query_rs_tutor = "SELECT tutor FROM teacher WHERE teacherID = '$user_check'";
$rs_tutor = mysql_query($query_rs_tutor, $con_db) or die(mysql_error());
$row_rs_tutor = mysql_fetch_assoc($rs_tutor);
$batch =  $row_rs_tutor['tutor'];
?>

<?php
mysql_select_db($database_con_db, $con_db);
$query_rs_mark = "SELECT * FROM mark";
$rs_mark = mysql_query($query_rs_mark, $con_db) or die(mysql_error());
$row_rs_mark = mysql_fetch_assoc($rs_mark);
$totalRows_rs_mark = mysql_num_rows($rs_mark);
?>

<?php
mysql_select_db($database_con_db, $con_db);
$query_rs_subject = "SELECT subcode FROM subject";
$rs_subject = mysql_query($query_rs_subject, $con_db) or die(mysql_error());
$row_rs_subject = mysql_fetch_assoc($rs_subject);
$totalRows_rs_subject = mysql_num_rows($rs_subject);
$storeArray = array();
do {
    $storeArray[] =  $row_rs_subject['subcode'];
} while ($row_rs_subject = mysql_fetch_assoc($rs_subject));
?>

<?php
	mysql_select_db($database_con_db, $con_db);
	$MM_redirectLoginSuccess = "marks.php";
	
	$class1 = $_POST['class1'];
	if(isset($_POST['remove'])) {
	  $sql=mysql_query("DELETE FROM mark WHERE class='$class1'");
	}
    
	$class = $_POST['class'];
    if(isset($_POST['submit']) && ($_FILES['file']['tmp_name']) != NULL)
	 {
  	  $file=$_FILES['file']['tmp_name'];
	  $handle = fopen($file,"r");
	  $i=0;
      while(($fileop = fgetcsv($handle,1000,",")) !== false)
      {
       if($i>1)
	   {   
        $reg = $fileop[1];
	    $sub1 = $fileop[4];
		$sub2 = $fileop[6];
		$sub3 = $fileop[8];
		$sub4 = $fileop[10];
		$sub5 = $fileop[12];
		$sub6 = $fileop[14];
		$sub7 = $fileop[16];
		$sub8 = $fileop[18];
		$total = $fileop[19];

		$sql = mysql_query("INSERT INTO mark(batch, class, reg, sub1, sub2, sub3, sub4, sub5, sub6, sub7, sub8, total) VALUES ('$batch', '$class', '$reg', '$sub1', '$sub2', '$sub3', '$sub4', '$sub5', '$sub6', '$sub7', '$sub8', '$total')");
       }
       $i++;
      }
	  if($sql)
	  {
	   header("Location: " . $MM_redirectLoginSuccess );
      } 
	 }
	else if(isset($_POST['submit']) && ($_FILES['file']['tmp_name']) == NULL) {
		echo "<script>alert('Please select a file to upload.');</script>";
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edu</title>
<link rel="shortcut icon" href="edu_icon.ico" type="image/ico" />
<link href="jQueryAssets/jquery.ui.theme1.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
.header1 {
	position: absolute;
	left: 10px;
	top: 29px;
	width: 1235px;
}
.header2 {
	position: absolute;
	left: 1246px;
	top: 20px;
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
     <li><a href="teacher home.php">HOME</a></li>
     <li><a href="namelist.php">Student List</a></li>
     <li class="currentpage"><a href="marks.php">Marks Sheet</a></li>
     <li><a href="attendance.php">Attendance Sheet</a></li>
     <li><a href="settings.php">Profile</a></li>
   </ul>
</div>
</span><p>&nbsp;</p>  

<p>&nbsp;</p>
<p>&nbsp;</p>

<h1 align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Upload Internals</strong></h1>

<p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</p>

<form method="post" action="marks.php" enctype="multipart/form-data">

<p align="center">
<span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Select Marksheet &nbsp;</strong></span>

  <input align="middle" name="file" type="file" autofocus class="ui-widget-overlay" id="file">
    &nbsp; 
    
    <input type="text" required id="class" name="class" class="ui-corner-all" placeholder="Enter Class">&nbsp;&nbsp;&nbsp;
    
    <input name="submit" type="submit" class="ui-corner-all" id="submit" value="Upload">
</p>
</form>

<p>&nbsp;</p>

<?php
  if(($row_rs_mark['sub1']) != NULL) {
  ?>

  <table width="550" border="1" align="center">
    <tr>
      <th width="150" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Reg. No</th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[0]); ?> </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[1]); ?>  </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[2]); ?>  </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[3]); ?>    </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[4]); ?>    </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[5]); ?>    </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[6]); ?>    </th>
      <th width="50" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[7]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Total</th>
    </tr> 
    
    <?php do { ?>
    <tr>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['reg']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub1']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub2']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub3']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub4']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub5']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub6']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub7']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['sub8']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_mark['total']; ?></td>
    </tr>
  	<?php } while ($row_rs_mark = mysql_fetch_assoc($rs_mark)); ?>
  </table>  
  
<form name="remove" method="POST" action="marks.php">
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> &nbsp;Remove Mark Sheet</span>	
    <input name="class1" type="text" required class="ui-corner-all" id="class1" placeholder="Enter Class">&nbsp;
    <input name="remove" type="submit" class="ui-corner-all" id="remove" value="Remove">
</p>
</form>  
<?php } ?> 


<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
</body>
</html>
<?php
mysql_free_result($rs_mark);
?>

