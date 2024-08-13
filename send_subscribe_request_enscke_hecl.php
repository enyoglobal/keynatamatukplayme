<?php
session_start();
error_reporting(0);
require_once("dbkn.php");
$logPath = "log/kenyasafari/clickflowsend_subscribe_request_scke_he_".date("Ymd").".txt";
error_log("called url: ".date('Ymd His').": ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

$lastid = $_GET['lastid'];
$msisdn = $_GET['msisdn'];



/////////////////////////////////////////////////////////////////////////////////////////
$Query="update tbl_wapidentify_playme_enscke set msisdn=$msisdn where id=$lastid";
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);	
		if(!mysqli_query($con1,$Query))
		  {		
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////
$qry = "select id from jwgetmee.dnd_kenya_safaricom where msisdn = '$msisdn'";
	//echo $qry;
	$result = mysqli_query($con1,$qry);
	if (!$result) {
	  echo mysqli_error();
	}
	$isSubscribed = mysqli_num_rows($result);
	if($isSubscribed > 0) 
	{
     header('Location:http://google.com');
	exit;
	}
///////////////////////


///////////////////////
$qry = "select id from jwgetmee.pending_delete_no_playme_enscke where msisdn = '$msisdn'";
	//echo $qry;
	$result = mysqli_query($con1,$qry);
	if (!$result) {
	  echo mysqli_error();
	}
	$isSubscribed = mysqli_num_rows($result);
	if($isSubscribed > 0) 
	{
     header('Location:http://google.com');
	exit;
	}
///////////////////////


///////////////////////
$qry = "select id from lkgetme.pending_delete_no_cookery_kesc where msisdn = '$msisdn'";
	//echo $qry;
	$result = mysqli_query($con1,$qry);
	if (!$result) {
	  echo mysqli_error();
	}
	$isSubscribed = mysqli_num_rows($result);
	if($isSubscribed > 0) 
	{
     header('Location:http://google.com');
	exit;
	}
///////////////////////



 $Query1 = "select token from tbl_access_token_playme_enscke order by id desc limit 1";
	 $result=mysqli_query($con1,$Query1);
	 while($mis_array=mysqli_fetch_assoc($result)) {			
			$access_token = $mis_array['token'];
		}
	$_SESSION['msisdn'] =$msisdn;	
	error_log("access_token:" . date('Ymd His') . ": " . $access_token . "\n", 3, $logPath);
	error_log("Queryt:" . date('Ymd His') . ": " . $Query1 . "\n", 3, $logPath);
	error_log("sessionmsisdn:" . date('Ymd His') . ": " .$_SESSION['msisdn']. "\n", 3, $logPath);
    if (!mysqli_query($con1, $Query1)) {
        error_log("Error description:" . date('Ymd His') . ": " . mysqli_error($con1) . "\n", 3, $logPath);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://hesdp.safaricom.com:1212/api/v1/wapActivate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\t\"msisdn\":\"$msisdn\",\n\t\"offerCode\":\"001023834313\",\n\t\"CpId\":\"238\",\n\t\"callBackUrl\":\"http://139.59.3.239:8080/Games24/playme/smartfren/kenya\"\n}");

$headers = array();
$headers[] = 'X-Api-Auth-Token: Bearer  '.$access_token.'';
$headers[] = 'Accept-Encoding: application/json';
$headers[] = 'Accept-Language: EN';
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-App: ussd';
$headers[] = 'X-Correlation-Conversation-Id: '.$lastid.'';
$headers[] = 'X-Messageid: '.$lastid.'';
$headers[] = 'X-Source-Division: DIT';
$headers[] = 'X-Source-Countrycode: KE';
$headers[] = 'X-Source-Operator: Safaricom';
$headers[] = 'X-Source-System: web-portal';
$headers[] = 'X-Source-Timestamp: '.$lastid.'';
$headers[] = 'X-Version: 1.0.0';
$headers[] = 'Authorization: Basic ZGV2X3VzZXI6ZGV2X3Bhc3N3b3Jk';
$headers[] = 'Cookie: visid_incap_2609422=zfDh6cR/QYCUfhN+hxtX76uJNWMAAAAAQUIPAAAAAABwBRv42BvL0s0eIAxONMXo';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

error_log(" ch:".date('Ymd His').": " .$ch."\n", 3, $logPath);
curl_close($ch);
error_log(" Response:".date('Ymd His').": " .$result."\n", 3, $logPath);

$data = json_decode($result,false);
$arr = (object) $data;
$status =$arr->body->status;
$statusCode = $arr->body->statusCode;
$description = $arr->body->description;
$name1 = $arr->body->data[0]->name;
$value1 = $arr->body->data[0]->value;
$name2 = $arr->body->data[1]->name;
$value2 = $arr->body->data[1]->value;

$urln=$value2.'?sessionID='.$value1;

/*
if($description=="Thank you for your request, but you have already subscribed to 23161_PlayMeEsport_ksh15_PerDay service." || $value1=="null"){
	 header("Location:https://www.esports.playme.in.net/thankyouenscke.php?st=true#");	 
	  exit; 
	
}
*/

error_log(date('Ymd His')." : description:".$description."\n", 3, $logPath);
error_log(date('Ymd His')." : urln:".$urln."\n", 3, $logPath);
error_log(date('Ymd His')." : name1:".$name1."\n", 3, $logPath);
error_log(date('Ymd His')." : value1:".$value1."\n", 3, $logPath);
error_log(date('Ymd His')." : name2:".$name2."\n", 3, $logPath);
error_log(date('Ymd His')." : value2:".$value2."\n", 3, $logPath);

///////////////////////////send to session id/////////////////////////////////////////////

//https://d3jg6a1opmqxqe.cloudfront.net/consent?sessionId=%20

$urlcalledforredirect='https://safaricom.com/consent?sessionId='.$value1.'';

/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://safaricom.com/consent?sessionId='.$value1.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    ': ',
    'Cookie: visid_incap_2353962=2hr9XVhNTc+7Zg4eYeGVAwucVGQAAAAAQUIPAAAAAACKUte4CAcd2f7yLk0rKb/r; nlbi_2353962=kgdfcn6EGGVECLleq+f5rwAAAABi08lfESNAaw9d4UNL+TAm; incap_ses_416_2353962=mcFAWbKxvSeeAj4nTu7FBQycVGQAAAAAShpcau9HPvky/3hTmVDPxw=='
  ),
));

$response2 = curl_exec($curl);

curl_close($curl);  */
//echo $response2;

//error_log(" response2:".date('Ymd His').": " .$response2."\n", 3, $logPath);
error_log(" urlcalledforredirect:".date('Ymd His').": " .$urlcalledforredirect."\n", 3, $logPath);

header('Location:https://safaricom.com/consent?sessionId='.$value1.'');
exit;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*

if($status=="0")
{
	header("Location:errormessage_scke.php?req=sub&status=$status&statusCode=$statusCode&description=$description");
	exit;
}
else
{
	if($description=="")
		{
			$description = $arr->message;			
		}		
	header("Location:errormessage_scke.php?status=$status&statusCode=$statusCode&description=$description");
	exit;
}

*/
///////////////////////////////////////////////////////////////////////////////////////////
?>

