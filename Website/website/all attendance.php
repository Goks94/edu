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
$class = $_POST['class'];
$batch = $_POST['batch'];
mysql_select_db($database_con_db, $con_db);
$query_rs_attendance = "SELECT * FROM attendance WHERE batch='$batch' AND class='$class'";
$rs_attendance = mysql_query($query_rs_attendance, $con_db) or die(mysql_error());
$row_rs_attendance = mysql_fetch_assoc($rs_attendance);
$totalRows_rs_attendance = mysql_num_rows($rs_attendance);
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
     <li><a href="stafflist.php">Staff List</a></li>
     <li><a href="studentlist.php">Student List</a></li>
     <li><a href="all marks.php">Marks Sheet</a></li>
     <li class="currentpage"><a href="all attendance.php">Attendance Sheet</a></li>
     <li><a href="admin settings.php">Profile</a></li>
 </ul>
</div>
</span><p>&nbsp;</p>

<p>&nbsp;</p>
<p>&nbsp;</p>

<form method="post" action="all attendance.php">
<p align="center"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Class </strong></span>

<select name="class" class="ui-corner-all" id="class">
  <option>S4CSE</option>
  <option>S5CSE</option>
  <option>S6CSE</option>
  <option>S7CSE</option>
  <option>S8CSE</option>
</select>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
<span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Batch </strong></span>

<select name="batch" class="ui-corner-all" id="batch">
  <option>2012-16</option>
  <option>2013-17</option>
  <option>2014-18</option>
  <option>2015-19</option>
  <option>2016-20</option>
</select>

&nbsp;&nbsp; 
<input type="submit" class="ui-corner-all" id="submit" value="Display">
</form>

<p>&nbsp;</p>

<?php
  if(($row_rs_attendance['rollno']) != NULL) {
  ?>

  <table width="900" border="1" align="center">
    <tr>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Roll No</th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[0]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[1]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[1]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[2]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[3]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[4]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[5]); ?>    </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[6]); ?>   </th>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col"><?php print_r($storeArray[7]); ?>    </th>
      <th width="100" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Total</th>
    
    <?php do { ?>
    <tr>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['rollno']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub1']; ?>/<?php echo $row_rs_attendance['tot1']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub2']; ?>/<?php echo $row_rs_attendance['tot2']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub3']; ?>/<?php echo $row_rs_attendance['tot3']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub4']; ?>/<?php echo $row_rs_attendance['tot4']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub5']; ?>/<?php echo $row_rs_attendance['tot5']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub6']; ?>/<?php echo $row_rs_attendance['tot6']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub7']; ?>/<?php echo $row_rs_attendance['tot7']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub8']; ?>/<?php echo $row_rs_attendance['tot8']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['sub9']; ?>/<?php echo $row_rs_attendance['tot9']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_attendance['total1']; ?>/<?php echo $row_rs_attendance['total2']; ?></td>
    </tr>
  	<?php } while ($row_rs_attendance = mysql_fetch_assoc($rs_attendance)); ?>
  </table>  	 
  
<?php } ?> 
</form>

<p>&nbsp;</p><p>&nbsp;</p>
<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
</body>
</html>
<?php
mysql_free_result($rs_attendance);
?>