
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;


if(isset($_SESSION['uid'])){
 
 
 $ids = $_GET['id'];
  include '../../config/database.php';
  include '../../config/config.php';
  include 'header.php';


  $msg = "";

}
else{

    header("location:../pages/login.php");
}









if(isset($_POST['uset'])){

   $ids = $_POST['id'];
    $pid = $_POST['pid'];
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
   
     
 
    $sql = "UPDATE track SET  pname='$pname', shipdate='$shipdate', saddress='$saddress', sname='$sname', raddress='$raddress', rname='$rname', email='$email', status ='$status', location='$location',pdate='$pdate', pid='$pid',edd='$edd',weight='$weight',servicetype='$servicetype',pdesc='$pdesc',qty='$qty', remark='$remark',  image= '$image'  WHERE id = '$ids' ";
    
   if(mysqli_query($link, $sql)){
      
  move_uploaded_file($_FILES['image']['tmp_name'], $target);
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

$mail->Subject = "Package History Update";

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

<h1>Package History Update!</h1>

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
   
   $msg = "Package history has been Updated successfuly!";
}
               
           else{
               $msg = "Email send error!";
            }
        

   
} 
           else{
               $msg = "Error updating package!";
            }
 }
 
 








    ?>




  <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-home " style="font-size:30px"></i> EDIT PACKAGE</h1>
           
          
          </div>


        
   
 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>


 <?php 
 
 $sql= "SELECT * FROM track WHERE id = $ids";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
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

     <form class="form-horizontal" action="card-edit.php?id=<?php echo $ids;?>" method="POST" enctype="multipart/form-data" >

           <legend> Package Update</legend>
		   
		<div class="form-group">
        <input type="hidden" name="id"  value="<?php echo $ids;?>" class="form-control">
        </div>
 <div class="form-group">
        <input type="text" name="pname" placeholder="Package name"  value="<?php echo $pname;?>"  class="form-control">
        </div>

     <div class="form-group">
        <input type="text" name="shipdate"  placeholder="Shipment Date"   value="<?php echo $shipdate;?>"  class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="saddress"  placeholder="Sender address"  value="<?php echo $saddress;?>" class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="sname" placeholder="sender name"  value="<?php echo $sname;?>"   class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="raddress" placeholder="Receiver address"  value="<?php echo $raddress;?>"    class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="rname"  placeholder="Receiver name"  value="<?php echo $rname;?>"  class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="email"  placeholder="Receiver email"  value="<?php echo $email;?>"   class="form-control">
        </div>

        <div class="form-group">
        <input type="text" name="status" placeholder="Status"   value="<?php echo $status;?>" class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="location" placeholder="Package Location"  value="<?php echo $location;?>"  class="form-control">
        </div>

      <div class="form-group">
        <input type="text" name="pid" value="<?php echo $pid;?>" readonly class="form-control">
        </div>
        
     <div class="form-group">
        <input type="text" name="pdate" placeholder="Package Update date"   class="form-control">
        </div>

       
     
 <div class="form-group">
       <label>Expected delivery date </label>
        <input type="date" name="edd" placeholder="Expected delivery date"  value="<?php echo $row['edd'];?>"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="weight" placeholder="weight"   value="<?php echo $row['weight'];?>"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" placeholder="Service type"  name="servicetype"  value="<?php echo $row['servicetype'];?>"   class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="pdesc" placeholder="Package Description"  value="<?php echo $row['pdesc'];?>" class="form-control">
        </div>

   <div class="form-group">
        <input type="text" name="qty" placeholder="Quantity"   value="<?php echo $row['qty'];?>"   class="form-control">
        </div>


   <div class="form-group">
        <input type="file" name="image" placeholder="Package image"   class="form-control">
        </div>

       
     

   <div class="form-group">
        <input type="text" name="remark" placeholder="Remark"  value="<?php echo $row['remark'];?>"  class="form-control">
        </div>

      


    <button style="" type="submit" class="btn btn-success" name="uset" > <i class="fa fa-send"></i>&nbsp; Update Settings </button>

    </form>

<?php    
          }
          }
?>


    </div>
   </div>

   </div>
  </div>
  </section>
</div>

