<?php
$serverName = "DESKTOP-ECD32L4"; // Replace with your SQL Server name
$connectionOptions = [
    "Database" => "RentEaseDB", // Replace with your database name
    // No need for Uid and PWD for Windows Authentication
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
echo "Connection successful!";
?>