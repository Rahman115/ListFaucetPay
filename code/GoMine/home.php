<?php 
include 'pay.php';
system('clear');

// echo $a;
// print_r($dtPay);


$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
$cookie = "PHPSESSID=dga4o5jbl5hqbe0b7fs8h7ngs5; __.popunder=1; _ga=GA1.2.1385783993.1631486376; _gid=GA1.2.1011802658.1631486376; _data_cpc=78-5_229-5; popcashpu=1; _data_pop=234-1; _data_html=158-1";

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

    curl_close($ch);
    return $result;
}


function getTime() {
	// set the default timezone to use.
	date_default_timezone_set('UTC');

	$timezone  = -4; //(GMT -4:00) waktu server
	$end = gmdate("H:i:s", time() + 3600*($timezone+date("I"))); 
	// echo gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I"))); 

	return "[{$end}]";
}

function out($tm, $text, $sl){
	echo $tm." ";
	echo $text."\n";
	sleep($sl);
}

// POST -> colect
	// https://gomine.xyz/inc/data.php
// response  ----> 0.00035144


// $blc = "7.5095E-5";
// $str = sprintf("%d", $blc);
// var_dump($str);
echo "\n";
$n = 0;
while (true) {
	$set = setPay($u, $url);
	$dtPay = getData($set);

	$n++;
	// code...
	$dt = setData($u, $url['home']);
	out(getTime(), "[{$n}] Refresh...", 1);

	
	if($dtPay['var'] > 0.0005) { 
		out(getTime(), "Walet   {$dtPay['balance']} TRX", 1);
		out(getTime(), "Get Withdrawl {$count_wd} TRX", 1);
		$ms = wd($u, $url);
		out(getTime(), "{$ms}", 10);
	} else {
		out(getTime(), "Walet   {$dtPay['balance']} TRX", 1);
	}
	echo getTime();
	echo " Miners +";
	echo rtrim(sprintf('%.10f',floatval($dt['bl'])),'0');
	echo " TRX \n"; sleep(1);
	out(getTime(), "Cek Saldo", 2);
	if($dt['bl'] > 0.0001){
		out(getTime(), "Menyimpan saldo ke walet", 2);
		$col = collect($u, $url['cl']);
		out(getTime(), "Berhasil menyimpan {$col} TRX", 5);
		out(getTime(), "Reload system...", 5);
		system('clear');
	} else { 
		out(getTime(), "+--Saldo belum cukup.", 2);
		$v = floatval($dt['bl']);
		$pl = floatval($dt['sec']);
		$pls = $v;

		$second = 180;
		$menit = $second / 60;
		out(getTime(), "+--Mining {$menit} menit", 1);

		for($i = $second; $i > -1; $i--){
		
			$pls = $pls + $pl;
			$range = $i % 6;

			$per = ($second - $i) * 100 / $second;
			$pc = floor($per);
			// if($range == 0) { 
				echo " \r";
				echo getTime()." ";
				echo "[{$pc}%] Mine +";
				echo rtrim(sprintf('%.10f',floatval($pls)),'0'); 
				echo " TRX";
				echo "   \r";

				// }
			sleep(1);
		}
		echo "\n";
		out(getTime(), "Next reload...", 5);
	}
	
}

echo "\n";
?>