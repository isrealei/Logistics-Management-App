<?php
session_start();


include "../../config/db.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}

// delete investor
if(isset($_POST['delete'])){
	
	$msgid = $_POST['msgid'];
	
$sql = "DELETE FROM message WHERE msgid='$msgid'";

if (mysqli_query($link, $sql)) {
    $msg = "Message deleted successfully!";
} else {
    $msg = "Message not deleted! ";
}
}
// verify investor

if(isset($_POST['read'])){
	
	$msgid = $_POST['msgid'];
	
$sql = "UPDATE messageadmin SET status = '1'  WHERE msgid='$msgid'";

if (mysqli_query($link, $sql)) {
    $msg = "Message marked as read!";
} else {
    $msg = "Message not marked  ";
}
}



include 'header.php';





?>


    <link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css"/>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/1.0.2/js/dataTables.responsive.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">

     
 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   <style>
 
	
   </style>


<div style="width:100%">
          <div class="box box-default">
            <div class="box-header with-border">

	<div class="row">


		 <h2 class="text-center">INVESTORS MANAGEMENT</h2>
		  </br>
 <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
		    </br>


<div class="col-md-12 col-sm-12 col-sx-12">

<div class="box-body table-responsive no-padding">

<table id="table" class="table table-responsive table-striped table-bordered table-hover" >



					<thead>

						<tr class="info">
						<th>Email</th>
							<th>Message</th>
							<th style="display:none;"></th>
							
							<th>Title</th>
              <th>Image</th>
              <th>Status</th>
								<th>Date</th>
                                <th>Action</th>
								<th>Action</th>
                                
                                

						</tr>
					</thead>


					<tbody>
					<?php $sql= "SELECT * FROM messageadmin";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
				  if(isset($row['status'])  && $row['status']==1){
					  $msg = 'Message Read &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-check" ></i>';
					  
				  }else{
					  $msg = 'New Message! &nbsp;&nbsp;<i class="fa  fa-envelope" style=" font-size:20px;color:red"></i>';
				  }
				  ?>
				
						<tr class="primary">
						<form action="viewmail.php" method="post">
<td><?php echo $row['email'];?></td>
							<td id="email"><?php echo $row['message'];?></td>
							<td style="display:none;"><input type="hidden" name="msgid" value="<?php echo $row['msgid'];?>"> </td>
							<td><?php echo $row['title'];?></td>
							<td><img src="../../users/pages/verify/<?php echo $row['image'];?>" width="100px" height="100px"></td>
							
							<td><?php echo $msg;?></td>
						              
              <td><?php echo $row['date'];?></td>
			  
                            <td><button class="btn btn-success" type="read" name="read"><span class="glyphicon glyphicon-check"> Mark as read</span></button></td>
							
							
    <td><button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"> Delete</span></button></td>
</form>
						</tr>
						
					  <?php
 }
			  }
			  ?>
					</tbody>



				</table>
				
</div>
          </div>

		  </div>
          <!-- /top tiles -->

          </div>

        


    </body>
              </div>
            </div>


              </div>


          <br />







    </body>
              </div>
            </div>

<script>
$(document).ready(function () {
       $(document).on('click', '#delete',fucntion(){
		   
		   var email = $("#email").val();
		   
		   $.ajax({
			   url: "delete.php",
			   method: "post",
			   data:{email:email},
			   success:function(data){
				   alert("successful");
				   location.reload();
			   }
			   
		   });
	   }
				
    });



				</script>



          </section>

   </div>
  </div>
</div>


  </body>
</html>
<script>
$(document).ready(function () {
        $('#table')
                .dataTable({
                    "responsive": true,
                    
                });

				
    });



				</script>
