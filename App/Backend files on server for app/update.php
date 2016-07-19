<?PHP
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$reg = $_POST['reg'];
$mobile = $_POST['mobile'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$post = $_POST['post'];
$pin = $_POST['pin'];
$district = $_POST['district'];
$state = $_POST['state'];
$pass = $_POST['pass'];

$user_name = "u290199998_root";
$password = "mydatabase";
$database = "u290199998_db";
$server = "mysql.2freehosting.com";

mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
	
	$SQL = "UPDATE student SET name='$name', reg='$reg', email='$email', password='$pass', mobile='$mobile', address1='$address1', address2='$address2', po='$post', district='$district', state='$state', pin='$pin', dob='$dob' WHERE studentID='$username' ";
	

$result = mysql_query($SQL);

if ($result) {

$message= "success";

}
else {

$message= "error";

}
print $message;
}
mysql_close($db_handle);

?>