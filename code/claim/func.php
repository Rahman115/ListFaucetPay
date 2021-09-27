<?php 
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";

$cookie['xfaucet'] = "address_DOGE=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a; PHPSESSID=o5p067irnu1nicgu21cms9p929; a=JdNCBfbhuwwTrmPyz75BkGoFU7dHCFCD; __cf_bm=U7PiKdzYBs62QAbq2zdx6Qoc.vtsIeHS7vIfeT5qifU-1632620320-0-ATPUvcm/meR2SFJlUzkE8QuyBSDTqfHXrklXu4LFfe5O8B1nedsEdbyP8OM4aveLbcfR0NlKpK83YtNAIUIXvE/p4bRKpoT9Oim+WpBTVkRtOoNiQdpzZXrKedXrLqlpHw==; bitmedia_fid=eyJmaWQiOiI1M2I4NzdhNWEyNDhiNDhiMTM4YWE3ZjZjYjY0Yzc2MCIsImZpZG5vdWEiOiI1MjA4ODI4ODczNTYwMjdmOGZlNGZiYTQyY2NkNGQ0NSJ9; _ga=GA1.2.404330300.1632618538; _gid=GA1.2.4234726.1632618538; token_QpUJAAAAAAAAGu98Hdz1l_lcSZ2rY60Ajjk9U1c=BAYAYU_IEgFhT89YgAGBAsAAIPPtM_BAIsvxnQMx-Hb5YK6LswV-aILU3BIVqPU2TpqkwQBGMEQCIDF0IaWtP8qGFzqhNTnjQr5IB0gyA0wukA5tZj422CmjAiBiJG6xwj4XE1OUPus7FwF4YuuWEEZoZXHKc5Quei_Mtw; _popfired=3; _popfired_expires=Invalid%20Date; lastOpenAt_=1632619302168; CoinTrafficPnd0=1; _gat_gtag_UA_99253040_1=1";

$cookie['dgKonst'] = "address_DOGE=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a; PHPSESSID=jsueu349fa7f3v52ldh2brlk4s; __cf_bm=AwgXcKObRm5IuAqJ60HLZcN3BaxxCjBRxEbuZV9umI8-1632621631-0-Ad9VOqH25kfjO2KD9G8iscPBrCew0mg+PfFbE6wtpKvHN98K7e91uXhfO9Ovn+uobe4Ph2Dl7jMKb5p18EYMC8RMO1pEt4u2UhnDFDzsGmDzwxemXlrr3kyDG4QXdfVaXQ==; _ga=GA1.2.476924221.1632618481; _gid=GA1.2.1612798764.1632618481; bitmedia_fid=eyJmaWQiOiI1M2I4NzdhNWEyNDhiNDhiMTM4YWE3ZjZjYjY0Yzc2MCIsImZpZG5vdWEiOiI1MjA4ODI4ODczNTYwMjdmOGZlNGZiYTQyY2NkNGQ0NSJ9; a=AEcDe04ZH3dBxANUsrkDWwPbGSmZ2T9V; token_QpUJAAAAAAAAGu98Hdz1l_lcSZ2rY60Ajjk9U1c=BAYAYU_IIAFhT9RJgAGBAsAAIIhCn61Dl1U-1GBGZdUnOXukFAFBOe-mU8y2Htaj8xjNwQBHMEUCIQDsLqs2Zv0VkH69iPxtgRXz7WuvX-42z6NvooktS2Om2wIgD4LYVX9QkrSUNNc5MbqpuCUsyxjvaBcQ70EDBhwIlRc; _popfired=5; _popfired_expires=Invalid%20Date; lastOpenAt_=1632620566606; popcashpu=1; _gat=1";


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
