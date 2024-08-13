<?php
session_start();
error_reporting(0);
require_once("dbkn.php");
$logPath = "log/kenyasafari/thanku_kenya_".date("Ymd").".txt";
error_log("called url: ".date('Ymd His')." : ".$_SERVER['REQUEST_URI']."\n", 3, $logPath);

$st = $_GET['st'];
if($st!='')
{
$_SESSION['lang'] = 'en';	
}
//$c = $_GET['c'];
if($_GET['st']=='true')
{
$msg="You have successfully subscribed to our service.please click below to login.";
//header( "refresh:5;url=index.php?success=true" );
}
else
{
//$msg="You have not subscribed for our service.Please click on below button to retry.";
}


include "header_enscke.php"; 		
?>

<section class="breadcrumb-area contact">
	</section>
	<!-- Breadcrumb Area End -->

	<!-- Contact Area Start -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-12">
					<div class="contact-area">
						<div class="row">
							<div class="col-lg-12">
							   <h2><?php  echo $msg;?></h2>
								<div class="left-area">
							<center>
						
							<!--	<button onclick="location.href = 'https://www.esports.playme.in.net/register_enscke.php'"  type="submit" class="mybtn2" name="contact_us" value="contact_us">Register</button> -->
								<button onclick="location.href = 'https://www.esports.playme.in.net/login_enscke.php'"  type="submit" class="mybtn2" name="contact_us" value="contact_us">Login</button>

							</center>	
								</div>
								
							</div>
						</div>
						<div class="row justify-content-between align-items-center">
							
							<div class="col-lg-5">
								<div class="right-area">
									<div class="top-content">
										<!-- <h4>Have questions?</h4> -->
										
										
									</div>
									<div class="bottom-content">
										
										<!--<div class="single-info">
											<div class="icon">
												<i class="fas fa-phone"></i>
											</div>
											<div class="content">
												<h4>Email Us</h4>
												<p>+1 (987) 664-32-11</p>
												<p>+1 (987) 694-32-11</p>
											</div>
										</div> -->
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact Area End -->



<?php include "footer_enscke.php"; ?>	