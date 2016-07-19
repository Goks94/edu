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
$query_rs_attendance = "SELECT * FROM attendance";
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

<?php
	mysql_select_db($database_con_db, $con_db);
	$MM_redirectLoginSuccess = "attendance.php";
	
	$class1 = $_POST['class1'];
	if(isset($_POST['remove'])) {
	  $sql=mysql_query("DELETE FROM attendance WHERE class='$class1'");
	}
    
	$class = $_POST['class'];
    if(isset($_POST['submit']) && ($_FILES['file']['tmp_name']) != NULL)
	 {
  	  $file=$_FILES['file']['tmp_name'];
	  $handle = fopen($file,"r");
	  $i=0;
	  
      while(($fileop = fgetcsv($handle,1000,",")) !== false)
      {
		if($i==3)
		{
		  $tot1=$fileop[2];
		  $tot2=$fileop[3];
		  $tot3=$fileop[4];
		  $tot4=$fileop[5];
		  $tot5=$fileop[6];
		  $tot6=$fileop[7];
		  $tot7=$fileop[8];
		  $tot8=$fileop[9];
		  $tot9=$fileop[10];		  
		}
       if($i>4)
	   {
        $rollno = $fileop[0];
	    $sub1 = $tot1-$fileop[2];
		$sub2 = $tot2-$fileop[3];
		$sub3 = $tot3-$fileop[4];
		$sub4 = $tot4-$fileop[5];
		$sub5 = $tot5-$fileop[6];
		$sub6 = $tot6-$fileop[7];
		$sub7 = $tot7-$fileop[8];
		$sub8 = $tot8-$fileop[9];
		$sub9 = $tot9-$fileop[10];
		$total1 =$sub1+$sub2+$sub3+$sub4+$sub5+$sub6+$sub7+$sub8+$sub9; 
		$total2 =$tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9;
		
	 	$sql = mysql_query("INSERT INTO attendance(batch, class, rollno, sub1,tot1, sub2,tot2, sub3,tot3, sub4,tot4, sub5,tot5, sub6,tot6, 		sub7,tot7, sub8,tot8, sub9,tot9,total1,total2) VALUES ('$batch', '$class', '$rollno', '$sub1','$tot1','$sub2','$tot2', '$sub3','$tot3','$sub4','$tot4', '$sub5','$tot5', '$sub6','$tot6', '$sub7','$tot7', '$sub8','$tot8', '$sub9','$tot9','$total1','$total2')");
     
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
     <li><a href="marks.php">Marks Sheet</a></li>
     <li class="currentpage"><a href="attendance.php">Attendance Sheet</a></li>
     <li><a href="settings.php">Profile</a></li>
   </ul>
</div>
</span><p>&nbsp;</p>

<p>&nbsp;</p>
<p>&nbsp;</p>

<h1 align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Upload Attendance</strong></h1>

<p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</p>

<form method="post" action="attendance.php" enctype="multipart/form-data">

<p align="center"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Select Attendance Sheet &nbsp;</strong></span>

  <input align="middle" name="file" type="file" autofocus class="ui-widget-overlay" id="file">
    &nbsp; 
    
    <input type="text" required id="class" name="class" class="ui-corner-all" placeholder="Enter Class">&nbsp;&nbsp;&nbsp;
    
    <input name="submit" type="submit" class="ui-corner-all" id="submit" value="Upload">
</p>
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
	 
<form name="remove" method="POST" action="attendance.php">
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> &nbsp;Remove Attendance Sheet</span>	
    <input name="class1" type="text" required class="ui-corner-all" id="class1" placeholder="Enter Class">&nbsp;
    <input name="remove" type="submit" class="ui-corner-all" id="remove" value="Remove">
</p>
</form>  
<?php } ?> 


<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
</body>
</html>
<?php
mysql_free_result($rs_attendance);
?>

