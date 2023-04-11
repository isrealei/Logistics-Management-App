<?php

session_start();
if(isset($_SESSION['uid'])){
 
 
 $id = $_GET['id'];
  include '../../config/database.php';
  include '../../config/config.php';
  include 'header.php';


  $msg = "";

}
else{

    header("location:../pages");
}











if(isset($_POST['submit'])){


$opassword =$link->real_escape_string($_POST['opassword']);
$cpassword =$link->real_escape_string($_POST['cpassword']);
$password =$link->real_escape_string($_POST['password']);
$email =$link->real_escape_string($_POST['email']);


if ( $opassword == $cpassword){
    
    
$sql = "UPDATE admin SET password='$password' WHERE email='$email'";

    
  mysqli_query($link, $sql);

  

    $msg= " Password changed successfully";
    

 }
 
 else{
    

 $msg= "Wrong Old Password! ";
}
    

}


    ?>





  <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-home " style="font-size:30px"></i> CHANGE PASSWORD</h1>
           
          

   


       

<div class="col-md-12 col-sm-12 col-sx-12">
          <div class="box box-default">
            <div class="box-header with-border">

          <h4 align="center"><i class="fa fa-refresh"></i> PASSWORD UPDATE</h4>
          </br>
          	<?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
<div class="col-md-9 col-sm-12 col-sx-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-white">
             

              <form class="form-horizontal" action="password.php" method="POST" >
   <div class="form-group">
<input type="text"  name="opassword"   placeholder="Old Password" class="form-control">
 
</div>          
<div class="form-group">
<input type="password"  name="password"   placeholder="New Password" class="form-control">
 
</div>

<div class="form-group">
<input type="hidden"  name="cpassword"  value="<?php  echo $_SESSION['password']?>"  class="form-control">
 
</div>
             
<div class="form-group">
<input type="hidden"  name="email"  value="<?php  echo $_SESSION['email']?>" class="form-control">
 
</div>

<div class="form-group">
<input type="submit"  name="submit" value="Change Password" class="btn btn-warning">
 
</div>
</form>

            </div>
          </div>
    
        </div>
        
             </div>
          </div>
    
        </div>     </div>
        
          </section>
          </div>
    
        