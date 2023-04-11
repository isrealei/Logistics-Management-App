<?php

$sql= "SELECT * FROM settings ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
                  $row = mysqli_fetch_assoc($result);
                  $currency = $row['currency'];
                  $name = $row['bname'];
                  $logo = $row['logo'];
                  $emaila = $row['email'];
                  $phone = $row['phone'];
                  $address = $row['baddress'];
                  $title = $row['title'];
                  $branch = $row['branch'];
                  $bankurl = $row['sname'];
                  $sms_public_key = $row['apipu'];
                  $sms_private_key = $row['apipr'];
           


				  }
        
                  if(isset($row['bname'])  && isset($row['logo']) && isset($row['title']) && isset($row['apipu']) && isset($row['baddress']) && isset($row['branch']) ){
                    $currency = $row['currency'];
                    $name = $row['bname'];
                  $logo = $row['logo'];
                  $emaila = $row['email'];
                  $phone = $row['phone'];
                  $address = $row['baddress'];
                  $title = $row['title'];
                  $branch = $row['branch'];
                  $bankurl = $row['sname'];
                  $sms_public_key = $row['apipu'];
                  $sms_private_key = $row['apipr'];
       $id = $row['id'];
                }else{
                     $id = '';
                    $name = '';
                    $logo = '';
                    $emaila = '';
                    $phone = '';
                    $address = '';
                    $title = '';
                    $branch = '';
                    $bankurl = '';
                    $sms_public_key = '';
                    $sms_private_key = '';
        }

?>