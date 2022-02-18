<?php
include "connect.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <nav class="p-4 navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand">Company Name</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Employees</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> -->
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    </nav>

    <main class="bg text-center">
        <form class="centered row " action="employeForm.php" method="POST" enctype="multipart/form-data">
            <input class="InputStyle col-12" type="text" name="matricule" placeholder="Matricule">
            <input class="InputStyle col-12" type="text" name="nom" placeholder="Nom">
            <input class="InputStyle col-12" type="text" name="prénom" placeholder="Prénom">
            <input class="InputStyle col-12" type="date" name="date_naissance" placeholder="date de naissance">
            <input class="InputStyle col-12" type="text" name="département" placeholder="département">
            <input class="InputStyle col-12" type="number" onchange="setTwoNumberDecimal" min="0" max="" step="any" value="0.00" name="salaire" placeholder="salaire">
            <input class="InputStyle col-12" type="text" name="fonction" placeholder="fonction">
            <input class="InputStyle col-12" type="file" name="uploadfile" value="">
            <input id ="subm" class="InputStyle btn btn-outline-dark col-4" type="submit" name="submit" value="Submit">
        </form>
    </main>

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
        move_uploaded_file($tempName, $folder);
      
        //excute query
        mysqli_query($conn, $sql);

        //  if (mysqli_query($conn, $sql)) {
        //     echo "New line has been added";
        // } else {
        //     echo "Error: " . $sql . ":-" . mysqli_error($conn);
        // }
        
        header("location: index.php");
    }
    ?>

    <script>
        function setTwoNumberDecimal(event) {
                this.value = parseFloat(this.value).toFixed(2);
        }
    </script>
</body>

</html>