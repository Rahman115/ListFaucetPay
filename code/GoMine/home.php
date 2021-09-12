<?php 
system('clear');
// set the default timezone to use.
date_default_timezone_set('UTC');

$timezone  = -4; //(GMT -4:00) waktu server
$end = gmdate("H:i:s", time() + 3600*($timezone+date("I"))); 
// echo gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I"))); 



$url = [
	'home' =>"https://gomine.xyz/user/home",
	'cl' => "https://gomine.xyz/inc/data.php"
];

$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
$cookie = "PHPSESSID=n43dki4t9g7nvd7c6i3nebdio2; _ga=GA1.2.688411866.1631402037; _gid=GA1.2.1057402092.1631402037; popcashpu=1; _data_html=158-1; _data_cpc=78-1; _gat_gtag_UA_171440311_1=1";

$u = [
'User-Agent: '.$user,
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Cookie: '.$cookie
];


function setData($u, $url) {
	$ch=curl_init();
  	curl_setopt_array($ch, array(
	    CURLOPT_URL => $url,
	    CURLOPT_RETURNTRANSFER => 1,
	    //CURLOPT_CUSTOMREQUEST => 'GET',
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_HTTPHEADER => $u,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    )
    );
    $result = curl_exec($ch);
    $info = curl_getinfo($ch);

    $b = explode('var sec = ', $result)[1];
    $bl = explode(';', $b)[0];


    $s = explode('sec = sec + ', $result)[1];
    $sec = explode(';', $s)[0];

    $us = explode('<h3>USER: ', $result)[1];
    $user = explode('<br>', $us)[0];
    // print_r(gettype($bl));
/**
 * 
var sec = 7.5095E-5;
	var a = setInterval(function () {
		sec = sec + 1.15E-8;
 **/
// TVjHnGtvJwksB3YxFeW7NGq3nhBqi7jZ9T<br>
    //<b style="font-weight: 600;">  
   // </b> Power: 5Kh/s | Earning:  0.00000012  TRX/sec | Daily: 0.010 TRX</b>  
   // <br> 


	$data = [
		'wl' => $user,
		'bl' => $bl,
		'sec' => $sec
    ];
    
	
    
    curl_close($ch);
    return $data;
}


function collect($u, $url) {
	$ch=curl_init();
  	curl_setopt_array($ch, array(
	    CURLOPT_URL => $url,
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_CUSTOMREQUEST => 'POST',
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_HTTPHEADER => $u,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    )
    );
    $result = curl_exec($ch);
    $info = curl_getinfo($ch);

    
    print_r($result);

        
    curl_close($ch);
    // return $data;
}
// POST -> colect
	// https://gomine.xyz/inc/data.php
// response  ----> 0.00035144


// $blc = "7.5095E-5";
// $str = sprintf("%d", $blc);
// var_dump($str);
while (true) {
	echo "[{$end}]";

	echo "\n";
	// code...
	$dt = setData($u, $url['home']);

	if($dt['bl'] > 0.0001){
		echo "Exe\n";
		collect($u, $url['cl']);
		sleep(3);
	} else { 
		print_r($dt);
	}
	for($i = 100; $i > -1; $i--){
		echo " \r";
		echo "[{$i}] Reload";
		sleep(1);
	}
	echo "\n";
}

echo "\n";
?>