<?php

global $dbConfigs;

$dbConfigs['host'] = "localhost";
$dbConfigs['name'] = "alpharelaxation.fr";
$dbConfigs['user'] = "alpharelaxation";
$dbConfigs['pass'] = "LBQsPx8US9UJZGzs";

if(getenv("HTTP_HOST") == "localhost" || getenv("HTTP_HOST") == "127.0.0.1")
{
    $dbConfigs['host'] = "localhost";
    $dbConfigs['name'] = "alpharelaxation.fr";
    $dbConfigs['user'] = "root";
    $dbConfigs['pass'] = "";
}
?>