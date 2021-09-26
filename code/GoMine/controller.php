<?php 
/**
 * Color code
 * \033[0;37m : putih
 * \033[0m
 * \033[1;33m : orange
 * \033[1;31m : merah 
 * \033[1;34m : biru
 * \033[1;32m : hijau
 * \033[1;35m : ungu

user_agent 

**/
function user_agent($user, $cookie, $accept){
	$u = [
		'User-Agent: '.$user,
		'Accept: '.$accept,
		'Cookie: '.$cookie
		];
	return $u;
}


/**

getTimeArr 

**/
function getTimeArr() {
	// set the default timezone to use.
	date_default_timezone_set('UTC');
	$timezone  = -4; //(GMT -4:00) waktu server
	$end = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
	// echo gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$clock = explode(':', $end);
	if($clock[0] == "00" && $clock[1] == "00" && $clock[2] == "00"){
		echo "\n";
		echo "Waktu selesai 00:00:00\n"; sleep(1);
		echo "Cek Link ->\n";sleep(1);
		echo "https://gomine.xyz/user/home\n";
		exit();
	}
	
	return $clock;
} // end function getTime


/**

setPay 

**/
function setPay($u, $url){
	$ch=curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url['pay'],
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_FOLLOWLOCATION => 1,
	CURLOPT_HTTPHEADER => $u,
	CURLOPT_SSL_VERIFYPEER => 0,
	// CURLOPT_TIMEOUT_MS => 2000
	)
);
$result = curl_exec($ch);
$http = curl_getinfo($ch);

if($http['http_code'] == 200) {
	$res = $result;
} else {
	$res = null;
}

curl_close($ch);
return $res;
}


/**

getData 

**/
function getData($result) {

	$lis = explode('<a class="nav-link" href="', $result);

	if($result != null && count($lis) != 6) {
	$blc = explode('<h2 class="text-center"><span> ', $result)[1];
	$ext = explode('</span></strong></h2>', $blc)[0];
	$balance = explode('   </span> <strong><span class="val">', $ext)[0];
	$coin = explode('   </span> <strong><span class="val">', $ext)[1];

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
		'coin' => $coin,
		'var' => $var,
		'balance' => $balance,
		'table' => $tblData
	];
	} else {
		$data = [
			'coin' => "Kosong",
			'var' => 0,
			'balance' => 0,
			'table' => 0
		];
	}
	return $data;
}

/**

collect 

**/

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

/**

WD 

**/
function wd($u, $url) {
	$ch=curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url['pay'],
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
	$msg = explode("<h4 style='color:", $result)[1];
	$msge = explode('</h4>', $msg)[0];

	$mesage = explode("'>", $msge);	

	$mm = explode(' to address ', $mesage[1])[0];
	$mesage[1] = $mm;
}
curl_close($ch);
return $mesage;
}


/**

setData 

**/

function setDataMiner($u, $url) {
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
$data = array();

$pw = explode('</b> Power: ', $result)[1];
$Ea = explode(' | Earning:  ', $pw);
$sc = explode('/sec | Daily: ', $Ea[1]);
$cn = explode('  ', $sc[0]);
$dl = explode(" {$cn[1]}</b>", $sc[1]);

// var_dump($pw);
$data['power'] = $Ea[0];
// var_dump($sc[0]);
$data['second'] = $cn[0];
$data['coin'] = $cn[1];
$data['daily'] = $dl[0];

// exit();
$rn = explode("MINER: <b class='text-", $result)[1];
$rn1 = explode('</b>', $rn)[0];
$run = explode("'>", $rn1);
$data['msg'] =  $data['coin']." ".$run[1];

$data['verify'] = true;

if($run[1] == "STOPPED") {
	$data['verify'] = false;
	$data['balance'] = "";
	$data['bl'] = 0;
	$data['sec'] = 0;
} else { 
	$data['verify'] = true;
	$data['balance'] = "";
	$b = explode('var sec = ', $result)[1];
	$data['bl'] = explode(';', $b)[0];
	$s = explode('sec = sec + ', $result)[1];
	$data['sec'] = explode(';', $s)[0];


}
if($data['bl'] == 0) {
	$data['wl'] = "null";
} else { 
	$us = explode('<h3>USER: ', $result)[1];
	$data['wl'] = explode('<br>', $us)[0];
	// print_r(gettype($bl));

}

curl_close($ch);
return $data;
}

