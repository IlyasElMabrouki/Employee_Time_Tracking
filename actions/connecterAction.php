<?php
$email = $_POST["email"];
$mdp = $_POST["mdp"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$sql = "select * from Utulisateur where email = '$email' and motdepasse = '$mdp'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) != 0) {
    $row = mysqli_fetch_row($res);

    session_start();
    $_SESSION["id"] = $row[0];
    $_SESSION["nom"] = $row[1];
    $_SESSION["prenom"] = $row[2];
    $_SESSION["type"] = $row[3];
    $_SESSION["entreprise"] = $row[6];

    if ($row[3] == "employe") {
        header("Location:../Employe/home.php");
        exit();
    } else {
        header("Location:../Responsable/home.php");
        exit();
    }
}
 else {
    header("Location:../index.html");
    exit();
}

