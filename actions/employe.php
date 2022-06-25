<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$mdp = $_POST["mdp"];
$invitationCode = $_POST["invitationCode"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$sql = "select id from Entreprise where invitationCode = $invitationCode";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_row($res);

$sql1 = "insert into Utulisateur(nom,prenom,type,email,motdepasse,Entreprise,photo) values 
                               ('$nom','$prenom','employe','$email','$mdp',$row[0],'user.png')";
mysqli_query($con, $sql1);
$idE = mysqli_insert_id($con);

mkdir("../users/user_$idE");
copy("C:\\xampp\\htdocs\\Projet\\images\\user.png", "../users/user_$idE/user.png");

$daysLeft = cal_days_in_month(CAL_GREGORIAN, date("m"), date("y")) - date("d");

for ($i = 0; $i < $daysLeft + 1; $i++) {

    $sql5 = "select Dayofweek(date(now()) + INTERVAL $i DAY)";
    $res5 = mysqli_query($con, $sql5);
    $row5 = mysqli_fetch_row($res5);

    if ($row5[0] == 1 or $row5[0] == 7) {
        $sql4 = "insert into horaireEmploye(employe,dateJour,statut) values ($idE, date(now()) + INTERVAL $i DAY,'weekend')";
        mysqli_query($con, $sql4);
    } else {
        $sql6 = "insert into horaireEmploye(employe,dateJour,statut) values ($idE, date(now()) + INTERVAL $i DAY,'active')";
        mysqli_query($con, $sql6);
    }
}

header("Location:../index.html");
exit();
