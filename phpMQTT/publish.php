<?php

require './phpMQTT.php';

date_default_timezone_set("PRC");

$server = '127.0.0.1';    // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$client_id = 'phpMQTT-publisher'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);



if ($mqtt->connect(true, NULL, $username, $password)) {
	while (true) {
		$channel = mt_rand(1, 5);
		$mqtt->publish('vue/mqtt/test/' . $channel, date('[Y-m-d H:i:s]') . ' msg: ' . mt_rand(10000, 99999) , 0, false);
		usleep(mt_rand(100, 500) * 1000);
	}
	$mqtt->close();
} else {
    echo "Time out!\n";
}
