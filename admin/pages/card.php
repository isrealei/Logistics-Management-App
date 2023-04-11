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
    
    $pid = $_POST['pid'];
    
    $sql = "DELETE   FROM track  WHERE pid = '$pid'";
    
       if(mysqli_query($link, $sql)){
           
           $msg = "package deleted!";
           
       }else{
           
           $msg = "package not be deleted!"; 
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
            <h1><i class="fa fa-users" style="font-size:30px"></i> Update Package</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href=""><?php echo $name;?></a></div>
                 <div class="breadcrumb-item"></div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-sx-12">
              
                <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
              
              
               <div class="table-responsive">
                     <table class="display"  id="example">
                                    <thead>
                                        <tr>
                                             <th style="display:none">PID</th>
                                            <th>SENDER NAME</th>
                                            <th>EMAIL</th>
                                             <th>TRACK ID</th>
                                            <th>SHIPMENT DATE </th>
                                            <th>PACKAGE NAME</th>
                                            <th>LOCATION </th>
                                            <th>SHIPTMENT STATUS</th>
                                            
                                             <th>ACTION</th>
                                            <th>ACTION</th>
                                             <th>ACTION</th>
                                               <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    <?php 
                                    $sql= "SELECT * FROM track";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
				  if(isset($row['pid']) ){
	 $ids = $row['id'];									
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
				

                            
                                        <tr class="odd gradeX">
                                      <form action="card.php" method="POST">
                                          
                                         <td style="display:none"> <input type="text" name="pid" value="<?php echo $row['pid'];?>"></td>
                                            <td><?php echo $row['sname'] .' '. $row['lname'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['pid'];?></td>
                                            <td><?php echo $row['shipdate'];?></td>
                                                                                        <td><?php echo $row['pname'];?></td>
                                     <td><?php echo $row['location'];?></td>
                                        <td><?php echo $row['status'];?></td>   
                                           

                                            <td><button type="submit" name="delete" style="width:100%" class="btn btn-danger"><span class="fas fa-trash">-Delete </span></button></td>

                                          </form>
                                            <td><a href="card-edit.php?id=<?php echo $ids;?>"><button  name="view" style="width:100%" class="btn btn-info"><span class="fas fa-check">-Edit </span></button></a></td>
                                            <td><a href="print.php?id=<?php echo $row['id'];?>"><button  name="print" style="width:100%" class="btn btn-success"><span class="fas fa-print">-Print Receipt </span></button></a></td>
                                            
                                            <td><a href="ocontrol.php?pid=<?php echo $row['pid'];?>"><button  name="ocontrol" style="width:100%" class="btn btn-warning"><span class="fas fa-print">-Package Control </span></button></a></td>
                                            
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