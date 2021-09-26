<?php 

$ua = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";

// Cookie DOGE
$ck['doge'] = "PHPSESSID=lmsfvqnvjv9fc1cga92sp4fa07; bidswitch_last_time=1632616512681; __.popunder=1; rekmob_props_1103711=%7B%22date%22%3A1632616099457%2C%22rekJs%22%3A%7B%22rekmob_ad_unit_type%22%3A1%2C%22rekmob_native_type%22%3Anull%2C%22rekmob_ad_width%22%3A300%2C%22rekmob_fixed_cpm%22%3A0%2C%22rekmob_network_ids%22%3A%22crt_id%3D1%22%2C%22rekmob_ad_unit%22%3A%22476a333b2a4a4d948728d25b66acc356%22%2C%22rekmob_app_type%22%3A1%2C%22rekmob_ad_height%22%3A250%2C%22region_id%22%3A1103711%7D%2C%22countryCode%22%3A%22ID%22%2C%22cookieTime%22%3A1632616518617%7D; rekmob_props_1103713=%7B%22date%22%3A1632616136042%2C%22rekJs%22%3A%7B%22rekmob_ad_unit_type%22%3A3%2C%22rekmob_native_type%22%3Anull%2C%22rekmob_ad_width%22%3A728%2C%22rekmob_fixed_cpm%22%3A0%2C%22rekmob_network_ids%22%3A%22crt_id%3D1%22%2C%22rekmob_ad_unit%22%3A%22b57c5651746b45fe842ed79eeb0e991f%22%2C%22rekmob_app_type%22%3A1%2C%22rekmob_ad_height%22%3A90%2C%22region_id%22%3A1103713%7D%2C%22countryCode%22%3A%22ID%22%2C%22cookieTime%22%3A1632616519729%7D; rekmob_last_seen_b57c5651746b45fe842ed79eeb0e991f=1632616520916; _ga=GA1.2.1112733420.1632616521; _gid=GA1.2.1092440507.1632616521; cto_bundle=UEo3aV9lV1A0S2pxdGJreXY4UThDJTJCS3VjME5BODhacFBpalFFY01TV2o1YVFIVGRKSmRldGNsQ01ud2pySURXOFNGQUh3ank2ZSUyQjdPVVRxdmgxOGpYTVBJUU1WM0FTaFRqJTJGMVFWd0clMkZ1bjQ1WVllZ21uOHFVYWxJdkVsS21DTFlWZXFBRm44MlFlOSUyQlFGUHN5QzROa1J3b2VRJTNEJTNE";



// Cookie TRX
$ck['trx'] = "PHPSESSID=21ae08a3017628fc403b5bd344fcdb3b; bidswitch_last_time=1632616729494; __.popunder=1; _ga=GA1.2.1491561060.1632616731; _gid=GA1.2.1107544369.1632616731; _gat_gtag_UA_171440311_1=1; _data_cpc=229-1_257-1; rekmob_props_1103711=%7B%22date%22%3A1632616701717%2C%22rekJs%22%3A%7B%22rekmob_ad_unit_type%22%3A1%2C%22rekmob_native_type%22%3Anull%2C%22rekmob_ad_width%22%3A300%2C%22rekmob_fixed_cpm%22%3A0%2C%22rekmob_network_ids%22%3A%22crt_id%3D1%22%2C%22rekmob_ad_unit%22%3A%22476a333b2a4a4d948728d25b66acc356%22%2C%22rekmob_app_type%22%3A1%2C%22rekmob_ad_height%22%3A250%2C%22region_id%22%3A1103711%7D%2C%22countryCode%22%3A%22ID%22%2C%22cookieTime%22%3A1632616733223%7D; rekmob_props_1103713=%7B%22date%22%3A1632616136042%2C%22rekJs%22%3A%7B%22rekmob_ad_unit_type%22%3A3%2C%22rekmob_native_type%22%3Anull%2C%22rekmob_ad_width%22%3A728%2C%22rekmob_fixed_cpm%22%3A0%2C%22rekmob_network_ids%22%3A%22crt_id%3D1%22%2C%22rekmob_ad_unit%22%3A%22b57c5651746b45fe842ed79eeb0e991f%22%2C%22rekmob_app_type%22%3A1%2C%22rekmob_ad_height%22%3A90%2C%22region_id%22%3A1103713%7D%2C%22countryCode%22%3A%22ID%22%2C%22cookieTime%22%3A1632616733234%7D; rekmob_last_seen_476a333b2a4a4d948728d25b66acc356=1632616734036; cto_bundle=e1g0PV85c0VpbmNQYk4zdjhuVndBSUtkeVElMkJhUVh0TnhYemhrSmdYdzglMkJGcDZMdkdmeVQ4dVElMkJ2eGZ2MXdIRkdSWmZqNmdONmI3R0xUd0dsYmhKekNra2FWaXBRN0FIaHpRUEJOdUZxT2Q1eGRXcDJrRTklMkZxQ1NhJTJCSUNINElqaEolMkYwZDg2ZkpUdFV6RUlRbHRhd0dKNkRESmclM0QlM0Q";


$uri = [
	'doge' => [
		'host' => "https://minedoge.cf",
		'miner' => "https://minedoge.cf/user/home",
		'ptc' => "https://minedoge.cf/user/ptc",
		'pay' => "https://minedoge.cf/user/pay",
		'collect' => "https://minedoge.cf/inc/data.php",
		'slwall' => "https://minedoge.cf/user/slwall",
		'ads' => "",
		'data' => "amount=0.0001&fpay="
	],
	'trx' => [
		'host' => "https://gomine.xyz",
		'miner' => "https://gomine.xyz/user/home",
		'ptc' => "https://gomine.xyz/user/ptc",
		'pay' => "https://gomine.xyz/user/pay",
		'collect' => "https://gomine.xyz/inc/data.php",
		'slwall' => "https://gomine.xyz/user/slwall",
		'ads' => "",
		'data' => "amount=0.0001&fpay="
	]

];


$acpTrx = 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
$acpDoge = 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
// <h4 style='color:green'>0.0001 DOGE Paid Successfully to address oppipo2610@gmail.com</h4>
?>
