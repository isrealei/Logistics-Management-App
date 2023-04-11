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



if ($_SERVER['REQUEST_METHOD'] == "POST"){

$target_dir = "../../secure/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $msg=  "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg=  "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $msg=  "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    $msg=  "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $msg=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $msg=  "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	 $fileToUpload = $_FILES["fileToUpload"]["name"];
	 
	 $sql = "UPDATE tbl_users SET pics='$fileToUpload' WHERE email='$email'";

	  mysqli_query($link, $sql) or die(mysqli_error($link));
	 
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $msg= "User Image  ". basename( $_FILES["fileToUpload"]["name"]). " has been updated !";
    } else {
        $msg= "Sorry, there was an error uploading your file.";
    }
}

}


include "header.php";

?>

        <!-- page content -->
         
        <div class="main-content">
        <section class="section">
          <div class="section-header">
          <h2 align="center" style="color:black"> <i class="fa fa-user " style="font-size:30px"> </i> USERS IMAGE UPDATE </h2>
           
          
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    
           
         

</br>
<?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          


<form action="getimage.php?email=<?php echo $email;?>" method="POST" enctype="multipart/form-data"  class="form-horizontal form-label-left" >
  
  
  
  
   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">User Image <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="fileToUpload" id="fileToUpload" class="form-control col-md-7 col-xs-12" required >
                        </div>
                      </div>
                     
  
   <div class="col-md-6 col-md-offset-3">
                          
                          <button type="submit"  class="btn btn-primary" value="Upload Image" name="submit">Update Image</button>
                        </div>
  
   
</form>



          </div>
          <!-- /top tiles -->

          

                <div class="clearfix"></div>
             
          <br />

         

        </div>
          <div class="clearfix"></div>
        
        <!-- /footer content -->
    

   
  </body>
</html>