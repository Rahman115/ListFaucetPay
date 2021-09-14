<?php
system('clear');

$user = "";
$cookie = "";

$count_wd = "0.0005";

$url = [
	'uri' => "https://gomine.xyz/user/pay",
	'data' => "amount={$count_wd}&fpay=",
	'home' =>"https://gomine.xyz/user/home",
	'cl' => "https://gomine.xyz/inc/data.php",
	'urlc' => "https://gomine.xyz/user/ptc",
	'ptc' => "https://skippyads.com/?page=wall&p=iriyFwfnGmx&u=8692",
	'get' => "http://skippyads.com/?page=click&p=iriyFwfnGmx&i=329&u=8692",
	'verify' => "http://skippyads.com/?page=verify&p=iriyFwfnGmx&i=328&u=8692&t=ac02a50fd8293df96cdca0901e4f16af"
];



// PC
// $user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
// $cookie = "PHPSESSID=22rg7jc8kvm54b11u7kqq123a0; _ga=GA1.2.1166790665.1631564548; _gid=GA1.2.1985558678.1631564548; popcashpu=1; _data_cpc=32-1_78-3; _gat_gtag_UA_171440311_1=1; __.popunder=1";

$u = [
'User-Agent: '.$user,
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Cookie: '.$cookie
];

function setPay($u, $url){

	$ch=curl_init();
  	curl_setopt_array($ch, array(
	    CURLOPT_URL => $url['uri'],
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_HTTPHEADER => $u,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    )
    );
    $result = curl_exec($ch);
    $http = curl_getinfo($ch);

    if($http['http_code'] == 200) {
    	$res = $result;
    } else {
    	$res = null;
    }

    // print_r($http);

    curl_close($ch);
    return $res;
}

function getData($result) {
	$blc = explode('<h2 class="text-center"><span> ', $result)[1];
	$balance = explode('   </span> <strong>', $blc)[0];
    $data = array();
    $tblData = array();

    // var_dump($balance);

    $tb = explode('<tr><td>', $result);
	// $balance = explode('   </span> <strong>', $blc)[0];

	for($i = 1; $i < count($tb); $i++) {
		$num = $i - 1;
		$tbl[$num] = explode('</b></td></tr>', $tb[$i])[0];
		$tblData[$num] = explode('</td><td>', $tbl[$num]);

		$tblData[$num][4] = explode('<b style="color:green;">', $tblData[$num][4])[1];
		// echo "\n[{$i}] >\n";
		// print_r($tblData[$num]);

	}

	$var = doubleval($balance);
	$data = [
		'coin' => "TRX",
		'var' => $var,
		'balance' => $balance,
		'table' => $tblData
	];

	return $data;
}


function showData($data){
	echo "\n";
	echo "Balance [ {$data['balance']} {$data['coin']} ]\n";
	echo "Walet   [ {$data['table'][0][2]} ]\n";
	echo "\n";
	echo "   ID  |    DATE    | WITHDRAW | Status \n";
	for($i = 0; $i < count($data['table']); $i++) {
		echo " {$data['table'][$i][0]} | {$data['table'][$i][1]} |{$data['table'][$i][3]}|  {$data['table'][$i][4]}\n";
	}
}

function wd($u, $url) {
	$ch=curl_init();
  	curl_setopt_array($ch, array(
	    CURLOPT_URL => $url['uri'],
	    CURLOPT_RETURNTRANSFER => 1,
	    // CURLOPT_CUSTOMREQUEST => $url['act'],
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $url['data'],
	    CURLOPT_HTTPHEADER => $u,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    )
    );
    $result = curl_exec($ch);
    $info = curl_getinfo($ch);

    $mesage = "";
    if($info['http_code'] == 200) {
    	$msg = explode("<h4 style='color:green'>", $result)[1];
    	$mesage = explode('</h4><!-- Bittraffic', $msg)[0];
    }

        
    curl_close($ch);
    return $mesage;
}

