<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_rem = "mssql.tlamatiliztli.mx";
$database_rem = "tlamatil_4mat_beta";
$username_rem = "tlama_4mat2";
$password_rem = "#4Math$.";
$rem = mysql_pconnect($hostname_rem, $username_rem, $password_rem) or trigger_error(mysql_error(),E_USER_ERROR); 
?>