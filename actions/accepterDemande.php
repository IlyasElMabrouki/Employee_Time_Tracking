<?php
$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$id = $_GET["id"];

$sql = "update Congé set reponse = 'acceptée' where id = $id";
mysqli_query($con, $sql);

$sql1 = "select employe,jourdebut,nombreJours from Congé where id = $id";
$res = mysqli_query($con, $sql1);
$row = mysqli_fetch_row($res);

for ($i = 0; $i < $row[2]; $i++) {

    $sql2 = "update horaireEmploye set statut = 'congé' where employe = $row[0] and dateJour = '$row[1]' + INTERVAL $i DAY";
    mysqli_query($con,$sql2);
}

header("Location:../Responsable/conge.php");
exit();
