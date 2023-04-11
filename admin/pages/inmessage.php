
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;


if(isset($_SESSION['uid'])){
 
 
 $id = $_GET['id'];
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
   
    $remark = $_POST['remark'];
   
   
   $edd = $_POST['edd'];
   $weight = $_POST['weight'];
   $servicetype = $_POST['servicetype'];
   $pdesc = $_POST['pdesc'];
   $qty = $_POST['qty'];
   
   $image = $_FILES['image']['name'];
	$target = "pimages/".basename($image);
   
   
   
   
 $pid = substr(str_shuffle("0JHGGSGJHS123456HHDHYDJH789"), 0, 10);
  
    



   $sql = "INSERT INTO track (pname,shipdate,saddress,sname,raddress,rname,email,status,location,pdate,pid,edd,weight,servicetype,pdesc,qty,image,remark) VALUES ('$pname','$shipdate','$saddress','$sname','$raddress','$rname','$email','$status','$location','$pdate','$pid','$edd','$weight','$servicetype','$pdesc','$qty','$image','$remark')";
   
   if(mysqli_query($link, $sql)){
       
       move_uploaded_file($_FILES['image']['tmp_name'], $target);
      

$sql1 = "INSERT INTO history (pname,shipdate,saddress,sname,raddress,rname,email,status,location,pdate,pid,edd,weight,servicetype,pdesc,qty,image,remark) VALUES ('$pname','$shipdate','$saddress','$sname','$raddress','$rname','$email','$status','$location','$pdate','$pid','$edd','$weight','$servicetype','$pdesc','$qty','$image','$remark')";

mysqli_query($link, $sql1);



$sql2 = " INSERT INTO ocontrol (pid) VALUES ('$pid') ";

mysqli_query($link, $sql2);

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

<div class="be_logo" style="float: left;"> <img src="https://'.$bankurl.'/admin/pages/logo/'.$logo.'"> </div>

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
   
   $msg = "New Package has been added successfuly!";
}
               
           else{
               $msg = "Email send error!";
            }
        

   
}


}





if(isset($_POST['uset'])){

   $id = $_POST['id'];
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
   $pid = substr(str_shuffle("0JHGGSGJHS123456HHDHYDJH789"), 0, 10);
  
    
     
 
    $sql = "UPDATE settings SET  pname='$pname', shipdate='$shipdate', saddress='$saddress', sname='$sname', raddress='$raddress', rname='$rname', email='$email', status ='$status ', location='$location',pdate='$pdate', pid='$pid' WHERE id = '$id' ";
    
    if(mysqli_query($link, $sql)){
 
     move_uploaded_file($_FILES['logo']['tmp_name'], $target);
       
       $msg = "Settings Updated!";
     }else{
       
       $msg = "Settings Not Updated!";
     }
 }
 
 








    ?>




  <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-home " style="font-size:30px"></i> ADD NEW PACKAGE</h1>
           
          
          </div>


        
   
 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>

     <form class="form-horizontal" action="inmessage.php" method="POST" enctype="multipart/form-data" >

           <legend>Package Adding </legend>
		   
		
 <div class="form-group">
        <input type="text" name="pname" placeholder="Package Name"   class="form-control">
        </div>

     <div class="form-group">
         <label>Shipment date </label>
        <input type="date" name="shipdate" placeholder="Shipment date "  class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="saddress" placeholder="Sender address" class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="sname" placeholder="Sender name"   class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="raddress" placeholder="Receiver address "  class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="rname" placeholder="Receiver name"   class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="email" placeholder="Receiver Email"   class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="status" placeholder="shipment status e.g in transit"   class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="location" placeholder="Location"  class="form-control">
        </div>

      
        
     <div class="form-group">
         <label>Package update date </label>
        <input type="date" name="pdate" placeholder="Package Update Date"   class="form-control">
        </div>


   <div class="form-group">
       <label>Expected delivery date </label>
        <input type="date" name="edd" placeholder="Expected Delivery Date"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="weight" placeholder="Package Weight"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="servicetype" placeholder="Package Servicetype"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="pdesc" placeholder="Package Description"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="qty" placeholder="Package quantity"   class="form-control">
        </div>


   <div class="form-group">
        <input type="file" name="image" placeholder="Package image"   class="form-control">
        </div>

       
     

   <div class="form-group">
        <input type="text" name="remark" placeholder="Remark"   class="form-control">
        </div>

      
      
	  
	  <button style="" type="submit" class="btn btn-primary" name="set" > <i class="fa fa-send"></i>&nbsp; Add Package </button>

    

    </form>


    </div>
   </div>

   </div>
  </div>
  </section>
</div>

