<?php  
include 'func.php';
system('clear');

$url = [
	'konst' => "https://konstantinova.net/dogecoin/?r=DF4fuDcUTakiiGUdt9xq5T7mbGv8CviRPq",
	'constx' => "https://konstantinova.net/tron/?r=TJBrpoHzKoxiCb5SMXx8uSGfWHZptcxRwL
",
	'xfaucet' => "https://xfaucet.net/bonus/dogecoin/?r=DF4fuDcUTakiiGUdt9xq5T7mbGv8CviRPq",
	'diamond' => "https://diamondfaucet.space/trx/?r=TJBrpoHzKoxiCb5SMXx8uSGfWHZptcxRwL
"
];

// <div class="alert alert-white" style="max-width: 468px;margin: auto;">
// <p><i class="fa fa-clock-o" aria-hidden="true"></i> You have to wait 5 minutes</p>
// </div>

// style="max-width: 468px;margin: auto;">

// <div class="alert alert-primary text-center" style="max-width: 468px;">0.0014 DOGE every 5 minutes</div>


// https://konstantinova.net/verify/XFgq25srVk2
// https://xfaucet.net/bonus/dogecoin/shortlink.php?h=ptSwTXFw9cjK
// $(location).attr('href','shortlink.php?h=ptSwTXFw9cjK');


function out($ms, $tm){
	echo "{$ms} \n";
	sleep($tm);
}
$num = 0;
while (true) {
	system('clear');
	out("doge : D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a
", 1);
	$num++;
	
	out("Load ".$num, 1);
// 	out("URL : ".$url['const'], 1);
// 	out("URL : ".$url['constx'], 1);
// 	out("URL : ".$url['xfaucet'], 1);
// 	out("URL : ".$url['diamond'], 1);
	$u = user_agent($user, $cookie['xfaucet']);
	$uKonstDg = user_agent($user, $cookie['dgKonst']);


	$resXfaucet = setData($u, $url['xfaucet']);
	$resKonstDg = setData($uKonstDg, $url['konst']);

	out("Konstatinova Doge", 1);
	$konstDg = exeDataKonstDg($resKonstDg);
	if($konstDg['b'] == true) {
		out("URL : https://konstantinova.net/dogecoin/".$konstDg['short'], 1);
		out("Claim Left ".$konstDg['left'], 1);
		out("pesan : ".$konstDg['msg'], 1);
		xLoop(30);
	} else {
		out("pesan : ".$konstDg['msg'], 1);
		xLoop(60);
	}


	out("xFaucet", 1);
	$hsl = exeDataXfaucet($resXfaucet);
	if($hsl['b'] == true) {
		out("URL : https://xfaucet.net/bonus/dogecoin/".$hsl['short'], 1);
		out("Claim Left ".$hsl['left'], 1);
		out("pesan : ".$hsl['msg'], 1);
		xLoop(200);
	} else {
		out("pesan : ".$hsl['msg'], 1);
		xLoop(60);
	}

    out("https://doge-faucet.com/?r=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a", 1);
// 		https://doge-faucet.com/?r=D6Lh3ALK2Gx5QsanxxfcoE6P2TiHnCJ21a




}
echo "\n";
?>