<?php
// kumpulan link







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

	// var_dump($url);
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

    $link = "";
    if($info['http_code'] == 200) {
    	$get = explode('src="https://skippyads.com/', $result)[1];
	    $link = explode('"></iframe>', $get)[0];
	
    }
    
    curl_close($ch);
    return "https://skippyads.com/".$link;
}

function setSlwall($u, $url){
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

    // print_r($result);
    // frameborder="0" src="https://bitswall.net/offerwall/gzrur79r7tfbcsowvje5a5vcwdh0z5/8967"></iframe>

    $lk = explode('frameborder="0" src="https://bitswall.net/', $result)[1];
    $link = explode('"></iframe>', $lk)[0];
    $links = "https://bitswall.net/".$link;
    // var_dump($links);

    // exit();

    curl_close($ch);
    return $links;
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
    $ht = curl_getinfo($ch)['http_code'];

    if($ht == 200 ) { 
	    $sUri = explode('iframe.setAttribute("src", "', $result)[1];
	    $uri = explode('");', $sUri)[0];

	    // var_dump($ht);

	    // exit();
	    $str = "http://skippyads.com/".$uri;
	} else {
		$str = "";
	}
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
    
    var_dump($result);

    $s = explode('<body>', $result)[1];
    $msg = explode('</body>', $s)[0];

    // print_r($result);
    // $str = "http://skippyads.com/".$uri;
    curl_close($ch);
    return $msg;
}

function exePTC($set, $u){ 
	out(getTime(), "Sisa ".count($set)." PTC", 1);

	if(count($set) > 0){
		if($set[0] != null){
			out(getTime(), "Claim ".$set[0]['title'], 2);
			out(getTime(), "Balace : ".$set[0]['claim']." TRX", 2);
			out(getTime(), "Timer ".$set[0]['tm']." Second", 1);

			$ur = getPtc($u, $set[0]['uri']);

			if($ur != "" || $ur != null ) { 
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
		} else {
			$msg = "not completed";
		}
			
			out(getTime(), $msg, 2);

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