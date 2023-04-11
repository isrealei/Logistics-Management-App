



<?php
include "../config/database.php";


$tid = $_GET['track'];
?>
<style>
    
    
h1,
h3 {
  text-align: center;
}

.blue-square-container {
  text-align: center;
}

.blue-square {
  background-color: #0074D9;
  width: 100px;
  height: 100px;
  display: inline-block;
}

.yellow-square {
  background-color: #FFDC00;
  width: 100px;
  height: 100px;
  margin: 0 auto;
}

.green-square {
  background-color: #3D9970;
  width: 100px;
  height: 100px;
  position: absolute;
  left: 50%;
  margin-left: -50px;
}


</style>

     <?php 
			
		 
 $sql= "SELECT * FROM track WHERE pid = $tid";
	$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
				 $pid = $row['pid'];
				  
				  ?>
                      

<h1>Product Image</h1>
<?php echo $row['pname']?>

<div class="blue-square-container">
  <div><img src="../admin/pages/pimages/<?php echo $row['image']?>" width="300" height="300"></div>
</div>

