<?php
$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");
session_start();
$id = $_SESSION["id"];
$counter = $_POST["counter"];

if (isset($_POST["in"])) {
    $sql1 = "update horaireEmploye set heureDebut = now() where employe = $id and dateJour = date(now())";
    mysqli_query($con, $sql1);
} 
else {
    $sql2 = "update horaireEmploye set heureFin = now(), dureeTravailé = timediff(heureFin,heureDebut), credibilite = $counter where employe = $id and dateJour = date(now())";
    mysqli_query($con, $sql2);
}

header("Location:../Employe/home.php");
exit();
