<?php
session_start();

$id = $_SESSION["id"];
$entreprise = $_SESSION["entreprise"];
$nombreJours = $_POST["nombrejours"];
$cause = $_POST["cause"];
$jourdebut = $_POST["datedebut"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$sql = "insert into Congé(employe,entreprise,jour,jourDebut,nombreJours,cause) values ($id,$entreprise,date(now()),'$jourdebut',$nombreJours,'$cause')";
mysqli_query($con,$sql);

header ("Location:../Employe/home.php");
exit();
