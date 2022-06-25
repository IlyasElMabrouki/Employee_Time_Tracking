<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$mdp = $_POST["mdp"];

$nomEntreprise = $_POST["nomEntreprise"];
$invitationCode = $_POST["invitationCode"];
$logo = $_FILES["photo"]["name"];

@$modeHoraire = $_POST["mode"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$sql = "insert into Entreprise(nom,invitationCode,logo) values ('$nomEntreprise',$invitationCode,'$logo')";
mysqli_query($con, $sql);
$id = mysqli_insert_id($con);

mkdir("../entreprises/entreprise_$id");
move_uploaded_file($_FILES["photo"]["tmp_name"], "../entreprises/entreprise_$id/$logo");

$sql1 = "insert into Utulisateur(nom,prenom,type,email,motdepasse,Entreprise,photo) values 
                               ('$nom','$prenom','responsable','$email','$mdp',$id,'user.png')";
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
        $sql2 = "insert into horaireEntreprise(jour,modeHoraire,entreprise) values (date(now()) + INTERVAL $i DAY,6,$id)";
        mysqli_query($con, $sql2);
    } 
    else {
        $sql2 = "insert into horaireEntreprise(jour,modeHoraire,entreprise) values (date(now()) + INTERVAL $i DAY,$modeHoraire,$id)";
        mysqli_query($con, $sql2);
    }
}

header("Location:../index.html");
exit();
