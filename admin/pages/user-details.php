<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__.'/vendor/autoload.php';
if(isset($_SESSION['uid'])){
 
 
  include '../../config/database.php';
  include '../../config/config.php';
  
   include 'header.php';

  if(isset($_GET['email']) ){
  $email = $_GET['email'];
  }else{
   $email = $_GET['email'] = '0';
   $acct = $_GET['account'] = '0';  
  }
  $msg = "";

}
else{

    header("location:../pages/login.php");
}





  $sql= "SELECT * FROM tbl_users WHERE email = '$email'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

          $session = $row['session'];
          $fname =  $row['fname'];
          
          $lname =  $row['lname'];

          $bal =  $row['balance'];
          $account =  $row['acctno'];

        }
				  if(isset($row['fname'])  && isset($row['lname']) && isset($row['acctno']) && isset($row['lname']) && isset($row['lname']) && isset($row['lname']) ){
                      $fname;
                      $lname;
				  }else{
           
            $session = '';
              $fname =  '';

                $lname =  '';
          }
        
          
				  
        
      
      








  if(isset($_POST['fund']) &&  isset($_POST['type'])  &&  $_POST['type'] == 'Credit Fund'){
	
	
       
    $email =$link->real_escape_string( $_POST['email']);
    $status =$link->real_escape_string( $_POST['status']);
    $amount =$link->real_escape_string( $_POST['amount']);
    $description =$link->real_escape_string( $_POST['description']);
    $type = 'Credit';
     $com = '';
        $to="";
    $txndate = date("Y/m/d");
    $token ='1234567890';
      $token = str_shuffle($token);
       $token= substr($token,0, 8);  
      
    $sql1 = "INSERT INTO tbl_transaction (tx_no, tx_type, amount, date, description, to_accno, account, status,comments)
    
    VALUES ('$token', '$type', '$amount', '$txndate', '$description', '$to', '$account','$status','$com')";
    
    if (mysqli_query($link, $sql1)) {
        
         $sql = "UPDATE tbl_users SET balance= balance + $amount  WHERE email='$email'";
        mysqli_query($link, $sql);
        
       
        $msg = "Account Funded successfully!";
    } else {
        $msg = "Cannot Fund Account! ";
    }
    }


    if(isset($_POST['fund']) &&  isset($_POST['type'])  &&  $_POST['type'] == 'Debit Fund'){
	
	
      $account =$link->real_escape_string( $_POST['account']);
      $email =$link->real_escape_string( $_POST['email']);
      $status =$link->real_escape_string( $_POST['status']);
      $amount =$link->real_escape_string( $_POST['amount']);
      $description =$link->real_escape_string( $_POST['description']);
      $type = 'Debit';
      $com = '';
      $txndate = date("Y/m/d");
      $token ='1234567890';
        $token = str_shuffle($token);
         $token= substr($token,0, 8);
         $to="";
         
         $sql1 = "INSERT INTO tbl_transaction (tx_no, tx_type, amount, date, description, to_accno, account, status,comments) VALUES ('$token', '$type', '$amount', '$txndate', '$description', '$to', '$account','$status','$com')";
        
           
       if($bal < $amount){

        $msg = "User Account Balance is not sufficient!";
       }else{


      if (mysqli_query($link, $sql1)) {

        $sql = "UPDATE tbl_users SET balance= balance - $amount  WHERE email='$email'";
        mysqli_query($link, $sql);
          $msg = "Account Debited successfully!";
      } else {
          $msg = "Cannot Debit Account! ";
      }
      }
    }


  if(isset($_POST['activate'])){
	
	
    $email =$link->real_escape_string( $_POST['email']);
        
      
    $sql1 = "UPDATE tbl_users SET active='1' WHERE email='$email'";
    
    if (mysqli_query($link, $sql1)) {
        $msg = "Transfer activated successfully!";
    } else {
        $msg = "Cannot activate transfer! ";
    }
    }



    if(isset($_POST['deactivate'])){
	
	
      $email =$link->real_escape_string( $_POST['email']);
          
        
      $sql1 = "UPDATE tbl_users SET active='0' WHERE email='$email'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Transfer deactivated successfully!";
      } else {
          $msg = "Cannot deactivate transfer! ";
      }
      }
      
      
    
    if(isset($_POST['delete'])){
	
	
      $email =$link->real_escape_string( $_POST['email']);
          
        
      $sql1 = "DELETE FROM tbl_users  WHERE email='$email'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Account Deleted successfully!";
             header("location:https://3d_bank/admin/pages/users.php");
          
      } else {
          $msg = "Cannot delete Account! ";
      }
      }
    




      
  if(isset($_POST['verify'])){
	
	 $account =$link->real_escape_string( $_POST['account']);
      $fname =$link->real_escape_string( $_POST['fname']);
    $email =$link->real_escape_string( $_POST['email']);
        
      
    $sql1 = "UPDATE tbl_users SET status='1' WHERE email='$email'";
    
    if (mysqli_query($link, $sql1)) {
        
    
        
   
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

$mail->Subject = "Account Activation";

$mail->Body = '<div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">

<div class="be_logo" style="float: left;"> <img src="https://paultechgist.pro/paragons/secure/login/logo.png"> </div>

<div class="be_user" style="float: right"> <p>Dear: '.$fname.' - Account Number: ' .$account.'</p> </div> 

<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">

<h1>A/C: '.$account.' is now active</h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> <p style="line-height: 25px;"> This is to inform you that your Account # <strong>'.$account.'</strong> 

which was registered  with '.$name.' is now  active. You can now login with your credentials. </p> <div style="margin-top: 25px;">

<p>In case you need any further clarification for the same, please do get in touch with your Branch.</p> </div> </div> <div class="be_footer">
<div style="border-bottom: 1px solid #ccc;"></div> <p> Please do not reply to this email. Emails sent to this address will not be answered. 
Copyright ©2019 '.$account.'. </p> </div> </div> </div>';

if($mail->send()) {
  
    $msg =  "Account Verified Successfully !";
}
               
           else{
                $msg = "Something went wrong. Please try again later!";
            }
        
    }else{
        $msg = "Cannot Verify!";
    }
}
    



    if(isset($_POST['unverify'])){
	
	
      $email =$link->real_escape_string( $_POST['email']);
          
        
      $sql1 = "UPDATE tbl_users SET status='0' WHERE email='$email'";
      
      if (mysqli_query($link, $sql1)) {
        
        
         
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

$mail->Subject = "Account De-Activation";

$mail->Body = '<div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">

<div class="be_logo" style="float: left;"> <img src="https://paultechgist.pro/paragons/secure/login/logo.png"> </div>

<div class="be_user" style="float: right"> <p>Dear: '.$fname.' - Account Number: ' .$account.'</p> </div> 

<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">

<h1>A/C: '.$account.' is now De-Activated</h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> <p style="line-height: 25px;"> This is to inform you that your Account # <strong>'.$account.'</strong> 

which was registered  with '.$name.' has been deactivated for manual review. </p> <div style="margin-top: 25px;">

<p>In case you need any further clarification for the same, please do get in touch with your Branch.</p> </div> </div> <div class="be_footer">
<div style="border-bottom: 1px solid #ccc;"></div> <p> Please do not reply to this email. Emails sent to this address will not be answered. 
Copyright ©2019 '.$account.'. </p> </div> </div> </div>';

if($mail->send()) {
  
    $msg =  "Account UnVerified Successfully !";
}
               
           else{
                $msg = "Something went wrong. Please try again later!";
            }
        
    }else{
        $msg = "Cannot UnVerify!";
    }
}





      if(isset($_POST['acone'])){
	
	
        $email =$link->real_escape_string( $_POST['email']);
            
          
        $sql1 = "UPDATE tbl_users SET acone='1', actwo='0'  WHERE email='$email'";
        
        if (mysqli_query($link, $sql1)) {
            $msg = "Account A activated and Account B Deactivated successfully!";
        } else {
            $msg = "Cannot activate Account A! ";
        }
        }
    
        if(isset($_POST['actwo'])){
	
	
          $email =$link->real_escape_string( $_POST['email']);
              
            
          $sql1 = "UPDATE tbl_users SET acone='0', actwo='1'  WHERE email='$email'";
          
          if (mysqli_query($link, $sql1)) {
              $msg = "Account B activated and Account A Deactivated successfully!";
          } else {
              $msg = "Cannot activate Account B! ";
          }
          }
      




