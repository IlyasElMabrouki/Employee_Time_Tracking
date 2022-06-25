<?php
$id = $_POST["id"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$mdp = $_POST["mdp"];
$photo = $_FILES["photo"]["name"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$sql = "update Utulisateur set nom = '$nom', prenom = '$prenom', email = '$email', motdepasse = '$mdp', photo = '$photo' where id = $id";
mysqli_query($con,$sql);

move_uploaded_file($_FILES["photo"]["tmp_name"], "../users/user_$id/$photo");

$sql2 = "select type from Utulisateur where id = $id";
$res2 = mysqli_query($con,$sql2);
$row = mysqli_fetch_row($res2);

if ($row[0] == "employe"){
    header("Location:../Employe/home.php");
    exit();
}
else {
    header("Location:../Responsable/home.php");
    exit();
}

