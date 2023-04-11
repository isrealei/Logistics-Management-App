
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;


if(isset($_SESSION['uid'])){
 
 
 $pid = $_GET['pid'];
  include '../../config/database.php';
  include '../../config/config.php';
  include 'header.php';


  $msg = "";

}
else{

    header("location:../pages/login.php");
}







if(isset($_POST['set'])){

 $pname = $_POST['pname'];
   $shipdate = $_POST['shipdate'];
   $saddress = $_POST['saddress'];
   $sname = $_POST['sname'];
   $raddress = $_POST['raddress'];
   $rname = $_POST['rname'];
   $email = $_POST['email'];
   $status = $_POST['status'];
   $location = $_POST['location'];
   $pdate = $_POST['pdate'];
 $pid = $_POST['pid'];
  $remark = $_POST['remark'];
  
    



   $sql = "INSERT INTO history (pname,shipdate,saddress,sname,raddress,rname,email,status,location,pdate,pid,remark) VALUES ('$pname','$shipdate','$saddress','$sname','$raddress','$rname','$email','$status','$location','$pdate','$pid','$remark')";
   
   if(mysqli_query($link, $sql)){
      

 //send email


require_once "PHPMailer/PHPMailer.php";
require_once 'PHPMailer/Exception.php';


//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = $emaila;
$mail->FromName = $name;

//To address and name
$mail->addAddress($email);
$mail->addAddress("$email"); //Recipient name is optional

//Address to which recipient will reply

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Shipment Receipt";

$mail->Body = '



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">

<div class="be_logo" style="float: left;"> <img src="https://'.$bankurl.'/admin/pages/logo/'.$logo.'"></div>

<div class="be_user" style="float: right"> <p>Dear: '.$sname.' - Tracking ID: ' .$pid.'</p> </div> 

<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">

<h1>Shipment Receipt</h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> 
<p style="line-height: 25px;"> 




<div class="container">
  
             
  <table class="table table-condensed" >
  
   
        <th>Package Name</th>
        <th>Shipment Date</th>
        <th>Email</th>
      </tr>

      <tr>
        <td>'.$pname.'</td>
        <td>'.$shipdate .'</td>
        <td>'.$email.'</td>
      </tr>
      <tr>
      
      
       <tr>
        <th>Sender Address</th>
        <th>Sender Name</th>
        <th>Date</th>
      </tr>
      
        <td>'. $saddress.'</td>
        <td>'.$sname.'</td>
        <td>'.$pdate.'</td>
      </tr>
      <tr>
      
      
      
      <tr>
             <th>Receiver Address</th>
        <th>Receiver Name</th>
        <th>Package Status</th>
      </tr>
      
        <td>'. $raddress.'</td>
        <td>'.$rname.'</td>
        <td>'.$status.'</td>
      </tr>
      
      
      
      <tr>
             <th>Location</th>
        <th>Tracking ID</th>
        
      </tr>
      
        <td>'. $location.'</td>
        <td>'.$pid.'</td>
        
      </tr>
      
      
    </tbody>
  </table>
</div>

</p> <div style="margin-top: 25px;">

 </div> </div> 
 
 <div class="be_footer">
<div style="border-bottom: 1px solid #ccc;"></div> <p> Please do not reply to this email. Emails sent to this address will not be answered. 
Copyright ©2019 '.$name.'. </p> </div> </div> </div>';

if($mail->send()) {
   
   $msg = "New Package history has been added successfuly!";
}
               
           else{
               $msg = "Email send error!";
            }
        

   
}


}
 
 








    ?>




  <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-home " style="font-size:30px"></i> New Package History</h1>
           
          
          </div>


        
   
 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>


 <?php 
 
 $sql= "SELECT * FROM history WHERE pid='$pid'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				 $row = mysqli_fetch_assoc($result); 
				  if(isset($row['pid'])){
				      
$pid = $row['pid'];					
 $pname = $row['pname'];
   $shipdate = $row['shipdate'];
   $saddress = $row['saddress'];
   $sname = $row['sname'];
   $raddress = $row['raddress'];
   $rname = $row['rname'];
   $email = $row['email'];
   $status = $row['status'];
   $location = $row['location'];
   $pdate = $row['pdate'];
   
					  
				  }else{
					}
?>

     <form class="form-horizontal" action="history-edit.php?pid=<?php echo $pid;?>" method="POST" enctype="multipart/form-data" >

           <legend>Create New History</legend>
		   
		
        </div>
 <div class="form-group">
        <input type="hidden" name="pname"  value="<?php echo $pname;?>" readonly class="form-control">
        </div>

     <div class="form-group">
        <input type="hidden" name="shipdate " readonly  value="<?php echo $shipdate;?>"  class="form-control">
        </div>

        <div class="form-group">
        <input type="hidden" name="saddress" readonly  value="<?php echo $saddress;?>" class="form-control">
        </div>
        
     <div class="form-group">
        <input type="hidden" name="sname"  readonly value="<?php echo $sname;?>"   class="form-control">
        </div>

        <div class="form-group">
        <input type="hidden" name="raddress " readonly value="<?php echo $raddress;?>"    class="form-control">
        </div>

        <div class="form-group">
        <input type="hidden" name="rname"  readonly value="<?php echo $rname;?>"  class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="email" readonly value="<?php echo $email;?>"   class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="status"   placeholder="status" class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="location" placeholder="location"  class="form-control">
        </div>

      <div class="form-group">
        <input type="text" name="pid" value="<?php echo $pid;?>" readonly class="form-control">
        </div>
        
         <div class="form-group">
        <input type="text" name="remark" placeholder="Remark" class="form-control">
        </div>
        
        
     <div class="form-group">
         <label>Date</label>
        <input type="date" name="pdate" placeholder="history date"   class="form-control">
        </div>

       
     

      


    <button style="" type="submit" class="btn btn-success" name="set" > <i class="fa fa-send"></i>&nbsp; Add new history </button>

    </form>

<?php    
          
          }
?>


    </div>
   </div>

   </div>
  </div>
  </section>
</div>

