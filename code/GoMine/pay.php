<?php
system('clear');
$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
// 
$cookie = "";
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