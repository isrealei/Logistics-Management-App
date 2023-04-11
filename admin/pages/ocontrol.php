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



if(isset($_POST['confirm'])){
    
    $pi = $_POST['pid'];
    
    $sql = "UPDATE  track SET status = 'confirm' WHERE pid = '$pi'";
    
       if(mysqli_query($link, $sql)){
           
           $msg = "package corfirmed";
           
       }else{
           
           $msg = "package not corfirmed"; 
       }
      

    
}





if(isset($_POST['process'])){
    
    $pi = $_POST['pid'];
    
    $sql = "UPDATE  track SET status = 'process' WHERE pid = '$pi'";
    
       if(mysqli_query($link, $sql)){
           
           $msg = "package processing";
           
       }else{
           
           $msg = "package not processed"; 
       }
      

    
}





if(isset($_POST['quality'])){
    
    $pi = $_POST['pid'];
    
    $sql = "UPDATE  track SET status = 'quality' WHERE pid = '$pi'";
    
       if(mysqli_query($link, $sql)){
           
           $msg = "package checked";
           
       }else{
           
           $msg = "package not checked"; 
       }
      

    
}




if(isset($_POST['dispatch'])){
    
    $pi = $_POST['pid'];
    
    $sql = "UPDATE  track SET status = 'dispatch' WHERE pid = '$pi'";
    
       if(mysqli_query($link, $sql)){
           
           $msg = "package Dispatched";
           
       }else{
           
           $msg = "package not Dispatched"; 
       }
      

    
}





if(isset($_POST['deliver'])){
    
    $pi = $_POST['pid'];
    
    $sql = "UPDATE  track SET status = 'deliver' WHERE pid = '$pi'";
    
       if(mysqli_query($link, $sql)){
           
           $msg = "package delivered";
           
       }else{
           
           $msg = "package not delivered"; 
       }
      

    
}

?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>






  <!-- Main Content -->
      <div class="main-content">

        <section class="section">

          <div class="section-header">
            <h1><i class="fa fa-users" style="font-size:30px"></i> PACKAGE PROGRESS CONTROL</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href=""><?php echo $name;?></a></div>
                 <div class="breadcrumb-item"></div>
            </div>
          </div>

<?php 

$pids = $_GET['pid'];
?>





	<?php 
			
			$sql= "SELECT * FROM track WHERE pid = '$pids'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result); 
              
				$row['status'];
				
				
				if(isset($row['status']) && $row['status'] == "confirm" ){

				$confirm = 'Package Confirmed';
				
				}else{
				    
				    	$confirm = 'Confirm';
				    
				}
				
				
				
	if(isset($row['status']) && $row['status'] == "process" ){

				$process = 'Package processed';
			
				}else{
				    
				    	$process = 'Process';
				    
				}
				
				
				if(isset($row['status']) && $row['status'] == "dispatch" ){

				$dispatch = 'Package Dispatched';
			
				}else{
				    
				    	$dispatch = 'Dispatch';
				    
				}
				
				
				
			if(isset($row['status']) && $row['status'] == "quality" ){

				$quality = 'Package Checked';
			
				}else{
				    
				    	$quality = 'check';
				    
				}
				
				
				
				if(isset($row['status']) && $row['status'] == "deliver" ){

				$deliver = 'Package Delivered';
			
				}else{
				    
				    	$deliver = 'Deliver';
				    
				}
				
				  
			  }
				  
				  ?>
	



<div class="container">
    
     <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
    
    
    <form action="ocontrol.php?pid=<?php echo $pids;?>" method="POST">

<input name="pid" type="hidden" value="<?php echo $pids;?>">
  <button  name="confirm" type="submit" class="btn btn-primary"><?php echo $confirm;?></button>
  <button  name="process" type="submit" class="btn btn-secondary"><?php echo $process;?></button>
  <button  name="quality" type="submit" class="btn btn-success"><?php echo $quality;?></button>
  <button name="dispatch" type="submit" class="btn btn-info"><?php echo $dispatch;?></button>
  <button name="deliver" type="submit" class="btn btn-warning"><?php echo $deliver;?></button>

  
       </form>
</div>

</body>
</html>