?>




<?php


$sql= "SELECT * FROM tbl_users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);

  $session = $row['session'];
  $fname =  $row['fname'];
  
  $lname =  $row['lname'];

  $bal =  $row['balance'];
  $account =  $row['acctno'];

}
  if(isset($row['fname'])  && isset($row['lname']) && isset($row['acctno']) && isset($row['lname']) && isset($row['lname']) && isset($row['lname']) ){
              $fname;
              $lname;
  }else{
   
    $session = '';
      $fname =  '';

        $lname =  '';
  }

  
  if(isset($row['active'])  && $row['active']==1){
    $acst = 'Activated &nbsp;&nbsp;<i style="color:green;font-size:20px;" class="fa  fa-check" ></i>';
    
  }else{
    $acst = 'Deactivated &nbsp;&nbsp;<i style="color:red;font-size:20px;" class="fa  fa-times" ></i>';
  }



  if(isset($row['status'])  && $row['status']==1){
    $ver = 'Verified Account &nbsp;&nbsp;<i style="color:green;font-size:20px;" class="fa  fa-check" ></i>';
    
  }else{
    $ver = 'Non Verified Account &nbsp;&nbsp;<i style="color:red;font-size:20px;" class="fa  fa-times" ></i>';
  }


  if(isset($row['acone'])  && $row['acone']==1){
    $aca = 'Account A Activated &nbsp;&nbsp;<i style="color:green;font-size:20px;" class="fa  fa-check" ></i>';
    
  }else{
    $aca = 'Account A Deactivated   &nbsp;&nbsp;<i style="color:red;font-size:20px;" class="fa  fa-times" ></i>';
  }


  if(isset($row['actwo'])  && $row['actwo']==1){
    $acb = 'Account B Activated &nbsp;&nbsp;<i style="color:green;font-size:20px;" class="fa  fa-check" ></i>';
    
  }else{
    $acb = 'Account B Deactivated  &nbsp;&nbsp;<i style="color:red;font-size:20px;" class="fa  fa-times" ></i>';
  }



