<?php
session_start();

$id = $_SESSION["id"];
$entreprise = $_SESSION["entreprise"];
$newmode = $_POST["mode"];

$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$daysLeft = cal_days_in_month(CAL_GREGORIAN, date("m"), date("y")) - date("d");
echo $daysLeft;

for ($i = 1; $i < $daysLeft + 1; $i++) {

    $sql5 = "select Dayofweek(date(now()) + INTERVAL $i DAY)";
    $res5 = mysqli_query($con, $sql5);
    $row5 = mysqli_fetch_row($res5);
    print_r($row5);

    if ($row5[0] != 1 and $row5[0] != 7) {
        $sql = "update horaireEntreprise set modeHoraire = $newmode where entreprise = $entreprise and jour = date(now()) + INTERVAL $i DAY";
        mysqli_query($con, $sql);
    }
}

header("Location:../Responsable/home.php");
exit();
