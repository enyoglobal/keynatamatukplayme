<?php
session_start();
error_reporting(0);
require_once("dbkn.php");
$logPath = "log/kenyasafari/index_".date("Ymd").".txt";
error_log("requesturi:".date('Ymd His').": ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

$req=$_GET['req'];
$req2=$_GET['req2'];

error_log(date('Ymd His')." req2 =$req2\n", 3, $logPath);

if($_GET['success']=='true')
{
		$_SESSION['act'] ="1";	 
}
$OfferCode="001023833902";

////////////////////////////////////////for header file///////////////////////////////////////

foreach (getallheaders() as $name => $value) {
error_log("heder logs".date('Ymd His').":    header= ".$name."=".$value." \n", 3, $logPath);	
     
	if($name=='msisdn')
	{
		$msisdn1=$value;
error_log("heder logs".date('Ymd His').":    header= ".$msisdn1."=".$value." \n", 3, $logPath);
	}
}

///////////////////////////////////////////////////////////////////////////////////////////
/*

 $Query1 = "select count(id) as cnt from subbase_kenya_safaricom where date(entrydate)=date(now())";
 	$TotalActiveBaseResult=mysqli_query($con1,$Query1);
	while($mis_array=mysqli_fetch_assoc($TotalActiveBaseResult)) {
		$TotalActiveBaseHits = $mis_array['cnt'];
	}
	error_log("qry: ".date('Ymd His').": $qry \n", 3, $logPath);
error_log("qry output: ".date('Ymd His').": $TotalActiveBaseHits \n", 3, $logPath);

	$qrycheck = "select no as cnt from cappingkenya where campid=$campid and capcheck='globalcap'";		
	$TotalActiveBaseResultcheck=mysqli_query($con1,$qrycheck);
	while($mis_array=mysqli_fetch_assoc($TotalActiveBaseResultcheck)) {
		$TotalActiveBaseHitscheck = $mis_array['cnt'];
	}
	
	error_log("qrycheck: ".date('Ymd His').": $qrycheck \n", 3, $logPath);
error_log("qrycheck output: ".date('Ymd His').": $TotalActiveBaseHitscheck \n", 3, $logPath);
	
	if($TotalActiveBaseHits>=$TotalActiveBaseHitscheck)
	{
		error_log("stopped printed cap is over  successfully: ".date('Ymd His').": \n", 3, $logPath);
$RandomNumber = rand(0,1);
if($RandomNumber==0)
{
	header("Location:http://139.59.3.239/getme/pubrequest.php?subid=".$_GET['subid']."&id=1768");	 
	  exit;
}else if($RandomNumber==1)
{
	header("Location:http://139.59.3.239/getme/pubrequest.php?subid=".$_GET['subid']."&id=1771");	 
	  exit;
}
header("Location:https://www.google.com/");	 
	  exit;	
		 
	}


*/

//////////////////////////////////////////////////////////////////////////////////////////////////
if($_SESSION['act']!='1')
{
	$referID=date("ymdHisu");
	$Query="insert into tbl_wapidentify_playme_enscke (msisdn,referid,entrydate,pubid,subid,campid,serviceid) values ('$msisdn','".$referID."',now(),'".$_GET['pubid']."','".$_GET['subid']."','".$_GET['id']."','$OfferCode')";
	
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
	
	if(!mysqli_query($con1,$Query))
	{
	error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);
	}
	
	$lastid = mysqli_insert_id($con1);	
	
	error_log("lastid:".date('Ymd His').": ". $lastid."\n", 3, $logPath);
	
	if($_GET['req']=='lpoff')
    {		
	error_log("into lp block".date('Ymd His')." \n", 3, $logPath);		
	
	header("Location:js_scke.php?lastid=$lastid"); 
	exit;
     
    }
	
	if($_GET['req']=='heoff')
    {		
	error_log("into he block".date('Ymd His')." \n", 3, $logPath);		
		
	header("Location:js_scke.php?lastid=$lastid"); 
	exit;
     
    }

    if($_GET['req']=='hecoff')
    {		
	error_log("into he click flow block".date('Ymd His')." \n", 3, $logPath);		
		
	header("Location:js_sckecl.php?lastid=$lastid"); 
	exit;
     
    }	
	
	if($_GET['req2']=='promooff')
    {		
	error_log("into he block".date('Ymd His')." \n", 3, $logPath);		
		
	header("Location:js_enscke.php?lastid=$lastid&req2=$req2"); 
	exit;
     
    }
	
	if($_GET['req2']=='promoheoff')
    {		
	error_log("into he click flow block".date('Ymd His')." \n", 3, $logPath);		
		
	header("Location:js_ensckecl.php?lastid=$lastid&req2=$req2");
	exit;
     
    }


if($_GET['req2']=='promohe1off')
    {		
	error_log("into he click flow block".date('Ymd His')." \n", 3, $logPath);		
		
	header("Location:js_ensckecl.php?lastid=$lastid&req2=$req2");
	exit;
     
    }	
	

		if($_GET['req2']=='promosd')
    {		
	error_log("into upgstream promontional1 url".date('Ymd His')." \n", 3, $logPath);				
header("Location:https://ke-webfun.upp.st/KSD-KESAF-ENYO/PlayMe-001023834313-Daily-No-Web?trxID=$lastid");

exit;
     
    }
}
?>