function closing($dt, $t1, $u, $url){
	if($t1[0] == 23 && $t1[1] == 42) {
		out(getTime(), "Menunggu waktu closing . . .", 1);
			for($i = 960; $i > -1; $i--){
			//$pls = $pls + $pl;
			$range = $i % 3;
		$per = (960 - $i) * 100 / 960;
		$pc = floor($per);
		
		echo " \r";
		echo getTime()." ";
		echo "\033[0;31m[\033[0;33m{$pc}%\033[0;31m]\033[0;37m Closing";
		if($range == 0) {
			echo ".";
		} else if($range == 1){
			echo "..";
		} else {
			echo "...";
		}
		
		echo "   \r";
		
		sleep(1);
		} // end for

		if($dt['bl'] > 0.0001){
			out(getTime(), "Mine penuh...", 2);
			out(getTime(), "Pindahkan Mine --> walet", 1);
			for($i = 10; $i > -1; $i--){
				echo " \r";
				echo getTime();
				echo " [{$i}] Memindahkan..!";
				echo " \r";
				sleep(1);
			}
			echo "\n";
			out(getTime(), "Selesai...", 1);
			$col = collect($u, $url['cl']);
			out(getTime(), "Berhasil memindahkan {$col}\033[1;31m TRX", 5);
			out(getTime(), "Closing system...", 120);
			// system('clear');
		}
	} 
	if($t1[0] == 23 && $t1[1] == 43) {
		out(getTime(), "Menunggu waktu closing . . .", 1);
			for($i = 900; $i > -1; $i--){
			//$pls = $pls + $pl;
			$range = $i % 3;
		$per = (900 - $i) * 100 / 900;
		$pc = floor($per);
		
		echo " \r";
		echo getTime()." ";
		echo "\033[0;31m[\033[0;33m{$pc}%\033[0;31m]\033[0;37m Closing";
		if($range == 0) {
			echo ".";
		} else if($range == 1){
			echo "..";
		} else {
			echo "...";
		}
		
		echo "   \r";
		
		sleep(1);
		} // end for

		if($dt['bl'] > 0.0001){
			out(getTime(), "Mine penuh...", 2);
			out(getTime(), "Pindahkan Mine --> walet", 1);
			for($i = 10; $i > -1; $i--){
				echo " \r";
				echo getTime();
				echo " [{$i}] Memindahkan..!";
				echo " \r";
				sleep(1);
			}
			echo "\n";
			out(getTime(), "Selesai...", 1);
			$col = collect($u, $url['cl']);
			out(getTime(), "Berhasil memindahkan {$col}\033[1;31m TRX", 5);
			out(getTime(), "Closing system...", 120);
			// system('clear');
		}
	} 

	if($t1[0] == 23 && $t1[1] == 44) {
		out(getTime(), "Menunggu waktu closing . . .", 1);
			for($i = 840; $i > -1; $i--){
			//$pls = $pls + $pl;
			$range = $i % 3;
		$per = (840 - $i) * 100 / 840;
		$pc = floor($per);
		
		echo " \r";
		echo getTime()." ";
		echo "\033[0;31m[\033[0;33m{$pc}%\033[0;31m]\033[0;37m Closing";
		if($range == 0) {
			echo ".";
		} else if($range == 1){
			echo "..";
		} else {
			echo "...";
		}
		
		echo "   \r";
		
		sleep(1);
		} // end for

		if($dt['bl'] > 0.0001){
		out(getTime(), "Mine penuh...", 2);
		out(getTime(), "Pindahkan Mine --> walet", 1);
		for($i = 10; $i > -1; $i--){
			echo " \r";
			echo getTime();
			echo " [{$i}] Memindahkan..!";
			echo " \r";
			sleep(1);
		}
		echo "\n";
		out(getTime(), "Selesai...", 1);
		$col = collect($u, $url['cl']);
		out(getTime(), "Berhasil memindahkan {$col}\033[1;31m TRX", 5);
		out(getTime(), "Closing system...", 120);
		// system('clear');
		}
	}

	if($t1[0] == 23 && $t1[1] == 45) {
		out(getTime(), "Menunggu waktu closing . . .", 1);
			for($i = 780; $i > -1; $i--){
			//$pls = $pls + $pl;
			$range = $i % 3;
		$per = (780 - $i) * 100 / 780;
		$pc = floor($per);
		
		echo " \r";
		echo getTime()." ";
		echo "\033[0;31m[\033[0;33m{$pc}%\033[0;31m]\033[0;37m Closing";
		if($range == 0) {
			echo ".";
		} else if($range == 1){
			echo "..";
		} else {
			echo "...";
		}
		
		echo "   \r";
		
		sleep(1);
		} // end for

		if($dt['bl'] > 0.0001){
		out(getTime(), "Mine penuh...", 2);
		out(getTime(), "Pindahkan Mine --> walet", 1);
		for($i = 10; $i > -1; $i--){
			echo " \r";
			echo getTime();
			echo " [{$i}] Memindahkan..!";
			echo " \r";
			sleep(1);
		}
		echo "\n";
		out(getTime(), "Selesai...", 1);
		$col = collect($u, $url['cl']);
		out(getTime(), "Berhasil memindahkan {$col}\033[1;31m TRX", 5);
		out(getTime(), "Closing system...", 120);
		// system('clear');
		}
	}
}

?>