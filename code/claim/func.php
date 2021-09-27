<?php 
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";

$cookie['xfaucet'] = "address_DOGE=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a; PHPSESSID=ndr8hf6j8136cfk41u9ph5cg8n; bitmedia_fid=eyJmaWQiOiI1M2I4NzdhNWEyNDhiNDhiMTM4YWE3ZjZjYjY0Yzc2MCIsImZpZG5vdWEiOiI1MjA4ODI4ODczNTYwMjdmOGZlNGZiYTQyY2NkNGQ0NSJ9; _ga=GA1.2.1948542324.1632763370; _gid=GA1.2.1234651027.1632763370; __cf_bm=MerY.3HzBJNMmZ6V0Xhyx.Bs1.BmJ1nCcyUrg81FoHM-1632763370-0-Aari6HnnF5U5p/8iBd93oM6EUKrF9ZOyrbLkAGhpu1OPWCf+gaqwJ9jAvf5Ol2ouje6zr4IzchKi/m0Kfow13VSdFCiEC+3Ih+lBMDiTKNKSodMshdcq8ghCuXDtd9fuYQ==; popcashpu=1; _ccnsad_pop=500; a=yh792Dqy5BT9qyyKDwEniNTKpndoq5vx; token_QpUJAAAAAAAAGu98Hdz1l_lcSZ2rY60Ajjk9U1c=BAYAYVH-7AFhUgEVgAGBAsAAILLCBWGzvtZcXEuw1XxipDW9ysqTNPWPchGawR_0AadZwQBGMEQCIHjssBQzX9QphmPZj5lvTSyOTegpdtl78FinXPv_SZgVAiBehKNAOn1ExXPTnkqn0r1wa1GTdpf-GO3STsAD8sMUAQ; _popfired=1; _popfired_expires=Tue%2C%2028%20Sep%202021%2017%3A36%3A55%20GMT; lastOpenAt_=1632764215865; _gat_gtag_UA_99253040_1=1";

$cookie['dgKonst'] = "address_DOGE=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a; PHPSESSID=ciofmos61aq76p48kcequ69d7e; _ga=GA1.2.1002150881.1632763006; _gid=GA1.2.1408224078.1632763006; __cf_bm=JLTDJpWEEgf5JIHPnDLG.14Erob.vg_XNGuiLjCRCKA-1632763006-0-AavKvRTGyER9RS4yYP2NEJlKbdXiqNPf9Pxpp7R+VOE4W+RghVvbGm3N8RqycHFeTqfW5VxG7Hcr7fAqTpFCi6fLYzBKdFxgEnffOg7Wfk4axOJo/ypOqOtAv6wL/UhoPA==; popcashpu=1; _ccnsad_pop=500; a=HqoHGwp6RI8gdGAXWylhXkI9EdMSLUNd; bitmedia_fid=eyJmaWQiOiI1M2I4NzdhNWEyNDhiNDhiMTM4YWE3ZjZjYjY0Yzc2MCIsImZpZG5vdWEiOiI1MjA4ODI4ODczNTYwMjdmOGZlNGZiYTQyY2NkNGQ0NSJ9; token_QpUJAAAAAAAAGu98Hdz1l_lcSZ2rY60Ajjk9U1c=BAYAYVH8qAFhUf0igAGBAsAAIL2joW1Iojd2fNyrpkH5kiS8--VgS26h5YKtI1u2CDBvwQBHMEUCIQCcNtnzCK9V-CxJfGXXI_WwYne5-asBS58a_41eFlGiIQIgXOMKO29MhBzS0TFIlI9NTT0-bQjNwRQMogHEPZ3d790; _popfired=1; _popfired_expires=Tue%2C%2028%20Sep%202021%2017%3A17%3A56%20GMT; lastOpenAt_=1632763076843; _gat=1";


function user_agent($user, $cookie) {
	$u = [
		"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
		"User-Agent: ".$user,
		"Cookie: ".$cookie
	];

	return $u;
}

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

// print_r($result);
curl_close($ch);
return $result;
}

function exeDataXfaucet($result) {
	$data = array();
	$ex = explode(' text-center" style="max-width: 468px;">', $result);
	$vr = explode('class="alert alert-', $ex[0])[1];
	$msg = explode('</', $ex[1])[0];

	// var_dump($vr);
	if($vr == "primary") {
		$data['b'] = true;
		$data['msg'] = $msg;

		$k = explode("(location).attr('href','", $result)[1];
		$lik = explode("');", $k)[0];

		$lf = explode(' daily claims left.', $result)[0];
		$data['left'] = explode('remind you that you have ', $lf)[1];

		$data['short'] = $lik;
	} else {
		$data['b'] = false;
		$data['msg'] = $msg;
	}
	// var_dump();
	return $data;
}

function exeDataKonstDg($result) {
	$data = array();
	$ex = explode('style="max-width: 468px;margin: auto;">', $result);
	$count = count($ex);
	if($count == 4) {
		$vr = explode('</div>', $ex[3])[0];
	} else { 
		$vr = explode('</div>', $ex[2])[0];
	// $msg = explode('</', $ex[1])[0];
	}
	// print_r($result);
	// print_r(count($ex));
	// var_dump($vr);
	if($vr == "") {
		$data['b'] = true;
		$data['msg'] = "Ready ";

		$k = explode("(location).attr('href','", $result)[1];
		$lik = explode("');", $k)[0];

		$lf = explode(' daily claims left.', $result)[0];
		$data['left'] = explode('You have ', $lf)[1];
		$data['short'] = $lik;
	} else {
		$data['b'] = false;
		// $data['msg'] = "Wait ";
		$data['msg'] = "You have to wait ...";
	}
	// var_dump();
	return $data;
}


function xLoop($m) {
	for($i = $m; $i > -1; $i--){
			echo " \r";
			echo "[{$i}] Reload";
			sleep(1);
	}
	echo "\n";
}

// xfaucet 
// 15 daily claims left.


// 21

?>
