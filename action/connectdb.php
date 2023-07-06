<?php
// Database configuration
$serverName = "KLEBERMETZGER\\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "SBDTSTMARKET",
    "Uid" => "sa",
    "PWD" => "C9p5au8naa@"
);

// Connect to SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>