<?php
// kumpulan link


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

// exit();
// DANGER'>
// SUCCESS'>
$rn = explode("MINER: <b class='text-", $result)[1];
$rn1 = explode('</b>', $rn)[0];
$run = explode("'>", $rn1);

// var_dump($run);

// exit();
$ver = true;

if($run[1] == "STOPPED") {
	$ver = false;

	$bl = 0;
	$sec = 0;
} else { 
	$ver = true;

	$b = explode('var sec = ', $result)[1];
	$bl = explode(';', $b)[0];
	$s = explode('sec = sec + ', $result)[1];
	$sec = explode(';', $s)[0];


}
if($bl == 0) {
	$user = "null";
} else { 
	$us = explode('<h3>USER: ', $result)[1];
	$user = explode('<br>', $us)[0];
	// print_r(gettype($bl));

}
/**
*
var sec = 7.5095E-5;
	var a = setInterval(function () {
		sec = sec + 1.15E-8;
**/
// TVjHnGtvJwksB3YxFeW7NGq3nhBqi7jZ9T<br>
//<b style="font-weight: 600;">
// </b> Power: 5Kh/s | Earning:  0.00000012  TRX/sec | Daily: 0.010 TRX</b>
// <br>
	$data = [
		'verify' => $ver,
		'msg' => $run[1],
		'wl' => $user,
		'bl' => $bl,
		'sec' => $sec
];
	
curl_close($ch);
return $data;
}
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

function getTime() {
	// set the default timezone to use.
	date_default_timezone_set('UTC');
	$timezone  = -4; //(GMT -4:00) waktu server
	$end = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
	// echo gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$clock = explode(':', $end);

	
	return "\033[1;31m[\033[0m{$end}\033[1;31m]\033[0;37m";
} // end function getTime


function out($tm, $text, $sl){
	echo $tm." ";
	echo $text."\n";
	sleep($sl);
}

function getLinkPtc($u, $url){
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

    $link = "";
    if($info['http_code'] == 200) {
    	$get = explode('src="https://skippyads.com/', $result)[1];
	    $link = explode('"></iframe>', $get)[0];
	
    }
    
    curl_close($ch);
    return "https://skippyads.com/".$link;
}

function setPtc($u, $url) {
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
    // <h3><a href="http://skippyads.com/?page=click&p=iriyFwfnGmx&i=316&u=8692" target="_blank" >NG PTP</a>   </h3>
    $getLink = explode('<h3><a href="', $result);
    $data = array();
    for($i = 0; $i < count($getLink) - 1; $i++) {
    	$num = $i+1;
    	$clear[$num] = preg_replace('/\s+/', '', $getLink[$num]);
    	$j[$num] = explode('</p></div></div>', $clear[$num])[0];

    	$UT[$num] = explode('</a></h3>', $j[$num])[0];
    	$uri[$num] = explode('"target="_blank">', $UT[$num]);

    	$tm[$num] = explode('<iclass="fafa-clock-o"></i>0:', $j[$num])[1];
    	$timer[$num] = explode('<iclass=', $tm[$num])[0];

    	$cl[$num] = explode('role="button">', $j[$num])[1];
    	$claim[$num] = explode('TRX</a>', $cl[$num])[0];

    	$ds[$num] = explode('<pclass="desc">', $j[$num])[1];

    	$data[$i] = [
    		'uri' => $uri[$num][0],
    		'title' => $uri[$num][1],
    		'tm' => $timer[$num],
    		'claim' => $claim[$num],
    		'desk' => $ds[$num]
    	];
    }
    
	$info = curl_getinfo($ch);
    
    curl_close($ch);
    return $data;
}


function getPtc($u, $url){
	
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

    $sUri = explode('iframe.setAttribute("src", "', $result)[1];
    $uri = explode('");', $sUri)[0];

    // print_r($result);
    $str = "http://skippyads.com/".$uri;
    curl_close($ch);
    return $str;
}

function verifyPtc($u, $url){
	
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

    $s = explode('<body>', $result)[1];
    $msg = explode('</body>', $s)[0];

    // print_r($result);
    // $str = "http://skippyads.com/".$uri;
    curl_close($ch);
    return $msg;
}

function exePTC($set, $u){ 

	out(getTime(), "Sisa ".count($set)." PTC", 1);
	// echo "Sisa ".count($set)." PTC";
	// echo "\n";
	if(count($set) > 0){
		if($set[0] != null){
			out(getTime(), "Claim ".$set[0]['title'], 2);
			// echo "\nClaim ".$set[0]['title'];
			// sleep(2);
			out(getTime(), "Balace : ".$set[0]['claim']." TRX", 2);
			// echo "Balace : ".$set[0]['claim']." TRX";
			// sleep(2);
			// echo "\nDesk : ".$set[0]['desk'];
			// sleep(2);
			out(getTime(), "Timer ".$set[0]['tm']." Second", 1);
			// echo "\nTimer ".$set[0]['tm']." Second";
			// sleep(1);
			$ur = getPtc($u, $set[0]['uri']);
			// echo "\n";
			for($i = $set[0]['tm']; $i > -1; $i--){
				echo " \r";
				echo getTime();
				echo " [{$i}] Get";
				echo " \r";
				sleep(1);
			}
			echo "\n";
			$ms = verifyPtc($u, $ur);
			$msg = preg_replace('/\s+/', '', $ms);
			out(getTime(), $msg, 2);
			// print_r($ms); 
			// sleep(2);
		} else { 
			out(getTime(), "PTC udah tidak tersedia", 2);
		 }
	} // end if 
	else {
		sleep(5);
		system('clear');
	}

} // end function




?>