?>




      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-user " style="font-size:30px"></i> <a href="statement.php?email=<?php echo $email ;?>&account=<?php echo $account;?>"><?php echo strtoupper($fname.' '.$lname) ;?></a> ACCOUNT INFORMATION</h1>
           
          
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
 

                    <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>

                      <h2>Acct NO:<a href="statement.php?email=<?php echo $email ;?>&account=<?php echo $account;?>"> <?php echo $row['acctno'] ;?></a></h2>
                      <div class="invoice-number"><img src="../../secure/uploads/<?php echo $row['pics'] ;?>" width="150px" height="150px"/></div>
                    </div>
                    
                    <div class="row">
                      
                     
                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-12">

                  <form action="user-details.php?email=<?php echo $email ;?>" method="POST">

<input type="hidden"  name="email" value="<?php echo $email ;?>">

<button name="acone" class="btn btn-primary btn-icon icon-left"><i class="fas fa-check"></i> Activate Account A / <i class="fas fa-times"></i> Deactivate Account B</button>
</form>
</br>
<form action="user-details.php?email=<?php echo $email ;?>" method="POST">

<input type="hidden"  name="email" value="<?php echo $email ;?>">

<button name="actwo" class="btn btn-success btn-icon icon-left"><i class="fas fa-check"></i> Activate Account B / <i class="fas fa-times"></i>Deactivate Account A</button>
</form>

</br>
<form action="user-details.php?email=<?php echo $email ;?>" method="POST">

<input type="hidden"  name="email" value="<?php echo $email ;?>">

<button name="delete" class="btn btn-danger btn-icon icon-left"> <i class="fas fa-times"></i>Delete User Account </button>
</form>

</br>
<style>
th{
  background-color:#4c6578;
  color:#fff;
}

