<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db_connection = "localhost";
$database_db_connection = "balaka";
$username_db_connection = "root";
$password_db_connection = "";
$db_connection = mysql_pconnect($hostname_db_connection, $username_db_connection, $password_db_connection) or trigger_error(mysql_error(),E_USER_ERROR); 
?>

