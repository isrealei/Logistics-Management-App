
<?php
session_start();
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




if(isset($_POST['mssg'])){


 $email = $_POST['email'];
   $title = $_POST['title'];
   $message = $_POST['message'];
   
    $msgid ='cabcdg19etsfjhdshdsh35678gwyjerehuhb/>()[]{}|\dTSGSAWQUJHDCSMNBVCBNRTPZXMCBVN1234567890';
            $msgid = str_shuffle($msgid);
             $msgid= substr($msgid,0, 10);


	 $sql = "INSERT INTO adminmessage (email, message, title, msgid) VALUES ('$email','$message','$title','$msgid')";
        if(mysqli_query($link, $sql)){
			
			$msg = "Message sent!";
		}else{
			
			$msg = "Message not sent!";
		}
}


  
if(isset($_POST['delete'])){
	
  $msgid = $_POST['msgid'];
  
$sql = "DELETE FROM messageadmin WHERE msgid='$msgid'";

if (mysqli_query($link, $sql)) {
  $msg = "Message deleted successfully!";
} else {
  $msg = "Message not deleted! ";
}
}


  
if(isset($_POST['send'])){
	
  $msgid = $_POST['msgid'];
  $reply = $_POST['reply'];
  
$sql = "UPDATE  messageadmin SET reply='$reply',astatus='1' WHERE msgid='$msgid'";

if (mysqli_query($link, $sql)) {
  $msg = "Message replied successfully!";
} else {
  $msg = "Message not replied! ";
}
}




include "header.php";


    ?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  

  <link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.jqueryui.min.css">



  

  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="">
 
  
    
    



  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.jqueryui.min.js"></script>
   
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
  


  <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fa fa-user " style="font-size:30px"></i> MESSAGE MANAGEMENT</h1>
           
          
          </div>


        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>

    
          

<div class="col-md-12 col-sm-12 col-sx-12">
     <div class="table-responsive">
           <table class="display"  id="example">

					<thead>

						<tr class="info">
						<th>Account</th>
                            <th>Message</th>
                            <th>Admin-Response</th>
							<th style="display:none;"></th>
							
							 <th>Status</th>
								<th>Date</th>
                                <th>Action</th>
                                <th>Action</th>
								
                                
                                

						</tr>
					</thead>


					<tbody>
					<?php $sql= "SELECT * FROM messageadmin ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
				  if(isset($row['astatus'])  && $row['astatus']==1){
					  $msg = 'Message replied &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-check" ></i>';
					  
				  }else{
					  $msg = 'Waiting for response! &nbsp;&nbsp;<i class="fa  fa-envelope" style=" font-size:20px;color:red"></i>';
				  }
                  ?>
                  


				
						<tr class="primary">
						<form action="sendm.php" method="post">
                       <td><?php echo $row['account'];?></td>
                       
                            <td id="account">  <?php echo $row['message'];?>
               </td>
               <td id="account"> <input type="text" style="border-radius:5px;" name="reply" value="<?php echo $row['reply'];?>">
               </td>
							<td style="display:none;"><input type="hidden" name="msgid" value="<?php echo $row['msgid'];?>"> </td>
							
													
							<td><?php echo $msg;?></td>
						              
              <td><?php echo $row['date'];?></td>
			  
                          
							<td><button type="submit" name="send" class="btn btn-success"><span class="glyphicon glyphicon-send"> Reply Message</span></button></td>
							
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

        



    </div>
   </div>

   </div>
  </div>
  </section>
</div>

<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
       
    } );
    

    table.buttons().container()
        .insertBefore( '#example_filter' );

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-12:eq(0)' );
} );
</script>