td{
  background-color:#fff;
  color:black;
}
</style>

                   
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                         
                          <th>Balance</th>
                          <th class="text-center">Email</th>
                          <th class="text-center">Phone</th>
                          <th class="text-right">Gender</th>
                        </tr>
                        <tr>
                          
                          <td><?php echo $currency.''. $row['balance'] ;?></td>
                          <td class="text-center"><?php echo $row['email'] ;?></td>
                          <td class="text-center"><?php echo $row['phone'] ;?></td>
                          <td class="text-right"><?php echo $row['gender'] ;?></td>
                        </tr>
                        </br></br>
                        <tr>
                        <th>Account Type</th>
                          <th class="text-center">Transfer Status</th>
                          <th class="text-center">Pin Number</th>
                          <th class="text-right">Account Status</th>
                        </tr>
                        <tr>
                          
                          <td><?php echo $row['utype'] ;?></td>
                          <td class="text-center"><?php echo $acst ;?></td>
                          <td class="text-center"><?php echo $row['pin'] ;?></td>
                          <td class="text-right"><?php echo $ver ;?></td>
                        </tr>

                        </br></br>
                        <tr>
                        <th>IPN CODE</th>
                          <th class="text-center">Account A Status</th>
                          <th class="text-center">IMF CODE</th>
                          <th class="text-right">Account B Status</th>
                        </tr>
                        <tr>
                          
                          <td><?php echo $row['ipn'] ;?></td>
                          <td class="text-center"><?php echo $aca ;?></td>
                          <td class="text-center"><?php echo $row['imf'] ;?></td>
                          <td class="text-right"><?php echo $acb ;?></td>
                        </tr>

                        </br></br>
                        <tr>
                        <th>COT CODE</th>
                          <th class="text-center">User Password</th>
                          <th class="text-center">State</th>
                          <th class="text-right">Address</th>
                        </tr>
                        <tr>
                          
                          <td><?php echo $row['cot'] ;?></td>
                          <td class="text-center"><?php echo $row['pwd'] ;?></td>
                          <td class="text-center"><?php echo $row['state'] ;?></td>
                          <td class="text-right"><?php echo $row['address'] ;?></td>
                        </tr>
                      </table>
                    </div>
                   
                        <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  
                    <form action="user-details.php?email=<?php echo $email ;?>" method="POST">

                    <input type="hidden"  name="email" value="<?php echo $email ;?>">
                  <button name="deactivate" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Deactivate Transfer</button>
                    
                    </form>

                </div>

                <form action="user-details.php?email=<?php echo $email ;?>" method="POST">

                  <input type="hidden"  name="email" value="<?php echo $email ;?>">

                <button name="activate" class="btn btn-success btn-icon icon-left"><i class="fas fa-check"></i> Activate Transfer</button>
                </form>

              </div>
            </div>
                      </div>
</br>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  
                    <form action="user-details.php?email=<?php echo $email ;?>" method="POST">

                    <input type="hidden"  name="email" value="<?php echo $email ;?>">
                  <button name="unverify" class="btn btn-warning btn-icon icon-left"><i class="fas fa-times"></i> Unverify Account</button>
                    
                    </form>

                </div>

                <form action="user-details.php?email=<?php echo $email ;?>" method="POST">

                  <input type="hidden"  name="email" value="<?php echo $email ;?>">
                  
                  <input type="hidden"  name="fname" value="<?php echo $fname ;?>">
                  
                    <input type="hidden"  name="account" value="<?php echo $account ;?>">
              
                <button name="verify" class="btn btn-info btn-icon icon-left"><i class="fas fa-check"></i> Verify Account</button>
                </form>

              </div>
            </div>
                      </div>   

        </br> </br>
                      <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>CREDIT/DEBIT USER ACCOUNT</h4>
                  </div>

                  <form action="user-details.php?email=<?php echo $email ;?>" method="POST">
                  <div class="card-body">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Amount</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="double" name="amount" class="form-control">
                      </div>
                    </div>
                    <input type="hidden"  name="email" value="<?php echo $email ;?>">

                    <input type="hidden"  name="status" value="SUCCESS">

                    <input type="hidden"  name="account" value="<?php echo $account ;?>">

                   

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Transact Type</label>
                      <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" name="type">
                           <option>Credit Fund</option>
                          <option>Debit Fund</option>
                        </select>
                      </div>
                    </div>


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Transfer Description</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea class="summernote" name="description"></textarea>
                      </div>
                    </div>


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary" name="fund">Credit/Debit Account</button>

        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
          </div>
        </section>
      </div>
      
    </div>
  </div>

