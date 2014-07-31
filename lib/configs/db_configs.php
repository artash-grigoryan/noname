<?php

global $dbConfigs;

$dbConfigs['host'] = "localhost";
$dbConfigs['name'] = "";
$dbConfigs['user'] = "";
$dbConfigs['pass'] = "";

if(getenv("HTTP_HOST") == "localhost" || getenv("HTTP_HOST") == "127.0.0.1")
{
    $dbConfigs['host'] = "localhost";
    $dbConfigs['name'] = "noname";
    $dbConfigs['user'] = "root";
    $dbConfigs['pass'] = "";
}
?>