<?php
system('clear');
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
// 
$cookie = "PHPSESSID=3f6nt2eedq5b1p91t7k4eq2br1; bidswitch_last_time=1632027919930; _ga=GA1.2.462336386.1632027922; _gid=GA1.2.1823117279.1632027922; rekmob_props_1103711=%7B%22date%22%3A1632106896410%2C%22rekJs%22%3A%7B%22rekmob_ad_unit_type%22%3A1%2C%22rekmob_native_type%22%3Anull%2C%22rekmob_ad_width%22%3A300%2C%22rekmob_fixed_cpm%22%3A0%2C%22rekmob_network_ids%22%3A%22crt_id%3D1%22%2C%22rekmob_ad_unit%22%3A%22476a333b2a4a4d948728d25b66acc356%22%2C%22rekmob_app_type%22%3A1%2C%22rekmob_ad_height%22%3A250%2C%22region_id%22%3A1103711%7D%2C%22countryCode%22%3A%22ID%22%2C%22cookieTime%22%3A1632106958896%7D; rekmob_props_1103713=%7B%22date%22%3A1632106897605%2C%22rekJs%22%3A%7B%22rekmob_ad_unit_type%22%3A3%2C%22rekmob_native_type%22%3Anull%2C%22rekmob_ad_width%22%3A728%2C%22rekmob_fixed_cpm%22%3A0%2C%22rekmob_network_ids%22%3A%22crt_id%3D1%22%2C%22rekmob_ad_unit%22%3A%22b57c5651746b45fe842ed79eeb0e991f%22%2C%22rekmob_app_type%22%3A1%2C%22rekmob_ad_height%22%3A90%2C%22region_id%22%3A1103713%7D%2C%22countryCode%22%3A%22ID%22%2C%22cookieTime%22%3A1632106962427%7D; rekmob_last_seen_476a333b2a4a4d948728d25b66acc356=1632106962340; rekmob_last_seen_b57c5651746b45fe842ed79eeb0e991f=1632106962359; popcashpu=1; _data_cpc=32-3_78-5_229-3_257-5; _data_html=158-1; pop_delay_52795=1";
// $cookie = "PHPSESSID=vbng315esp6jr6mrfu6cvo45c4; _ga=GA1.2.586875909.1631820981; _gid=GA1.2.1288826454.1631820981; _data_cpc=32-3_78-3_229-4; _gat_gtag_UA_171440311_1=1; __.popunder=1";
// Cookie: Cookie: PHPSESSID=vbng315esp6jr6mrfu6cvo45c4; _ga=GA1.2.586875909.1631820981; _gid=GA1.2.1288826454.1631820981; _data_cpc=32-5_78-5_229-5; __.popunder=1; popcashpu=1; _data_pop=183-1; _data_html=158-1
// $cookie = "PHPSESSID=vbng315esp6jr6mrfu6cvo45c4; _ga=GA1.2.586875909.1631820981; _gid=GA1.2.1288826454.1631820981; _data_cpc=32-2_78-3_229-2; _gat_gtag_UA_171440311_1=1";
$count_wd = "0.0015";
$url = [
	'host' => "https://gomine.xyz", 
	'uri' => "https://gomine.xyz/user/pay",
	'slwall' => "https://gomine.xyz/user/slwall",
	'data' => "amount={$count_wd}&fpay=",
	'home' =>"https://gomine.xyz/user/home",
	'cl' => "https://gomine.xyz/inc/data.php",
	'urlc' => "https://gomine.xyz/user/ptc",
	'ptc' => "https://skippyads.com/?page=wall&p=iriyFwfnGmx&u=8692",
	'get' => "http://skippyads.com/?page=click&p=iriyFwfnGmx&i=329&u=8692",
	'verify' => "http://skippyads.com/?page=verify&p=iriyFwfnGmx&i=328&u=8692&t=ac02a50fd8293df96cdca0901e4f16af",
	'login' => "acc=TQWEaCKTVNzFSi7s29RamaiQou8VpgxNfF
&reff=&login="
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
	

	$lis = explode('<a class="nav-link" href="', $result);
	// print_r($lis[1]);
	// var_dump(count($lis));

	if($result != null && count($lis) != 6) {
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
} else {
	$data = [
		'coin' => "TRX",
		'var' => 0,
		'balance' => "0",
		'table' => 0
	];
}
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
	$msg = explode("<h4 style='color:", $result)[1];
	$msge = explode('</h4>', $msg)[0];

	$mesage = explode("'>", $msge);	
}
curl_close($ch);
return $mesage;
}


function postLogin($u, $url){
	$ch=curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url['host'],
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_FOLLOWLOCATION => 1,
	CURLOPT_POST => 1,
	CURLOPT_POSTFIELDS => $url['login'],
	CURLOPT_HTTPHEADER => $u,
	CURLOPT_SSL_VERIFYPEER => 0,
	)
);
$result = curl_exec($ch);
$http = curl_getinfo($ch);
// if($http['http_code'] == 200) {
// 	$res = $result;
// } else {
// 	$res = null;
// }
print_r($result);
print_r($http);
curl_close($ch);
// return $res;
}
?>