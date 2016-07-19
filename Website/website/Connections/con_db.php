<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_con_db = "localhost";
$database_con_db = "db";
$username_con_db = "root";
$password_con_db = "";
$con_db = mysql_pconnect($hostname_con_db, $username_con_db, $password_con_db) or trigger_error(mysql_error(),E_USER_ERROR); 
?>