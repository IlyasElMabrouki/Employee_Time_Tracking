<?php
$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");
$id = $_GET["id"];

$sql = "update Congé set reponse = 'refusée' where id = $id";
mysqli_query($con,$sql);

header("Location:../Responsable/conge.php");
exit();