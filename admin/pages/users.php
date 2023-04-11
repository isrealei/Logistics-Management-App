<?php
session_start();
if(isset($_SESSION['uid'])){
 
 
  include '../../config/database.php';
  include '../../config/config.php';
   include 'header.php';
  
  $msg = "";

}
else{

    header("location:../pages/login.php");
}




    if(isset($_POST['delete'])){
        
        
	
	
      $id = $_POST['id'];
      
      
          
        
      $sql1 = "DELETE FROM tbl_users  WHERE id='$id'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Account Deleted Successfully!";
          
         
      } else {
          $msg = "Cannot Delete Account! ";
      }
      }
    


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
  
  
  <script type="text/javascript" charset="utf8" src=""></script>
  <script type="text/javascript" charset="utf8" src=""></script>

 
  



    
    
 
    
    
    
    
    
    

   
   



<style>
.table-responsive {
overflow-x: hidden;
}
@media (max-width: 8000px) {
.table-responsive {
overflow-x: auto;
}
</style>
  </head>
  <body>

  <!-- Main Content -->
      <div class="main-content">

        <section class="section">

          <div class="section-header">
            <h1><i class="fa fa-users" style="font-size:30px"></i> Users Details</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href=""><?php echo $name?></a></div>
                 <div class="breadcrumb-item"></div>
            </div>
          </div>
          <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          <div class="col-md-12 col-sm-12 col-sx-12">
               <div class="table-responsive">
                     <table class="display"  id="example">
                                    <thead>
                                        <tr>
                                            <th>ACCOUNT NAME</th>
                                            <th>EMAIL</th>
                                             <th>TRANSFER-STATUS</th>
                                            <th>REG-DATE </th>
                                             <th style="display:none">email </th>
                                             <th>ACTION</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>


                                    <?php 
                                    $sql= "SELECT * FROM tbl_users";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
				  if(isset($row['session'])  && $row['session']==1){
					  $msg = "online";
					  
				  }else{
					  $msg = "offline";
				  }
				  if(isset($row['active'])  && $row['active']==1){
					  $acst = 'Activated &nbsp;&nbsp;<i style="color:green;font-size:20px;" class="fa  fa-check" ></i>';
					  
				  }else{
					  $acst = 'Deactivated &nbsp;&nbsp;<i style="color:red;font-size:20px;" class="fa  fa-times" ></i>';
				  }
        
				  ?>

                           
                                  
                                        <tr class="odd gradeX">
                                       
                                     
                                  				
  
                                     
                                            <td><?php echo $row['fname'] .' '. $row['lname'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                               <td><?php echo $acst;?></td>
                                            <td><?php echo $row['bdate'];?></td>
                                            
                                            <td style="display:none"><input type="hidden" value="<?php echo $row['id'];?>"></td>


                                          
                                            <td><a href="user-details.php?email=<?php echo $row['email']?>"><button  name="view" style="width:100%" class="btn btn-info"><span class="fas fa-eye">-View </span></button></a></td>
                                            
                                        
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
      </div>
      </div> 
      </div>
      </div>
      </div>
      </div>
      </section>
      </div>
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

  </body>
</html>