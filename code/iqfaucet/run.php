<?php
// open site https://rahman115.github.io/ListFaucetPay/
// Klik IQFaucet


system('clear');

// aunt link
$url = [
	'cek' =>"https://iqfaucet.com/account.php",
	'wd' => "https://iqfaucet.com/account.php?withdr=fp"
];
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
$cookie = "PHPSESSID=85ubkooorog180v0fn57552fo2; bitmedia_fid=eyJmaWQiOiIzZGIwM2M3ZGY1MjUyNGRmMDM2NTJlMzA4N2U5NDM2OSIsImZpZG5vdWEiOiJkZjczN2U3MDhmMzJkNTJjYzE1MWYxZWZiNWQ1OWQ5OSJ9; refer=208360; _ccnsad_pop=500";

$u = [
'User-Agent: '.$user,
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Cookie: '.$cookie
];

function getCek($u, $url){
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

    $bl = explode(' DOGE</h2>', $result)[0];
    $blc = explode('<h2>', $bl)[1];
	$info = curl_getinfo($ch);

	$val = floatval($blc);

	// print_r(gettype($val));

    $dt = [
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
	    CURLOPT_HTTPHEADER => $u,
	    CURLOPT_SSL_VERIFYPEER => 0,
	    )
    );
    $result = curl_exec($ch);

    $bl = explode(' DOGE was sent to your account', $result)[0];
    $blc = explode('<div class="alert alert-success">', $bl)[1];
	$info = curl_getinfo($ch);

	// print_r(gettype($blc));

    $dt = [
    	'bl' => $blc,
    	'http' => $info['http_code']
    ];
	
	// echo "\nHas Send : \n";
	// print_r($dt);
    // print_r($info);
    
    curl_close($ch);
    return $dt;
} // end function

while (true) {
	// system('clear');

	$hs = getCek($u, $url['cek']);

	if($hs['bl'] > 0.00000000) {
		echo "\nBalance : ".$hs['bl'];
		sleep(3);
		echo "\nLakukan WD ";
		$wd = getWithdrawl($u, $url['wd']);
		echo $wd['bl']." DOGE";
		echo "\n";
		for($i = 120; $i > -1; $i--){
			echo " \r";
			echo "[{$i}] Reload";
			sleep(1);
		}
	} else {
		// exit();
		echo "\nWD panding";
		for($i = 240; $i > -1; $i--){
			echo " \r";
			echo "[{$i}] Reload";
			sleep(1);
		}


	} // end if else

	echo "\n";

} // end while 


?>
