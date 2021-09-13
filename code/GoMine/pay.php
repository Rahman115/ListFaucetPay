<?php
system('clear');

/**
<small>Available for payout <h2 class="text-center"><span> 0.04562194   </span> <strong><span class="val">TRX</span></strong></h2></small>
</div>

<h4 style='color:green'>0.0002 TRX Paid Successfully to address TQWEaCKTVNzFSi7s29RamaiQou8VpgxNfF</h4><!-- Bittraffic - Ad Display Code -->


</center>
<br><h2>Withdrawal History</h2><center><table id='withdraw'>

<tr><th style='width:10%'>id</th><th style='width:15%'>Date</th><th style='width:40%'>Account</th><th style='width:15%'>Amount</th><th style='width:10%'>Status</th></tr>

<tr><td>27722</td><td>2021-09-12</td><td>TQWEaCKTVNzFSi7s29RamaiQou8VpgxNfF</td><td>0.0002 TRX</td><td><b style="color:green;">Paid</b></td></tr>
<tr><td>27719</td><td>2021-09-12</td><td>TQWEaCKTVNzFSi7s29RamaiQou8VpgxNfF</td><td>0.0001 TRX</td><td><b style="color:green;">Paid</b></td></tr></table></center><br><br><br>

**/
// kumpulan link

$count_wd = "0.0005";

$url = [
	'uri' => "https://gomine.xyz/user/pay",
	'data' => "amount={$count_wd}&fpay=",
	'home' =>"https://gomine.xyz/user/home",
	'cl' => "https://gomine.xyz/inc/data.php"
];


$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
$cookie = "PHPSESSID=dga4o5jbl5hqbe0b7fs8h7ngs5; __.popunder=1; _ga=GA1.2.1385783993.1631486376; _gid=GA1.2.1011802658.1631486376; _data_cpc=78-5_229-5; popcashpu=1; _data_pop=234-1; _data_html=158-1";

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

// while (true) {
// 	system('clear');
// 	echo("\n");
	

// 	showData($dt);
// 	if($dt['var'] > 0.0001) { 
// 		echo "\nGet Withdrawl {$count_wd} \n";
// 		for($i = 900; $i > -1; $i--){
// 			$range = $i % 6;

// 			$per = (900 - $i) * 100 / 900;
// 			$pc = floor($per);
// 			if($range == 0) { 
// 				echo " \r";
// 				echo "[{$pc}%] Reload";

// 			}
// 			sleep(1);
// 		}

// 		$ms = wd($u, $url);
// 		echo "\n{$ms}";
// 		sleep(5);
// 	} else {
// 		exit();
// 	}

// } // end while
// echo "\n";

$a = "saya dari pay.php";

?>