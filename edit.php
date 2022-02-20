<?php
    include "connect.php";
    //error_reporting(0);

    $matr = $_GET['matr'];
    $photo = $_GET['pic'];
    $sql_data = "SELECT * FROM employe WHERE 
    matricule = '$matr'";
    $result = $conn->query($sql_data);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Document</title>
</head>

<body>
     <!-- navbar -->
     <?php include 'navbar.html';?>
    <!--  -->
   <main  class="bg text-center">
   <form class="centered row " action="edit.php?matr=<?php echo $matr ."&pic=$photo"?>" method="POST" enctype="multipart/form-data">
        <input class="InputStyle col-12" type="text" name="nom" value="<?php echo $row["nom"]; ?>">
        <input class="InputStyle col-12" type="text" name="prénom" value="<?php echo $row["prénom"]; ?>">
        <input class="InputStyle col-12" type="date" name="date_naissance" value="<?php echo $row["date_naissance"] ; ?>">
        <input class="InputStyle col-12" type="text" name="département" value="<?php echo $row["département"]; ?>">
        <input class="InputStyle col-12" type="number" step="any" name="salaire" value="<?php echo $row["salaire"]; ?>">
        <input class="InputStyle col-12" type="text" name="fonction" value="<?php echo $row["fonction"];?>">
        <img src="images/<?php echo $row["photo"];?>" alt="ok">
        <input class="InputStyle col-12"type="file" name="uploadfile">
        <input id="subm" class="InputStyle btn btn-outline-dark col-4" type="submit" name="edit" value="edit">
    </form>
  </main>

</body>

</html>

<?php 
    if(isset($_POST["edit"])){
        $matri = $_GET["matricule"];
        $nom = $_POST["nom"];
        $prénom = $_POST["prénom"];
        $date = $_POST["date_naissance"];
        $dépa = $_POST["département"];
        $salaire = $_POST["salaire"];
        $fonction = $_POST["fonction"];

        $fileName = $_FILES["uploadfile"]["name"];
        $tempName = $_FILES["uploadfile"]["tmp_name"];
        $folder = "images/" . $fileName;

        if($fileName == ""){
            $fileName = $photo;
        }
        
        //update request
        $sql_update = "UPDATE employe
        SET nom = '$nom', prénom= '$prénom', date_naissance= '$date', département='$dépa', salaire='$salaire', fonction='$fonction', photo='$fileName'
        WHERE matricule = '$matr'";
        echo $sql_query;
        $msg="";
         // move the uploaded image into the folder: images
         if (move_uploaded_file($tempName, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }
        
        if(mysqli_query($conn, $sql_update)){
            $msg = "ok";
        }
        else{
            $msg = "no";
        }
        header("location: index.php");
    }
?>
