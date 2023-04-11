<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include '../config/database.php';
include '../config/config.php';
$msg = ''; 





  

if(isset($_POST['submit'])){

 

$fname = $link->real_escape_string($_POST['firstname']);
$lname = $link->real_escape_string($_POST['lastname']);
$pwd = $link->real_escape_string($_POST['password']);
$email = $link->real_escape_string($_POST['email']);
$phone = $link->real_escape_string($_POST['phone']);
$bdate =$link->real_escape_string( $_POST['bdate']);

$gender = $link->real_escape_string($_POST['gender']);
$address = $link->real_escape_string( $_POST['address']);
$city = $link->real_escape_string($_POST['city']);
$country = $link->real_escape_string($_POST['country']);
$state = $link->real_escape_string($_POST['state']);
$zipcode = $link->real_escape_string($_POST['zipcode']);
$notification = $link->real_escape_string((int) $_POST['notification']);
$nbalance = $link->real_escape_string($_POST['nbalance']);
$inbalance = $link->real_escape_string($_POST['inbalance']);
$bname = $link->real_escape_string($_POST['bname']);

$utype = $link->real_escape_string($_POST['utype']);
$pin = $link->real_escape_string( $_POST['pin']);
$image = $_FILES['image']['name'];
$target = "uploads/".basename($image);



//account number generation...
$account ='29176573827673930057000463891234567890';
$account = str_shuffle($account);
$account = substr($account,0, 10);

$balance = '';
$mobile_hash = '';
$active = '';
$status = '';
$session = '';
$is_mobile = '';

//imf code generation...
$imf ='827673930057000463891234567890';
$imf = str_shuffle($imf);
$imf = substr($imf,0, 4);


//cot code generation...
$cot ='76573827673930057000463891234567890';
$cot = str_shuffle($cot);
$cot = substr($cot,0, 4);


//ipn code generation...
$ipn ='3827673930057000463891234567890';
$ipn = str_shuffle($ipn);
$ipn = substr($ipn,0, 4);



$sql = "SELECT email FROM tbl_users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $msg = 'Email already exist, please try another email.';

}else{

$sql1 = "INSERT INTO tbl_users (fname, lname, pwd, email, phone, gender, is_mobile, mobile_hash, utype, pics, bdate,acctno,active,status,pin,session,balance,address,city,state,zipcode,notification,nbalance,inbalance,bname,country,ipn,imf,cot)

        VALUES ('$fname', '$lname', '$pwd', '$email', '$phone', '$gender', '$is_mobile','$mobile_hash', '$utype', '$image', '$bdate','$account','$active','$status','$pin','$session','$balance','$address','$city','$state','$zipcode','$notification','$nbalance','$inbalance','$bname','$country','$ipn','$imf','$cot')";

         if(mysqli_query($link, $sql1)){

move_uploaded_file($_FILES['image']['tmp_name'], $target);
              
            $sid = "AC9185b4ce8863b866879b95016e04eb2d"; // Your Account SID from www.twilio.com/console
            $token = "da9cac499c28547ef60eecf3583cb7fa"; // Your Auth Token from www.twilio.com/console

            $client = new Twilio\Rest\Client($sid, $token);

            $smsbody = 'Dear: '.$fname.' - Account Number: ' .$account.'!
                 
            This is to inform you that your Account '.$account.', is registered successfully with '.$name.' and currently  not active. We will soon contact you once its activated. In case you need any further clarification for the same, please do get in touch with your Branch';




            $message = $client->messages->create(
                    '+' . $phone, array(
                'from' => '+12018842686', // From a valid Twilio number
                'body' => $smsbody
                    )
            );


            //send email




require_once "PHPMailer/PHPMailer.php";
require_once 'PHPMailer/Exception.php';


//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = $emaila;
$mail->FromName = $name;

//To address and name
$mail->addAddress($email, $fname);
$mail->addAddress("$email"); //Recipient name is optional

//Address to which recipient will reply

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Account Details";

$mail->Body = '<div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">

<div class="be_logo" style="float: left;"> <img src="https://paultechgist.pro/paragons/secure/login/logo.png"> </div>

<div class="be_user" style="float: right"> <p>Dear: '.$fname.' - Account Number: ' .$account.'</p> </div> 

<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">

<h1>A/C: '.$account.' is created</h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> <p style="line-height: 25px;"> This is to inform you that your Account # <strong>'.$account.'</strong> 

is registered successfully with '.$name.' and currently  not active. We will soon contact you once it gets activated. </p> <div style="margin-top: 25px;">

<p>In case you need any further clarification for the same, please do get in touch with your Branch.</p> </div> </div> <div class="be_footer">
<div style="border-bottom: 1px solid #ccc;"></div> <p> Please do not reply to this email. Emails sent to this address will not be answered. 
Copyright ©2019 '.$account.'. </p> </div> </div> </div>';

if($mail->send()) {
  
   echo "Your Account has been created successfully, You will receive a notification soon !";
}
               
           else{
                echo "Something went wrong. Please try again later!";
            }
        
    }else{
        echo "Cannot Register!";
    }
}
}











?>