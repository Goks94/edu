<?PHP
$username = "503";
$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$reg = $_POST['reg'];

$user_name = "u290199998_root";
$password = "mydatabase";
$database = "u290199998_db";
$server = "mysql.2freehosting.com";
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
$SQL = "INSERT INTO profile(username,name,dob,reg,email) VALUES('$username','$name','$dob','$reg','$email')";
$result = mysql_query($SQL);
//$num_rows = mysql_num_rows($result);
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