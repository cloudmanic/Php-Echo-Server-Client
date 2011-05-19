<?php
//
// By: Spicer Matthews <spicer@cloudmanic.com>
// Company: Cloudmanic Labs, LLC
// Date: 5/19/2011
// Description: This is an echo server. It will read any messages sent in and then echo them back out.
//
$hostname = "127.0.0.1";
$portno = "7834";
ob_implicit_flush();
set_time_limit(0);

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Socket create
error\n");

socket_bind($sock, $hostname, $portno) or die("Socket bind error\n");
socket_listen($sock, 3) or die("Could not set up socket listener\n");

while(1)
{
	echo "socket connection started\n";
	
	$accept = socket_accept($sock) or die("Could not accept incoming
	connection\n");
	
	while($recv = socket_read($accept, 24000))
	{
		echo 'Client Said: ' . $recv;
		$msg = 'Server Said: ' . $recv . "\r\n";
		socket_write($accept, $msg, strlen($msg)) or die("Could not write output\n");
	}

	socket_close($accept);
	
	echo "socket connection done\n";
}

socket_close($sock);
?>