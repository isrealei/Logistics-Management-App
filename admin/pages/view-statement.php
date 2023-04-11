<?php
 session_start();
 if(isset($_SESSION['uid'])){
  
   include 'header.php';
   include '../../config/database.php';
   include '../../config/config.php';
   $refno = $_GET['refno'];
   $id = $_GET['id'];
   $msg = "";
 
 }
 else{
 
     header("location:../pages/login.php");
 }
 
 


 $sql= "SELECT * FROM tbl_transaction WHERE tx_no = '$refno'";
 $result = mysqli_query($link,$sql);
 if(mysqli_num_rows($result) > 0){
   $row = mysqli_fetch_assoc($result);
 
 
   $type = $row['tx_type'];
   $amount = $row['amount'];
   $account = $row['account'];
   $description = $row['description'];
   $to_accno = $row['to_accno'];                         
   $status = $row['status'];                            
   $date = $row['date'];                                 
   $ref = $row['tx_no'];                                     
  
 }
   if(isset($row['amount'])  && isset($row['status']) ){
               $amount;
               $account;
   }else{

     $amount =  '';
 
     $account =  '';
   }
 
    if(isset($_POST['edit'])){
	
	
      $type =$link->real_escape_string( $_POST['type']);
       $amount =$link->real_escape_string( $_POST['amount']);
      $account =$link->real_escape_string( $_POST['account']);
      $description =$link->real_escape_string( $_POST['description']);
      $to_accno =$link->real_escape_string( $_POST['to_accno']);
      $status =$link->real_escape_string( $_POST['status']);
      $date =$link->real_escape_string( $_POST['date']);
   
      
          
        
      $sql1 = "UPDATE tbl_transaction SET tx_type='$type', amount='$amount', date='$date',description='$description',  to_accno='$to_accno', account='$account',   status='$status'  WHERE tx_no='$ref'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "History Details Edited Successfully!";
      } else {
          $msg = "Cannot Edit History Details! ";
      }
      }
    

?>




<?php


$sql= "SELECT * FROM tbl_transaction WHERE tx_no = '$refno'";
$result = mysqli_query($link,$sql);
if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);


  $type = $row['tx_type'];
  $amount = $row['amount'];
  $account = $row['account'];
  $description = $row['description'];
  $to_accno = $row['to_accno'];                         
  $status = $row['status'];                            
  $date = $row['date'];                                 
  $ref = $row['tx_no'];                                     
                                          

}
  if(isset($row['amount'])  && isset($row['status']) ){
              $amount;
              $account;
  }else{
   
   
    $amount =  '';

    $account =  '';
  }

  



?>




      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-user " style="font-size:30px"></i>  HISTORY FOR ACCOUNT <?php echo strtoupper('<b>'.$account.'</b>'.' REFNO: '.$refno) ;?></h1>
           
          
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    
 

                    <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
                        
                   
                    <form action="view-statement.php?id=<?php echo $id ;?>&refno=<?php echo $refno ;?>" method="POST">

                <div  style="margin-top:-180px;" class="">
                  <div class="col-md-12">
                   
                    <div class="table-responsive">
                      
                    <table class="table table-striped table-hover table-md">

                    <tr>
                         
                         <th>Account Number</th>
                         <th class="text-center">Reference NO</th>
                         <th class="text-center">Amount(USD)</th>
                         <th class="text-right">Beneficiary/Sender Account</th>
                       </tr>


                       </div><div class="form-group row mb-4">
                          <td> <input type="text" name="account" class="form-control" value="<?php echo  $row['account'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" readonly name="ref" class="form-control" value="<?php echo $row['tx_no'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="amount" class="form-control" value="<?php echo $row['amount'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="to_accno" class="form-control" value="<?php echo $row['to_accno'] ;?>"></td>

</div>
                        </tr>

                        <tr>
                         
                          <th>Transaction Type</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Date</th>
                          <th class="text-right">Description</th>
                        </tr>
                        <tr>
                        
                      
                    </div><div class="form-group row mb-4">
                          <td> <input type="text" name="type"  class="form-control" value="<?php echo $row['tx_type'] ;?>"> </td>
</div>
                    
<div class="form-group row mb-4">
                          <td> <input type="text" name="status" class="form-control" value="<?php echo $row['status'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="date" class="form-control" value="<?php echo $row['date'] ;?>"></td>
                          </div>

                          </div><div class="form-group row mb-4">
                          <td> <input type="text" name="description" class="form-control" value="<?php echo $row['description'] ;?>"></td>

</div>
                        </tr>
                        </br></br>
                       

                        <tr>
                          <td>
                        <button  type="submit" name="edit" class="btn btn-success btn-icon icon-left"><i class="fas fa-pencil-alt"></i> Edit History</button></td>
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

