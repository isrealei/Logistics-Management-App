<?php
 session_start();
 if(isset($_SESSION['uid'])){
  
   include 'header.php';
   include '../../config/database.php';
   include '../../config/config.php';
   $email = $_GET['email'];
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
        
          
				  
        
      
      



    if(isset($_POST['edit'])){
	
	
      $emails =$link->real_escape_string( $_POST['email']);
       $fname =$link->real_escape_string( $_POST['fname']);
      $lname =$link->real_escape_string( $_POST['lname']);
      $acctno =$link->real_escape_string( $_POST['acctno']);
      $phone =$link->real_escape_string( $_POST['phone']);
      $gender =$link->real_escape_string( $_POST['gender']);
      $pin =$link->real_escape_string( $_POST['pin']);
      $utype =$link->real_escape_string( $_POST['utype']);
      $imf =$link->real_escape_string( $_POST['imf']);
      $ipn =$link->real_escape_string( $_POST['ipn']);
      $cot =$link->real_escape_string( $_POST['cot']);
      $pwd =$link->real_escape_string( $_POST['pwd']);

      
          
        
      $sql1 = "UPDATE tbl_users SET fname='$fname', lname='$lname', email='$emails', phone='$phone', gender='$gender', utype='$utype', acctno='$acctno', pin='$pin', imf='$imf', ipn='$ipn', cot='$cot', pwd='$pwd'   WHERE email='$emails'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Account Details Edited Successfully!";
      } else {
          $msg = "Cannot Edit Account! ";
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




?>




      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-user " style="font-size:30px"></i> <a href="statement.php?email=<?php echo $email ;?>&account=<?php echo $account;?>"><?php echo strtoupper($fname.' '.$lname) ;?></a> INFORMATION</h1>
           
          
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    
 

                    <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
                        
                   
                    <form action="user-edit.php?email=<?php echo $email ;?>" method="POST">

                <div  style="margin-top:-300px;" class="">
                  <div class="col-md-12">
                   
                    <div class="table-responsive">
                      
                    <table class="table table-striped table-hover table-md">

                    <tr>
                         
                         <th>First Name</th>
                         <th class="text-center">Last Name</th>
                         <th class="text-center">Account Type</th>
                         <th class="text-right">Account Number</th>
                       </tr>


                       </div><div class="form-group row mb-4">
                          <td> <input type="text" name="fname" class="form-control" value="<?php echo  $row['fname'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" name="lname" class="form-control" value="<?php echo $row['lname'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="utype" class="form-control" value="<?php echo $row['utype'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="acctno" class="form-control" value="<?php echo $row['acctno'] ;?>"></td>

</div>
                        </tr>






                        <tr>
                         
                          <th>Balance</th>
                          <th class="text-center">Email</th>
                          <th class="text-center">Phone</th>
                          <th class="text-right">Gender</th>
                        </tr>
                        <tr>
                        
                      
                    </div><div class="form-group row mb-4">
                          <td> <input type="text" name="balance" readonly class="form-control" value="$<?php echo $row['balance'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" name="email" class="form-control" value="<?php echo $row['email'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="gender" class="form-control" value="<?php echo $row['gender'] ;?>"></td>

</div>
                        </tr>
                        </br></br>






                        <tr>
                         
                          <th>Imf Code</th>
                          <th class="text-center">Ipn Code</th>
                          <th class="text-center">Cot Code</th>
                          <th class="text-right">password</th>
                        </tr>
                        <tr>
                        
                      
                    </div><div class="form-group row mb-4">
                          <td> <input type="text" name="imf"  class="form-control" value="<?php echo $row['imf'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" name="ipn" class="form-control" value="<?php echo $row['ipn'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="cot" class="form-control" value="<?php echo $row['cot'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="pwd" class="form-control" value="<?php echo $row['pwd'] ;?>"></td>

</div>
                        </tr>
                        </br></br>
                        <tr>
                        
                          <th class="text-center">Pin Number</th>
                          <th class="text-center">User Image</th>
                          
                        </tr>
                        <tr>
                          
                       
                          <div class="form-group row mb-4">
                          <td> <input type="text" name="pin" class="form-control" value="<?php echo $row['pin'] ;?>"></td>
                          <td> <a href="getimage.php?email=<?php echo $email ;?>">click to change user image</a></td>

                          </div>
                         
                         
                         
                        </tr>

                        <tr>
                          <td>
                        <button  type="submit" name="edit" class="btn btn-success btn-icon icon-left"><i class="fas fa-check"></i> Edit User Details</button></td>
                        </tr>

                </form>

                      </table>
                    </div>
                   
                        <hr>
             
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
              </div>
              
          </div>
        </section>
      </div>
      
    </div>
  </div>

