<!DOCTYPE html>
<!--
-->
<?php include('../header.php');
    if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
    header("Location: logout.php");
    die();
}
?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>                         

        </title>

<div class="container">
            <div class="row main-low-margin text-center">
                <div class="col-md-offset-10 col-md-2 col-sm-2">
                    <a class="btn btn-primary btn-lg glyphicon glyphicon-log-out" type="link" href="student_book_list.php">volver</a>
                </div>
            </div>  
        </div>

    </head>
    <body>
    <?php
    $link = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
            $result = '';
            
              $result = mysqli_query($link,"Select * from tbl_library_book_list where b_id =".$_GET['id']); 
              
            if($row = mysqli_fetch_array($result)){
                if($row['quantity']==""){?>
        <p>NO tiene archivos</p>
                <?php }else{ ?>
                   <iframe width="100%" height="800px" src="../tareas/<?php echo $row['quantity']; ?>"></iframe>﻿     
                 
                <?php } }   ?>





<?php include('../copyright.php');?>

<?php include('../footer.php');?>
              

       </body>
</html>

 