<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_con_sample = "localhost";
$database_con_sample = "sample";
$username_con_sample = "root";
$password_con_sample = "";
$con_sample = mysql_pconnect($hostname_con_sample, $username_con_sample, $password_con_sample) or trigger_error(mysql_error(),E_USER_ERROR); 
?>