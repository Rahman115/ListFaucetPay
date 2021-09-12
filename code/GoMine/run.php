<?php
system('clear');
// https://gomine.xyz/user/ptc
// http://skippyads.com/?page=verify&p=iriyFwfnGmx&i=328&u=8692&t=ac02a50fd8293df96cdca0901e4f16af
// <body> Done</body>

// cookie : PHPSESSID=v538mnbsc4uhuk2r9rmn0ak397; cxcc=ID; _ga=GA1.2.1737720379.1631402313; _gid=GA1.2.1339411939.1631402313
// http://skippyads.com/?page=click&p=iriyFwfnGmx&i=329&u=8692
// iframe.setAttribute("src", "?page=verify&p=iriyFwfnGmx&i=329&u=8692&t=215887647ac0a0b4cbb3e2b8f620726c");

// kumpulan link
$urlPtc = [
	'ptc' => "https://skippyads.com/?page=wall&p=iriyFwfnGmx&u=8692",
	'get' => "http://skippyads.com/?page=click&p=iriyFwfnGmx&i=329&u=8692",
	'verify' => "http://skippyads.com/?page=verify&p=iriyFwfnGmx&i=328&u=8692&t=ac02a50fd8293df96cdca0901e4f16af"
];


$user = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:92.0) Gecko/20100101 Firefox/92.0";
$cookie = "PHPSESSID=v538mnbsc4uhuk2r9rmn0ak397; cxcc=ID; _ga=GA1.2.1737720379.1631402313; _gid=GA1.2.1339411939.1631402313";

$u = [
'User-Agent: '.$user,
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Cookie: '.$cookie
];

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


while(true){ 
	system('clear');
$set = setPtc($u, $urlPtc['ptc']);
echo "Sisa ".count($set)." PTC";
echo "\n";
	if(count($set) > 0){ 
		if($set[0] != null){
			echo "\nClaim ".$set[0]['title'];
			sleep(2);
			echo "\nBalace : ".$set[0]['claim']." TRX";
			sleep(2);
			// echo "\nDesk : ".$set[0]['desk'];
			// sleep(2);
			echo "\nTimer ".$set[0]['tm']." Second";
			sleep(1);
			$ur = getPtc($u, $set[0]['uri']);
			echo "\n";
			for($i = $set[0]['tm']; $i > -1; $i--){
					echo " \r";
					echo "[{$i}] Get";
					sleep(1);
				}
			$ms = verifyPtc($u, $ur);
			print_r($ms); sleep(2);	
		} else { exit(); }

	echo "\n";
	} else { exit(); }
	echo "Reload...";
	sleep(5);
} // end while




?>