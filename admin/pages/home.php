<?php
 session_start();
if(isset($_SESSION['uid'])){
 
 
  include '../../config/database.php';
  include '../../config/config.php';
 include 'users_query.php';
  include 'header.php';
  $msg = "";

}
else{

    header("location:../pages/login.php");
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
 
 
 
 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $name?></h1>
          </div>






          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Shipment</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $totalu;?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4><a href="card.php"> Update Shipment</a></h4>
                  </div>
                 
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4><a href="history.php">Add Shipment History</a></h4>
                  </div>
                 
                </div>
              </div>
            </div>
            
            </br>
         
            
            
            
            
            
            <h2 align="center">Latest Shipment</h2>
            
            </br>   </br>
            
            
              <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          
          
          <div class="col-md-12 col-sm-12 col-sx-12">
               <div class="table-responsive">
                     <table class="display"  id="example">
                                    <thead>
                                        <tr>
                                             <th style="display:none">id</th>
                                            <th>SENDER NAME</th>
                                            <th>EMAIL</th>
                                             <th>TRACK ID</th>
                                            <th>SHIPMENT DATE </th>
                                            <th>PACKAGE NAME</th>
                                             <th>DELIVERY DATE</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>


                                    <?php 
                                    $sql= "SELECT * FROM track 	ORDER BY id DESC LIMIT 10";
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
      $pid = $row['pid'];
					  
				  }else{
					 
				  }
				  
        
				  ?>
				

                            
                                        <tr class="odd gradeX">
                                      
                                       <form class="form-horizontal" action="history.php" method="POST" enctype="multipart/form-data" >
                                      
                                      
                                      
                                      <td style="display:none"><input name="id" value="<?php echo $row['id'];?>"></td>
                                      
                                      
                                            <td><?php echo $row['sname'] .' '. $row['lname'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['pid'];?></td>
                                            <td><?php echo $row['shipdate'];?></td>
                                                                                        <td><?php echo $row['pname'];?></td>
                                     

                                            <td><?php echo $row['edd'];?></td>
                                     
                                            
    
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
<div id="editor"></div>
<button id="cmd">Generate PDF</button>

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
     
     
     
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
     
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

            
            
            
            
            
            
            
          </div>




            </div>
          </div>
        </section>
      </div>
