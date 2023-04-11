<?php

session_start();
 if(isset($_SESSION['uid'])){
  
   include 'header.php';
   include '../../config/database.php';
   include '../../config/config.php';

   if(isset($_GET['email']) &&  isset($_GET['account'])){
   $email = $_GET['email'];
   $acct = $_GET['account'];

   }else{
    $email = $_GET['email'] = '0';
    $acct = $_GET['account'] = '0';  
   }
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
            <h1><i class="fa fa-users" style="font-size:30px"></i> Statement Of Account For <?php echo $acct;?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="">Santander Credit Union</a></div>
                 <div class="breadcrumb-item"></div>
            </div>
          </div>
          
               <div class="table-responsive">
                     <table class="display" style="width:90%" id="example">
                                    <thead>
                                        <tr >
                                            
                                             <th>TXN-TYPE</th>
                                            <th>AMOUNT</th>
                                            <th>DESCRIPTION</th>
                                             <th>TO-ACCT/FROM-ACCT</th>
                                            <th>STATUS</th>
                                            <th>TXN-DATE</th>
                                            <th>REFERENCE NO</th>
                                            
                                            <th>ACTION</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    <?php $sql= "SELECT * FROM tbl_transaction WHERE email='$email'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				  while($row = mysqli_fetch_assoc($result)){  
				  if(isset($row['session'])  && $row['session']==1){
					  $msg = "online";
					  
				  }else{
					  $msg = "offline";
				  }
				  if(isset($row['verify'])  && $row['verify']==1){
					  $ver = "verified";
					  
				  }else{
					  $ver = "not verified";
				  }
        
				  ?>
				

                            
                                        <tr class="info">
                                       <form>
                                            
                                            <td><?php echo $row['tx_type'];?></td>
                                            <td><?php echo $row['amount'];?></td>
                                            <td class="center"><?php echo $row['description'];?></td>
                                             <td><?php echo $row['to_accno'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td><?php echo $row['date'];?></td>
                                             <td><?php echo $row['tx_no'];?></td>
                                        
                                          
                                            <td><button type="submit" name="delete" style="width:100%" class="btn btn-danger"><span class="fas fa-trash">-Delete </span></button></td>

                                            </form>
                                            <td><a href="view-statement.php?id=<?php echo $row['id']?>&refno=<?php echo $row['tx_no']?>"><button  name="view" style="width:100%" class="btn btn-info"><span class="fas fa-pencil-alt">-Edit </span></button></td>
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