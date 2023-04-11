<?php

 

 
$sqlu= "SELECT * FROM track  ";
			  $resultu = mysqli_query($link,$sqlu);
			  if(mysqli_num_rows($resultu) > 0){
				
              $totalu= mysqli_num_rows($resultu);
				
			  }else{
				$totalu = 0  ;
			  }
			  

	
?>


