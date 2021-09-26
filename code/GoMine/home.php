<?php
include 'pay.php';
include 'run.php';
include 'controller.php';
include 'input.php';

system('clear');

echo "\n";
$n = 0;


$batas = 0.0005;
while (true) {
	// postLogin($u, $url);
	system('clear');
	out(getTime(), "[{$n}] ⛏  Refresh...", 1);	
	$doge = user_agent($ua, $ck['doge'], $acpDoge);
	$trx = user_agent($ua, $ck['trx'], $acpTrx);

	$setDoge = setPay($doge, $uri['doge']);
	$setTrx = setPay($trx, $uri['trx']);

	$dtPayDg = getData($setDoge);
	$dtPayTn = getData($setTrx);


	$t1 = getTimeArr();

	$n++;

	$pPerDg = floor((0.0005 - $dtPayDg['var']) * 100 / 0.0005);
	$payPerDg = 100 - $pPerDg;

	// Trx
	$pPerTn = floor((0.0005 - $dtPayTn['var']) * 100 / 0.0005);
	$payPerTn = 100 - $pPerTn;


if($dtPayTn['var'] > $batas || $dtPayDg['var'] > $batas) {

	if($dtPayTn['var'] > $batas){
		out(getTime(), "Akan melakukan WD", 1);

		out(getTime(), "Kapasitas {$payPerTn} %", 2);
		out(getTime(), "Walet siap di Withdraw", 1);


		if($payPerTn > 1000) {
			$batas = $batas *10;
		}

		if($payPerTn < 1000 && $payPerTn > 200) {
			$batas = $batas * 2;
		}

		$uri['trx']['data'] = "amount={$batas}&fpay=";

		out(getTime(), "Walet   \033[1;33m{$dtPayTn['balance']}\033[1;31m {$dtPayTn['coin']}", 1);
		out(getTime(), "Withdrawl \033[1;33m{$batas}\033[1;31m {$dtPayTn['coin']}", 1);
		$ms = wd($trx, $uri['trx']);

		if($ms[0] == 'red') { 
			out(getTime(), "\033[1;31m{$ms[1]}", 10);
		} else {
			out(getTime(), "\033[1;32m{$ms[1]}", 10);
		}

		$batas = 0.0005;
		system('clear');
	}

	if($dtPayDg['var'] > $batas){
		out(getTime(), "Kapasitas {$payPerDg} %", 2);
		out(getTime(), "Walet siap di Withdraw", 1);
		if($payPerDg > 1000) {
			$batas = $batas * 5;
		}

		if($payPerDg < 1000 && $payPerDg > 200) {
			$batas = $batas * 2;
		}

		$uri['doge']['data'] = "amount={$batas}&fpay=";

		out(getTime(), "Walet   \033[1;33m{$dtPayDg['balance']}\033[1;31m {$dtPayDg['coin']}", 1);
		out(getTime(), "Withdrawl \033[1;33m{$batas}\033[1;31m {$dtPayDg['coin']}", 1);
		$ms = wd($doge, $uri['doge']);

		if($ms[0] == 'red') { 
			out(getTime(), "\033[1;31m{$ms[1]}", 10);
		} else {
			out(getTime(), "\033[1;32m{$ms[1]}", 10);
		}

		$batas = 0.0005;
		system('clear');
	}
	
} else if($dtPayDg['balance'] != 0 || $dtPayTn['balance'] != 0) {
	if($dtPayDg['balance'] != 0 ) {
		$dt['doge'] = setDataMiner($doge, $uri['doge']['miner']);
		if($dt['doge']['verify'] == true) {
			$dt['doge']['balance'] = $dtPayDg['balance'];
			verifyMiner($doge, $dt['doge'], $payPerDg, $uri['doge']);
		}
	} else {
		out(getTime(), "\033[1;33mKunjungi {$uri['doge']['host']}", 1);
	}



	if($dtPayTn['balance'] != 0) {
		$dt['trx'] = setDataMiner($trx, $uri['trx']['miner']);

		if($dt['trx']['verify'] == true) {
			$dt['trx']['balance'] = $dtPayTn['balance'];
			verifyMiner($trx, $dt['trx'], $payPerTn, $uri['trx']);
		}
	} else {
		out(getTime(), "\033[1;33mKunjungi {$uri['trx']['host']}", 1);
		}

		$slTrx = setSlwall($trx, $uri['trx']['ptc']);
		$slDoge = setSlwall($doge, $uri['doge']['ptc']);
		out(getTime(), "\033[1;33mKunjungi {$uri['doge']['host']}", 1);
		out(getTime(), "\033[1;33mKunjungi {$uri['trx']['host']}", 1);
		out(getTime(), "\033[1;33mslwall  TRX: {$slTrx}", 1);
		out(getTime(), "\033[1;33mslwall Doge: {$slDoge}", 1);
		for($i = 50; $i > -1; $i--){
				echo " \r";
				echo getTime();
				echo " [{$i}] Reload..!";
				echo " \r";
				sleep(1);
			}
			echo "\n";
	// print_r($dt);

	
/**




	exit();
	if($dt['verify'] == true) { 
		out(getTime(), "\033[1;33m{$dt['msg']}", 1);
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
		 

	} else {

			// if($clock[0] == "00" && $clock[1] == "00" && $clock[2] == "00"){
	// 	echo "\n";
	// 	echo "Waktu selesai 00:00:00\n"; sleep(1);
	// 	echo "Cek Link ->\n";sleep(1);
	// 	echo "https://gomine.xyz/user/home\n";
	// 	exit();
	// }
		out(getTime(), "\033[1;33m{$dt['msg']}", 1);
		out(getTime(), "Waktu selesai 00:00:00", 1);
		out(getTime(), "\033[1;34mGet link", 1);
		out(getTime(), "\033[1;31m{$url['home']}", 1);
		}
		**/
	} else  {
		out(getTime(), "Kunjungi link", 1);
		out(getTime(), "\033[1;33mKunjungi {$uri['doge']['host']}", 1);
		out(getTime(), "\033[1;33mKunjungi {$uri['trx']['host']}", 1);
		out(getTime(), "Reload . . . ", 10);
	}




	if($t1[0] == '04' || $t1[0] == '05' ) { 
		$uri['trx']['ptc'] = getLinkPtc($trx, $uri['trx']['ptc']);
		$setPTC = setPtc($trx, $uri['trx']['ptc']);
		exePTC($setPTC, $trx);
		$uri['trx']['ptc'] = "https://gomine.xyz/user/ptc";
	} else {
		out(getTime(), "skip PTC", 1);
	}

}
echo "\n";
?>