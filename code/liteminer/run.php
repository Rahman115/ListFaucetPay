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
$cookie = "cf_clearance=loBLH0XK7U08ZMWuYVUdiFZzSETqDPhFdg61iKttmAc-1631391081-0-250; PHPSESSID=0f526e70abecd8908579335a04f1d34d; cf_chl_prog=a12";

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

while (true) {
	// system('clear');
	$data = getHome($u, $url['home']);
	print_r($data);
	if($data['http'] == 200) { 
		echo "\n";
		for($i = 0; $i < 5; $i++){
			for($j = 30; $j > -1; $j--){
				echo " \r";
				echo "[{$i}] Reload";
				sleep(1);

			}
			echo "\n";
			$load[$i] = getWithdrawl($u, $url['claim']);
			if($load[$i]["error"] == false) {
				echo "\nLoad {$i}";
				echo "\nMessage : ".$load[$i]["message"];
			}
		}
	} else {

		exit();
	}
	
	// var_dump($data);

	echo "\n";

} // end while 


?>