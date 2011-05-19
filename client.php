<?php
//
// By: Spicer Matthews <spicer@cloudmanic.com>
// Company: Cloudmanic Labs, LLC
// Date: 5/19/2011
// Description: This is a client to the echo server. It will send 10 test commands, and echo the server response.
//							Run it from the command line "php client.php".
//
set_time_limit(0); 
$address = '127.0.0.1';
$port = '7834';

$fp = fsockopen($address, $port, $errno, $errstr, 300);
if(! $fp) 
{
  echo "$errstr ($errno)\n";
} 
else 
{	
  // Send 10 test message to the server
  for($i=0; $i<= 10; $i++)
  {
  	// Send message to server
  	$out = "Test #$i\r\n";
  	fwrite($fp, $out);
  	
  	// Read the response from the server
  	$str = fread($fp, 100000);
  	echo $str;
  	
  	sleep(5);
  }
  
  fclose($fp);
}
?>