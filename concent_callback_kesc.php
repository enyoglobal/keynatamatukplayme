<?php
session_start();
error_reporting(0);
require_once("dbkn.php");
$logPath = "log/kenyasafari/notification_securedng_".date("Ymd").".txt";
error_log(date('Ymd His')." : requested url:".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

$json = file_get_contents('php://input');
error_log(date('Ymd His')." : json:".$json."\n", 3, $logPath);
$data = json_decode($json);
$msisdn=$data->msisdn;
$action=$data->action;
$service=$data->service;
$offerCode=$data->offerCode;
$scheme=$data->scheme;
$timestamp=$data->timestamp;
$source=$data->source;
$trxID=$data->trxID;



/////////////////////////
$qrycheck = "select subid as subid,pubid as pubid,campid as campid from tbl_wapidentify_playme_enscke where id=$trxID";		
	$TotalActiveBaseResultcheck=mysqli_query($con1,$qrycheck);
	while($mis_array=mysqli_fetch_assoc($TotalActiveBaseResultcheck)) {
		$subid = $mis_array['subid'];
		$pubid = $mis_array['pubid'];
		$campid = $mis_array['campid'];
	}
/////////////////////////

/////////////////////////
$Query="update tbl_wapidentify_playme_enscke set msisdn='".$msisdn."' where id=".$trxID;
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);
	$result=mysqli_query($con1,$Query);
	error_log("result:".date('Ymd His').": ". $result."\n", 3, $logPath);
///////////////////////////

$Query="insert into securednotificationkenyaplayme(entrydate,msisdn,activation,productID,description,timestamp,trxId,subid,pubid,campid) values (now(),'$msisdn','$action','$offerCode','$source','$timestamp',$trxID,'$subid','$pubid','$campid')";	
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
//echo "Successfully Received";
//////////////////////////////////////////////////////////sending for payment///////////////////////////
error_log("access_token:" . date('Ymd His') . ": " . $msisdn . "\n", 3, $logPath);
error_log("Queryt:" . date('Ymd His') . ": " . $lastid . "\n", 3, $logPath);
//header("Location:send_subscribe_request_kn_hecl_aftersecured.php?msisdn=$msisdn&lastid=$lastid");
//exit;
/////////////////////////////////////////calling activate api from here starts
///////////////////////////////////////////////////////////////////////////
/*
				$url1="http://www.esports.playme.in.net/send_subscribe_request_kn_hecl_aftersecured.php?msisdn=$msisdn&lastid=$trxID";
		error_log("Called url=".date('Ymd His')."".$url1."\n", 3, $logPath);
		$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$url1);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				$output=curl_exec($ch);
				curl_close($ch);
			error_log("Called url output=".date('Ymd His')."".$output."\n", 3, $logPath);
					
					error_log("final view:".date('Ymd His').": op we recieve $output \n", 3, $logPath);					

$dataresponse='{"status":"success","statusCode":"200","description":"Activation request received"}'	;		
//echo {"status":"success","statusCode":"200","description":"Activation request received"};
error_log("dataresponse:" . date('Ymd His') . ": " . $dataresponse . "\n", 3, $logPath);
echo $dataresponse;

*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////



?>