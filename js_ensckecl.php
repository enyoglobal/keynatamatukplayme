<?php
session_start();
error_reporting(0);
$logPath = "log/kenyasafari/clickflowjs_scke_".date("Ymd").".txt";
error_log("called url: ".date('Ymd His').": ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
$lastid = $_GET['lastid'];
$req2 = $_GET['req2'];
error_log(date('Ymd His')." req2 =$req2\n", 3, $logPath);

?>
<html>
<script type="text/javascript">
    var xhttp;
    xhttp = new XMLHttpRequest();
    var token="<?php echo $lastid;?>";
    var req2="<?php echo $req2;?>";
	//alert(token);

    console.log("1");
    xhttp.open('GET', 'http://header.safaricombeats.co.ke?token=' + token, true);
	//94.232.168.188:8080
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            sReadyState = this.readyState;
            sStatus = this.status;
            var xml = xhttp.responseText;
			//alert(xml);
			let encoded = encodeURI(xml);
			//alert(encoded);
window.location.href = 'https://www.esports.playme.in.net/he_ensckecl.php?req2='+req2+'&lastid='+token+'&xml='+encoded;
            // postValue(xml);
        }
    };
    xhttp.onerror = function (e) {
        document.location.href = 'http://safaricom.gamesclub.co.ke/?msisdn=&source=' + source + '&clickid=' + clickid + '&agencyname=' + agencyname + '&directmsisdn=' + directMSISDN + '&deviceid=' + deviceid;
    }
    xhttp.send();
    console.log("6");
</script>


</html>