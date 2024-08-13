<?php
session_start();
error_reporting(0);
require_once("dbkn.php");
$logPath = "log/kenyasafari/clickflowhe_scke_".date("Ymd").".txt";
error_log("called url: ".date('Ymd His').": ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
$lastid = $_GET['lastid'];
$req2 = $_GET['req2'];
$he_response = $_GET['xml'];
////////////////////////////
error_log(date('Ymd His')." he_response before ns0 =$he_response\n", 3, $logPath);
error_log(date('Ymd His')." req2 =$req2\n", 3, $logPath);
$he_response = str_ireplace(['ns0:', 'SOAP:'], '', $he_response);
error_log(date('Ymd His')." he_response after ns0=$he_response\n", 3, $logPath);
$xml = simplexml_load_string($he_response);
foreach ($xml->xpath('//ResponseMsg') as $item)
{
    //print_r($item);
}
//echo "ResponseMsg=".$item;
//echo "<br>";
if($item=="Success")
{
$he_response = str_ireplace(['ns1:', 'SOAP:'], '', $he_response);
error_log(date('Ymd His')." he_response after ns1 =$he_response\n", 3, $logPath);
$xml1 = simplexml_load_string($he_response);
foreach ($xml1->xpath('//MsisdnHash') as $msisdn)
{
    //print_r($msisdn);
}	
}

if($item=="Success" && $req2=="promohe1")
{
	header("Location:send_subscribe_request_enscke_hecl.php?msisdn=$msisdn&lastid=$lastid");
	exit;
}
else if($item=="Success" && $req2=="promohe")
{
	header("Location:lp_he_ensckecl.php?msisdn=$msisdn&lastid=$lastid");
	exit;
}else{		
	header("Location:http://www.esports.playme.in.net/errormessage_enscke.php?description=Please turn off your WiFi and switch to your mobile data, then try again.");
	exit;
}

?>