function verifyMiner($u, $dt, $per, $url){

	// print_r($dt);

	out(getTime(), "✅ \033[1;33m{$dt['msg']}", 1);
	out(getTime(), "\033[1;34m{$per} % 👛  \033[1;33m{$dt['balance']}\033[1;31m {$dt['coin']}", 1);

	echo getTime();
	echo " ⏬ Mine Result +\033[1;33m";
	echo rtrim(sprintf('%.10f',floatval($dt['bl'])),'0');
	echo "\033[1;31m {$dt['coin']} \n"; sleep(1);
	out(getTime(), "🔻 Info Mining", 1);
	out(getTime(), "📶 \033[1;37mPower \033[1;33m{$dt['power']}", 1);
	out(getTime(), "📶 \033[1;37mRemine \033[1;33m{$dt['second']}/second", 1);
	out(getTime(), "📶 \033[1;37mDaily \033[1;33m{$dt['daily']} \033[1;31m{$dt['coin']}", 1);
	out(getTime(), "⏩ Cek Hasil Mine", 2);
	slwall($u, $url['slwall'], $dt['power']);
	// var_dump($url);
// 
	$mPer = floor((0.0001 - $dt['bl']) * 100 / 0.0001);
	$mnPer = 100 - $mPer;

	if($dt['bl'] > 0.0001){
		out(getTime(), "🔻 Mine penuh {$mnPer}%", 2);
		out(getTime(), "🔀 Pindahkan Mine ke walet", 1);
		for($i = 10; $i > -1; $i--){
			echo " \r";
			echo getTime();
			echo " [{$i}] Memindahkan..!";
			echo "\r";
			sleep(1);
		}
		out(getTime(), "✅ Done             ", 1);
		// 🔻✅🆗 📨🧱🧱🧱🧱🧱🧱🧱 🔚
		// echo "\n";
		// out(getTime(), "Selesai...", 1);
		$col = collect($u, $url['collect']);
		out(getTime(), "🆗  Berhasil memindahkan \033[1;33m{$col}\033[1;31m {$dt['coin']}", 5);
		out(getTime(), "🔚  Reload system...", 5);
		// system('clear');
		} else {
			out(getTime(), "🔻 {$mnPer}% Not Full", 2);

		}
}


function slwall($u, $url, $khs){

$khs = explode('Kh/s', $khs)[0];
if($khs < 38){
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
	$info = curl_getinfo($ch)['http_code'];
	if($info == 200) { 
		$t = explode(";'><td>", $result);
		$no = 0;
		for($i = 0; $i < count($t) -1; $i++) {
			
			$num = $i + 1;
			$tb[$i] = explode('</b></a></div>', $t[$num])[0];
			$var[$i] = explode('</td><td>', $tb[$i]);
			$var[$i][1] = explode(' / ', $var[$i][1]);
			
			if($var[$i][1][0] == $var[$i][1][1] ){
				$h[$i] = explode('href="', $var[$i][3])[1];
				$var[$i][3] = explode('" ><b>', $h[$i]);
				$var[$i][1] = $url.$var[$i][3][0];
				$var[$i][3] = $var[$i][3][1];
				// $v[$i] = $var[$i];
			} else {
				$h[$i] = explode("</a></div></td></tr><tr style='outline: 0px solid green", $var[$i][3])[0];
				$var[$i][1] = 0;
				$var[$i][3] = explode('18px;">', $h[$i])[1];
			}

			if($var[$i][3][0] != "" ){
				$v[$i] = $var[$i];
			}

			if($v[$i][2] != "4"){
				$vi[$no] = $v[$i];
				$no++;
			}
		} // end for

		for($j = 0; $j < count($vi); $j++){
			if($vi[$j][3] == "Visit"){ 
				out(getTime(), "🧱 [{$vi[$j][2]}] {$vi[$j][0]} : {$vi[$j][1]}", 0);
			} else {
				out(getTime(), "✅ [{$vi[$j][2]}] {$vi[$j][0]}", 0);
			}
		}
		// var_dump($vi);
		// var_dump($hr);
		// exit();
		// var_dump(count($t));
	} else {
		out(getTime(), "🔚 slwall GAGAL", 2);
	}
	curl_close($ch);
	} // end if
} // end func

?>
