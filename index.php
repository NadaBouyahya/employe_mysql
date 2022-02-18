<?php
    include "connect.php";
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <table class="table table-striped">
        <tr>
            <th>matricule</th>
            <th>nom</th>
            <th>prénom</th>
            <th>date_naissance</th>
            <th>département</th>
            <th>salaire</th>
            <th>fonction</th>
            <th>Photo</th>
            <th>setting</th>
     
        </tr>
            <?php
             if(isset($_GET['rn'])){
                $matricule = $_GET['rn']; 
                $query = "DELETE FROM employe WHERE matricule = '$matricule'";
             
                $data = mysqli_query($conn, $query); //delete record from database 
             
                if($data){
                    echo "record deleted";
                }
                else{
                    echo "failed to delete";
                }
             }
                $sql = "SELECT * FROM employe;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck >0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "
                        <tr> 
                            <td>" . $row["matricule"] ."</td>
                            <td>" . $row["nom"] . "</td> 
                            <td>" . $row["prénom"] . "</td> 
                            <td>" . $row["date_naissance"] . "</td> 
                            <td>" . $row["département"] . "</td>
                            <td>" . $row["salaire"] . "</td>
                            <td>" . $row["fonction"] . "</td> 
                            <td> <img src=images/" . $row["photo"] ."></td> 
                            <td> <a href='index.php?rn=$row[matricule]' onClick=\"return confirm('are you sure?')\"> <img class='update' src='delete.png'></a> 
                                 <a href='edit.php?rn=$row[matricule]'> <img class='update' src='write.png'></a> 
                            </td>
                         </tr>
                         ";
                    
                    }
                }
               
            ?>
    </table>
</body>
</html>