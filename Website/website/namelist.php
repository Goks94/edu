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
$query_rs_namelist = "SELECT * FROM student WHERE batch='$batch'";
$rs_namelist = mysql_query($query_rs_namelist, $con_db) or die(mysql_error());
$row_rs_namelist = mysql_fetch_assoc($rs_namelist);
$totalRows_rs_namelist = mysql_num_rows($rs_namelist);
?>

<?php
mysql_select_db($database_con_db, $con_db);
$query_rs_class = "SELECT class FROM student WHERE batch = '$batch'";
$rs_class = mysql_query($query_rs_class, $con_db) or die(mysql_error());
$row_rs_class = mysql_fetch_assoc($rs_class);
$class1 =  $row_rs_class['class'];
?>

<?php
	mysql_select_db($database_con_db, $con_db);
	$MM_redirectLoginSuccess = "namelist.php";
	
	$batch1 = $_POST['batch1'];
	if( (isset($_POST['remove'])) && ($batch == $batch1) ) {
	  $sql=mysql_query("DELETE FROM student WHERE batch='$batch1'");
	}
	else if( (isset($_POST['remove'])) && ($batch != $batch1) ) { 
	  echo "<script>alert('Please enter a batch that you are in-charge.');</script>";
	}
    
    if(isset($_POST['submit']) && ($_FILES['file']['tmp_name']) && $batch != NULL)
	 {
  	  $file=$_FILES['file']['tmp_name'];
	  $handle = fopen($file,"r");
	  $i=0;
      while(($fileop = fgetcsv($handle,1000,",")) !== false)
      {
       if($i>=0)
	   {
        $rollno = $fileop[0];
	    $name = $fileop[1];
	    $sql = mysql_query("INSERT INTO student(rollno, name, batch) VALUES ('$rollno', '$name', '$batch')");
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
    else if(isset($_POST['submit']) && ($_FILES['file']['tmp_name']) && $batch == NULL) {
		echo "<script>alert('ERROR : You are not an authorised user to upload.');</script>";
	}
	
	$class = $_POST['class'];
	if( (isset($_POST['update'])) )  {
		$sql=mysql_query("UPDATE `student` SET class='$class' WHERE batch='$batch'"); 
		if($sql) {echo "done";}
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
.line {
	color: #999;
}
.colour {
	color: #FFF;
	text-align: left;
	font-weight: normal;
	font-size: xx-large;
	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
}
.gg {
	color: #FFF;
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
     <li class="currentpage"><a href="namelist.php">Student List</a></li>
     <li><a href="marks.php">Marks Sheet</a></li>
     <li><a href="attendance.php">Attendance Sheet</a></li>
     <li><a href="settings.php">Profile</a></li>
   </ul>
</div></span><p>&nbsp;</p>

<p>&nbsp;</p>
<p>&nbsp;</p>

<h1 align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><strong>Upload Student Namelist</strong></h1>

<p align="center" style="color: #CCC; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&nbsp;</p>

<form method="POST" action="namelist.php" enctype="multipart/form-data">

<p align="center"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Select Namelist &nbsp;</strong></span>

  <input align="middle" name="file" type="file" autofocus class="ui-widget-overlay" id="file">
    &nbsp; 
    <input name="submit" type="submit" class="ui-corner-all" id="submit" value="Upload">
</p>

</form>

<p>&nbsp;</p>

<?php
  if(($row_rs_namelist['rollno']) && ($row_rs_tutor['tutor']) != NULL) {
  ?>

<form name="set" method="POST" action="namelist.php">
<table width="333" border="0" align="center">
    <tr>
      <th width="229">
      <p align="center"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"><strong>Class &nbsp;</strong></span> 
      <input type="text" required id="class" name="class" class="ui-corner-all">
      </th>
   
      <th width="94" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">
      <input type="submit" name="update" id="update" class="ui-corner-all" value="Update">
      </th>
    </tr>
</table>
</form>
  
  <p>&nbsp;</p>

  <table width="500" border="0" align="center">
    <tr>
      <th width="150" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Batch  <?php echo $batch; ?></th>
   
      <th width="150" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Class  <?php echo $class1; ?></th>
    </tr>
  </table>

  <table width="700" border="1" align="center">
    <tr>
      <th width="80" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Roll No.</th>
      <th width="240" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: left; font-size: 18px;" scope="col">Name</th>
      <th width="183" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Username</th>
      <th width="181" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #CCC; text-align: center; font-size: 18px;" scope="col">Password</th>
    </tr> 
    
    <?php do { ?>
    <tr>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['rollno']; ?></td>
      <td style="color: #FFF; text-align: left; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['name']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['studentID']; ?></td>
      <td style="color: #FFF; text-align: center; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;"><?php echo $row_rs_namelist['password']; ?></td>
    </tr>
  	<?php } while ($row_rs_namelist = mysql_fetch_assoc($rs_namelist)); ?>
  </table>  
 

<form name="remove" method="POST" action="namelist.php">
<p align="center" style="color: #999"><span style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; color: #FFF;"> &nbsp;Remove Namelist</span>	
    <input name="batch1" type="text" required class="ui-corner-all" id="batch1" placeholder="Enter Batch">&nbsp;
    <input name="remove" type="submit" class="ui-corner-all" id="remove" value="Remove">
</p>
</form>  
<?php } ?>  


<p align="center" class="line"></p>
<p align="center"><span style="color: #000; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">&copy;edu <span style="font-size: x-small">2014-2015</span></span></p>
</body>
</html>
<?php
mysql_free_result($rs_namelist);
?>
