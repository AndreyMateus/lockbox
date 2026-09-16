<?php

$SGBD = "mysql";
$SERVER = 'localhost';
$PORT = 3306;
$DBNAME = 'yourdbname';
$USER = 'yourusername';
$PASSWORD = 'yourpassword';

$dsn = [
    'sgbd' => $SGBD,
    'dbname' => $DBNAME,
    'server' => $SERVER,
    'port' => $PORT,
    'user' => $USER,
    'password' => $PASSWORD
];

return  $dsn;
