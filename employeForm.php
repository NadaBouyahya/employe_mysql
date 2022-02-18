<?php
include "connect.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Document</title>
</head>

<body>
    <form action="employeForm.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="matricule" placeholder="Matricule">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prénom" placeholder="Prénom">
        <input type="date" name="date_naissance" placeholder="date de naissance">
        <input type="text" name="département" placeholder="département">
        <input type="number" step="any" name="salaire" placeholder="salaire">
        <input type="text" name="fonction" placeholder="fonction">
        <input type="file" name="uploadfile" value="">
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    $msg ="";

    // if submit is clicked
    if (isset($_POST['submit'])) {
        $matricule = $_POST['matricule'];
        $nom = $_POST['nom'];
        $prénom = $_POST['prénom'];
        $date = $_POST['date_naissance'];
        $département = $_POST['département'];
        $salaire = $_POST['salaire'];
        $fonction = $_POST['fonction'];

        $fileName = $_FILES["uploadfile"]["name"];
        $tempName = $_FILES["uploadfile"]["tmp_name"];
        $folder = "images/" . $fileName;

        //insert into database table
        $sql = "INSERT INTO employe (matricule, nom, prénom, date_naissance, département, salaire, fonction, photo)
            VALUES ('$matricule','$nom','$prénom', '$date', '$département', '$salaire', '$fonction', '$fileName')";
        
        // move the uploaded image into the folder: images
        if (move_uploaded_file($tempName, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }
        
         //excute query
         if (mysqli_query($conn, $sql)) {
            echo "New line has been added";
        } else {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
    }
    ?>
</body>

</html>