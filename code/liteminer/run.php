<?php
// open site https://rahman115.github.io/ListFaucetPay/
// Klik IQFaucet


system('clear');

// aunt link
$url = [
	'home' =>"https://litecoin-miner.cc/",
	'claim' => "https://litecoin-miner.cc/ajax.php"
];

// User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";

// Cookie: cf_clearance=dtehCGriwXK.75Im54oaOHnD3vlS.xl_qwH7uMPFQuk-1631397412-0-250; PHPSESSID=0f526e70abecd8908579335a04f1d34d; referral=5553; cf_chl_prog=a9
$cookie = "cf_clearance=1RRk_Eaya3WUVsnSYCDPJdQxD9KxGV51HPGIdQDfA_I-1631400216-0-250; PHPSESSID=0f526e70abecd8908579335a04f1d34d; cf_chl_prog=a10";

$u = [
'User-Agent: '.$user,
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Cookie: '.$cookie
];

function getHome($u, $url){
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


	if($info['http_code'] == 200) { 
		$bl = explode('<h3 class="blog-balance">', $result)[1];
		$blc = explode(' Ltc</h3>', $bl)[0];
	
	} else {
		$blc = 0;
	}
    
	

	$val = floatval($blc);

	// print_r(gettype($val));

    $dt = [
    	'string' => $blc,
    	'bl' => $val,
    	'http' => $info['http_code']
    ];
	
	 // print_r($result);
    // print_r($info);
    
    curl_close($ch);
    return $dt;

}

function getWithdrawl($u, $url){

$ch=curl_init();
  	curl_setopt_array($ch, array(
	    CURLOPT_URL => $url,
	    CURLOPT_RETURNTRANSFER => 1,
	    //CURLOPT_CUSTOMREQUEST => 'GET',
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => "action=claim",
	    CURLOPT_HTTPHEADER => $u,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    )
    );
    $result = curl_exec($ch);
	$info = curl_getinfo($ch);

	$json = json_decode($result, true);

	// var_dump($json);
	// print_r($result);
    // print_r($info);
    
    curl_close($ch);
    return $json;
}
echo "\033[1;33mSelamat Datang \033[0;31mlitecoin-miner.cc\n"; sleep(3);
echo "\033[1;33mCreate Code \033[0;31m@AbuduChoy\n"; sleep(3);
echo "\033[0;35mLet Start\n"; sleep(5);
// 0.00000047690
// 0.00001
$minWD = 0.00001;
$fWD = floatval($minWD);

while (true) {
	system('clear');
	$data = getHome($u, $url['home']);

	$WD =$fWD - $data['bl'];
	$sWD = (string)$WD;
	echo "WD -{$sWD}\n";
	echo "\n\033[0;37mBalance \033[1;33m".$data['string']." \033[0;37mLTC";
	echo "\n\033[1;34mTake cuan";
	// print_r($data);
	if($data['http'] == 200) { 
		echo "\n";
		for($i = 1; $i <= 50; $i++){
			for($j = 30; $j > -1; $j--){
				echo " \r";
				echo "\033[0;37m[\033[1;31m{$j}\033[0;37m]\033[1;30m Refresh";
				sleep(1);

			}
			echo "\n";
			$load[$i] = getWithdrawl($u, $url['claim']);
			if($load[$i]["error"] == false) {
				echo "\n\033[0;37m> Loader \033[1;33m{$i}";
				echo "\n\033[0;37m> Message : \033[0;32m".$load[$i]["message"];
				echo "\n";
			} else {
				exit();
			}
		}
	} else {

		exit();
	}
	
	// var_dump($data);

	echo "\n";

} // end while 


?>