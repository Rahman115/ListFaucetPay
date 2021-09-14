<?php
include 'pay.php';
include 'run.php';
system('clear');

echo "\n";
$n = 0;
while (true) {

	$t1 = getTimeArr();
	$set = setPay($u, $url);
	$dtPay = getData($set);
	$n++;
	// code...
	$dt = setData($u, $url['home']);


	closing($dt, $t1, $u, $url);

	if($t1[0] == 21 || $t1[0] == 22) { 
		$url['ptc'] = getLinkPtc($u, $url['urlc']);
		$setPTC = setPtc($u, $url['ptc']);

		exePTC($setPTC, $u);
	} else {
		// out(getTime(), "skip PTC", 1);
	}
	// print_r(getTime());
	// exit();

out(getTime(), "[{$n}] Refresh...", 1);

$pPer = floor((0.0005 - $dtPay['var']) * 100 / 0.0005);
$payPer = 100 - $pPer;
// var_dump($payPer);

if($dtPay['var'] > 0.0005) {
	out(getTime(), "Kapasitas {$payPer} %", 2);
	out(getTime(), "Walet siap di Withdraw", 1);
	out(getTime(), "Walet   \033[1;33m{$dtPay['balance']}\033[1;31m TRX", 1);
	out(getTime(), "Withdrawl \033[1;33m{$count_wd}\033[1;31m TRX", 1);
	$ms = wd($u, $url);
	out(getTime(), "{$ms}", 10);
	system('clear');
} else {
	out(getTime(), "Walet [{$payPer} %] 🗂  \033[1;33m{$dtPay['balance']}\033[1;31m TRX", 1);

echo getTime();
echo " Miners +\033[1;33m";
echo rtrim(sprintf('%.10f',floatval($dt['bl'])),'0');
echo "\033[1;31m TRX \n"; sleep(1);
out(getTime(), "Cek Hasil Mine", 2);

$mPer = floor((0.0001 - $dt['bl']) * 100 / 0.0001);
$mnPer = 100 - $mPer;

if($dt['bl'] > 0.0001){
	out(getTime(), "🔻 Mine penuh {$mnPer}%", 2);
	out(getTime(), "Pindahkan Mine --> walet", 1);
	for($i = 10; $i > -1; $i--){
		echo " \r";
		echo getTime();
		echo " [{$i}] Memindahkan..!";
		echo " \r";
		sleep(1);
	}
	echo "\n";
	out(getTime(), "Selesai...", 1);
	$col = collect($u, $url['cl']);
	out(getTime(), "🗂 Berhasil memindahkan {$col}\033[1;31m TRX", 5);
	out(getTime(), "Reload system...", 5);
	system('clear');
} else {
	out(getTime(), "🔻 Mine \033[0;33m{$mnPer}\033[1;33m% \033[1;31mbelum penuh.", 2);
	$v = floatval($dt['bl']);
	$pl = floatval($dt['sec']);
	$pls = $v;
	$second = 60;
	$menit = $second / 60;
	out(getTime(), "🔻 Lakukan Mining {$menit} menit", 1);
	for($i = $second; $i > -1; $i--){
		$pls = $pls + $pl;
		$range = $i % 2;
		$per = ($second - $i) * 100 / $second;
		$pc = floor($per);
		
		echo " \r";
		echo getTime()." ";
		echo "\033[0;31m[\033[0;33m{$pc}%\033[0;31m]\033[0;37m Mine ";
		if($range == 0) {
			echo "^\033[1;33m";
		} else {
			echo "*\033[1;33m";
		}
		
		
		echo rtrim(sprintf('%.10f',floatval($pls)),'0');
		echo "\033[1;31m TRX";
		echo "   \r";
		
		sleep(1);
	}
	echo "\n";
	out(getTime(), "📄 \033[1;32mMining Selesai", 1);
	out(getTime(), "\033[1;33m.", 1);
	out(getTime(), "🗃  \033[1;32mMenyimpan hasil mine...", 5);
	system('clear');
		}
	}
}
echo "\n";
?>