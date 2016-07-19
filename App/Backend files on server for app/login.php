<?PHP
$username = $_POST['username'];
$pass = $_POST['password'];
$user_name = "u290199998_root";
$password = "mydatabase";
$database = "u290199998_db";
$server = "mysql.2freehosting.com";
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
$SQL = "SELECT * FROM student where studentID = '$username' and password = '$pass'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0) {

$message= "success";

}
else {

$message= "error";

}
print $message;
}
mysql_close($db_handle);


?>