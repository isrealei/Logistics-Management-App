<?php
session_start();

  $ids = $_GET['id'];
if(isset($_SESSION['uid'])){
 

  include '../../config/database.php';
  include '../../config/config.php';
  include 'header.php';
  $msg = "";

}
else{

    header("location:../pages/login.php");
}



?>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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


  #td1 {
  border: 2px solid black;
}
</style>
  </head>
  <body>

  <!-- Main Content -->
      <div class="main-content">

        <section class="section">

          <div class="section-header">
            <h1><i class="fa fa-users" style="font-size:30px"></i> PRINT PACKAGE RECEIPT</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href=""><?php echo $name;?></a></div>
                 <div class="breadcrumb-item"></div>
            </div>
          </div>
        
        
        
        
        




   



<style>


.v3 {
  border-left: 1px solid black;
  height: 45px;
}


.vl {
  border-left: 3px solid black;
  height: 50px;
}
</style>


    <input type="button" id="create_pdf" value="Generate PDF">  






  <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>






    <form class="form" style="max-width: none; width: 1005px;">
        
         <?php 
 
   $ids = $_GET['id'];

 
 
 $sql= "SELECT * FROM track WHERE id = $ids";
	$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
				 $pid = $row['pid'];	 
			  
				  if(isset($row['pid'])){
				      
$pid = $row['pid'];					
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

  
            
            <div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">
     
         <th ></th>  
                        <p align="center"><img src="code.png">
                        <span></br>
                        *<?php echo $pid;?>*</span></p>
                        </br>
                         <h2 align="center"> <?php echo $pid;?></h2>
 <hr></hr>
 
            <table align="center"> 
            
            
                <tbody>  
                    <tr>  
                    
                    
                       <th>SENDER  </th>
                        <th> &nbsp;</th>  
                        <th style="text-align:center">RECEIVER</th>
                    </tr>  
                    <tr>  
                        <td><?php echo $row['saddress'];;?>
                        </br>
                        <?php echo $sname;?>
                        </td>  
                         <td ><div class="vl"></div></th>   
                        <td style="text-align:center"><?php echo $raddress;?>
                        </br>
                        <?php echo $rname;?>
                        </td>  
                    </tr>  
                    
                       <tr>  
                        <td></br></td>  
                        <td></br></td>  
                        <td></br></td>  
                    </tr>  
                    
                    
                    <tr>  
                       <th style="text-align:center">Origin  </th>
                        <th> &nbsp;</th>  
                        <th style="text-align:center">Destination</th>
                    </tr>  
                    <tr>  
                        <td><?php echo $saddress;?></td>  
                         <th><div class="vl"></div></th>   
                        <td style="text-align:center"><?php echo $raddress;?></br>
                        <?php echo $email;?></td>  
                    </tr>  
                    
                    
                 
                    
                    
                 
                    <tr id="td1">  
                        <th>WEIGHT VOLUME
                        </br>
                        <?php echo $row['weight'];?>
                        </th>  
                       <td><div class="v3"></div></td>    
                        <th style="text-align:center"><b>TERM</b>
                        </br>
                        <?php echo $row['servicetype'];?>
                        </th>  
                    </tr>  
                    <tr id="td1">  
                        <th>PHYSICAL WEIGHT
                        </br>
                        <?php echo $row['servicetype'];?>
                        </th>  
                       <td><div class="v3"></div></td>    
                        <th style="text-align:center"># OF PIECES
                        </br>
                        <?php echo $row['qty'];?>
                        </th>  
                    </tr>  
                </tbody>  
            </table>  
            </br>
            <p align="center"><b> ISSUE DATE</b></p>
            <p align="center"><b> <?php echo $shipdate;?></b></p>
        </form>  










      

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  

            
          <script>  
    (function () {  
        var  
         form = $('.form'),  
         cache_width = form.width(),  
         a4 = [595.28, 841.89]; // for a4 size paper width and height  
  
        $('#create_pdf').on('click', function () {  
            $('body').scrollTop(0);  
            createPDF();  
        });  
        //create pdf  
        function createPDF() {  
            getCanvas().then(function (canvas) {  
                var  
                 img = canvas.toDataURL("image/png"),  
                 doc = new jsPDF({  
                     unit: 'px',  
                     format: 'a4'  
                 });  
                doc.addImage(img, 'JPEG', 20, 20);  
                doc.save('Bhavdip-html-to-pdf.pdf');  
                form.width(cache_width);  
            });  
        }  
  
        // create canvas object  
        function getCanvas() {  
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');  
            return html2canvas(form, {  
                imageTimeout: 2000,  
                removeContainer: true  
            });  
        }  
  
    }());  
</script>  
<script>  
    /* 
 * jQuery helper plugin for examples and tests 
 */  
    (function ($) {  
        $.fn.html2canvas = function (options) {  
            var date = new Date(),  
            $message = null,  
            timeoutTimer = false,  
            timer = date.getTime();  
            html2canvas.logging = options && options.logging;  
            html2canvas.Preload(this[0], $.extend({  
                complete: function (images) {  
                    var queue = html2canvas.Parse(this[0], images, options),  
                    $canvas = $(html2canvas.Renderer(queue, options)),  
                    finishTime = new Date();  
  
                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);  
                    $canvas.siblings().toggle();  
  
                    $(window).click(function () {  
                        if (!$canvas.is(':visible')) {  
                            $canvas.toggle().siblings().toggle();  
                            throwMessage("Canvas Render visible");  
                        } else {  
                            $canvas.siblings().toggle();  
                            $canvas.toggle();  
                            throwMessage("Canvas Render hidden");  
                        }  
                    });  
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);  
                }  
            }, options));  
  
            function throwMessage(msg, duration) {  
                window.clearTimeout(timeoutTimer);  
                timeoutTimer = window.setTimeout(function () {  
                    $message.fadeOut(function () {  
                        $message.remove();  
                    });  
                }, duration || 2000);  
                if ($message)  
                    $message.remove();  
                $message = $('<div ></div>').html(msg).css({  
                    margin: 0,  
                    padding: 10,  
                    background: "#000",  
                    opacity: 0.7,  
                    position: "fixed",  
                    top: 10,  
                    right: 10,  
                    fontFamily: 'Tahoma',  
                    color: '#fff',  
                    fontSize: 12,  
                    borderRadius: 12,  
                    width: 'auto',  
                    height: 'auto',  
                    textAlign: 'center',  
                    textDecoration: 'none'  
                }).hide().fadeIn().appendTo('body');  
            }  
        };  
    })(jQuery);  
  
</script>