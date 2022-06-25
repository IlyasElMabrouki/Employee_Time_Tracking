<?php
session_start();
$id = $_SESSION["id"];
$entreprise = $_SESSION["entreprise"];

$nombreJours = $_POST["nombrejours"];
$cause = $_POST["cause"];
$datedebut = $_POST["datedebut"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$sql0 = "insert into Ferie(entreprise,jour,jourDebut,nombreJours,cause) values ($entreprise,date(now()),'$datedebut',$nombreJours,'$cause')";
mysqli_query($con, $sql0);

$sql1 = "select id from Utulisateur where entreprise = $entreprise and type='employe'";
$res2 = mysqli_query($con, $sql1);

while ($row = mysqli_fetch_row($res2)) {
    for ($i = 0; $i < $nombreJours; $i++) {
        $sql2 = "update horaireEmploye set statut = 'ferie' where employe = $row[0] and dateJour = '$datedebut' + INTERVAL $i DAY";
        mysqli_query($con,$sql2);

        $sql3 = "update horaireEntreprise set modeHoraire = 5 where entreprise = $entreprise and jour = '$datedebut' + INTERVAL $i DAY";
        mysqli_query($con, $sql3);
    }
}

header("Location:../Responsable/home.php");
exit();
