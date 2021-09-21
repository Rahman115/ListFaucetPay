<?php 
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";

$cookie['xfaucet'] = "address_DOGE=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a; PHPSESSID=7khmf1n5o7cghhei9m2cnqd62i; _ga=GA1.2.1529261558.1632157596; _gid=GA1.2.1164368390.1632157596; __cf_bm=gEjmKcKdUDdsYjNW3BQL.QzYa8e2b4pEuZqe6.tEw24-1632158670-0-AQMlBB7pBDy5y8TsM3cISZvuilKjLhVHClH/6KnzP6GaOFz4gKwVB3uiqRUssL12W7Y1lMVEX60UNBFOXefgfbsU4gDfPG+MOOtzXanabCWuXaHK9Br2DAVYvamdBit8PA==; bitmedia_fid=eyJmaWQiOiI1M2I4NzdhNWEyNDhiNDhiMTM4YWE3ZjZjYjY0Yzc2MCIsImZpZG5vdWEiOiI1MjA4ODI4ODczNTYwMjdmOGZlNGZiYTQyY2NkNGQ0NSJ9; a=0DdmW6C985cerlvh8Sh7sHkPZiwCoZn3; token_QpUJAAAAAAAAGu98Hdz1l_lcSZ2rY60Ajjk9U1c=BAYAYUjChQFhSMYWgAGBAsAAIMUHu6Y05hXPsdMu1D0UjcG81tvHYF2QAY-n2Ll-iRqTwQBGMEQCIHjYKObSkzbxm9xntX1ex-xFY2Th5LhTj4mOCZt0CzRcAiB5ZxphnZnZHlGSseEAopLxje2oo70h3Eg5TRtW0k51tA; _popfired=3; _popfired_expires=Invalid%20Date; lastOpenAt_=1632159222803; _gat_gtag_UA_99253040_1=1";

$cookie['dgKonst'] = "address_DOGE=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a; PHPSESSID=9h6fc23sa38hu9tie91j2l88h9; bitmedia_fid=eyJmaWQiOiI1M2I4NzdhNWEyNDhiNDhiMTM4YWE3ZjZjYjY0Yzc2MCIsImZpZG5vdWEiOiI1MjA4ODI4ODczNTYwMjdmOGZlNGZiYTQyY2NkNGQ0NSJ9; a=1pmB4B4h5nSFxggNdSeasvISOtDOZ1Dr; _ga=GA1.2.1850306637.1632157564; _gid=GA1.2.776092649.1632157564; token_QpUJAAAAAAAAGu98Hdz1l_lcSZ2rY60Ajjk9U1c=BAYAYUi_fAFhSNd8gAGBAsAAIDGJBa-74WAsPFAwTpSofu6ZOMhu9dRYYEpejcLus6pywQBIMEYCIQCxWFOy5EuhQFiagrvH2NzI3MAWEX4TaI9EFMnxnk9abwIhAO8bm8NHy5e-6IuccQq_2g3PhU_miTGWV4bNP5f1gepA; _popfired=1; _popfired_expires=Tue%2C%2021%20Sep%202021%2017%3A16%3A40%20GMT; lastOpenAt_=1632158200298; __cf_bm=vJjEGBk1A.s2eavnvWDL3LkK79kh_pKhisFug.NqjiA-1632163483-0-AY6p+EUDVc9gQimQ5n0lbGZyowyHh3hR9R59ySHj0yYJqcZPNMv3mO0Mph5K45mygXU8z29+oTCQzAhh2of+5io7DD1zVxTQXHDIqUwwvew82oW6+mOnohnJth8ceFL4Rw==; _gat=1";


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
