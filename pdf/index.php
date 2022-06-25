<?php
require("fpdf.php");

@session_start();
$id = $_POST["id"];
$idR = $_SESSION["id"];
$entreprise = $_SESSION["entreprise"];
$con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage("L", 'A4', 0);


// Informations Personnelles
$sql3 = "select id,nom,prenom,photo from Utulisateur where id = $id";
$res3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_row($res3);
$photo = "../users/user_$row3[0]/$row3[3]";

$pdf->setFont("Arial", "B", 14);
$pdf->Cell(0, 10, "", 0, 2, 'C');

$pdf->Image($photo, 50, 20, 50, 50);

$pdf->Cell(0, 50, '', 0, 2);
$pdf->Cell(130, 10, $row3[1] . ' ' . $row3[2], 0, 0, 'C');

//Informations Entreprise
$sql4 = "select id,nom,logo from entreprise where id = $entreprise";
$res4 = mysqli_query($con, $sql4);
$row4 = mysqli_fetch_row($res4);


$photo2 = "../entreprises/entreprise_$row4[0]/$row4[2]";
$pdf->Image($photo2, 125, 30, 50, 30);
$pdf->Cell(17, 10, $row4[1], 0, 0, 'R');


$sql11 = "select id,nom,prenom,photo from Utulisateur where entreprise = $entreprise and type='responsable'";
$res11 = mysqli_query($con, $sql11);
$row11 = mysqli_fetch_row($res11);
$photo11 = "../users/user_$row11[0]/$row11[3]";

$pdf->Image($photo11, 200, 20, 50, 50);
$pdf->Cell(88, 10, $row11[1] . ' ' . $row11[2], 0, 1, 'R');

$pdf->Cell(0, 7, "", 0, 2, 'C');


//Informations D'activité 
$sql6 = "select sec_to_time(sum(time_to_sec(dureeDeTravail))) from modeHoraire inner join horaireEntreprise on horaireEntreprise.modeHoraire = modeHoraire.id and entreprise = $entreprise and jour <= date(now())";
$res6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_row($res6);


$sql5 = "select sec_to_time(sum(time_to_sec(dureeTravailé))) from horaireEmploye where employe = $id";
$res5 = mysqli_query($con, $sql5);
$row5 = mysqli_fetch_row($res5);


$secs = strtotime($row5[0]) - strtotime("00:00:00");
$result = date("H:i:s", strtotime($row6[0]) - $secs);

$pdf->ln();

$pdf->Cell(0, 10, "Rapport D'Activite Generer Le : " . date("d-m-Y"), 0, 0, 'C');
$pdf->ln();

$pdf->setFillColor(230, 230, 230);
$pdf->Cell(70);

$pdf->setFont("Times", "B", 10);
$pdf->Cell(50, 10, 'Duree Total De Travaille', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Duree Total Travaille', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Duree Total non Travaille', 1, 0, 'C', 1);
$pdf->ln();

$pdf->Cell(70);
$pdf->Cell(50, 10, $row6[0], 1, 0, 'C');
$pdf->Cell(50, 10, $row5[0], 1, 0, 'C');
$pdf->Cell(50, 10, $result, 1, 0, 'C');
$pdf->ln();
$pdf->ln();


$pdf->setFont("Arial", "B", 14);
$pdf->Cell(0, 10, "Liste D'Activites du mois " . date("m/Y"), 0, 0, 'C');
$pdf->ln();

$pdf->setFont("Times", "B", 10);
// Informations En details d'activités
$sql = "select datejour,heureDebut,heureFin,statut,dureeTravailé,credibilite from horaireEmploye where employe = $id and dateJour <= date(now())";
$res = mysqli_query($con, $sql);


if (mysqli_num_rows($res) > 0) {

    $pdf->setFillColor(230, 230, 230);
    $pdf->Cell(20, 10, 'Jour', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Statut', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Heure Debut', 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Heure Fin', 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Duree De Travail', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Heure Arrivee', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Heure Depart', 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Duree Travaille', 1, 0, 'C', 1);
    $pdf->Cell(35, 10, 'Duree Non Travaille', 1, 0, 'C', 1);
    $pdf->Cell(35, 10, 'Indice De Credibilite', 1, 0, 'C', 1);
    $pdf->ln();

    while ($row = mysqli_fetch_row($res)) {

        if ($row[3] == "ferie" or $row[3] == "congé" or $row[3] == "weekend") {
            $time = date("d-m-Y", strtotime($row[0]));
            $pdf->Cell(20, 10, $time, 1, 0, 'C');
            $pdf->Cell(20, 10, $row[3], 1, 0, 'C');
            $pdf->Cell(25, 10, '', 1, 0, 'C');
            $pdf->Cell(30, 10, '', 1, 0, 'C');
            $pdf->Cell(30, 10, '', 1, 0, 'C');
            $pdf->Cell(25, 10, '', 1, 0, 'C');
            $pdf->Cell(25, 10, '', 1, 0, 'C');
            $pdf->Cell(30, 10, '', 1, 0, 'C');
            $pdf->Cell(35, 10, '', 1, 0, 'C');
            $pdf->Cell(35, 10, '', 1, 0, 'C');
            $pdf->ln();
        } 
        else {
            if ($row[1] != null) {
                $row[1] = date("H:i:s", strtotime($row[1]));
            }
            if ($row[2] != null) {
                $row[2] = date("H:i:s", strtotime($row[2]));
            }

            $time = date("d-m-Y", strtotime($row[0]));

            $sql0 = "select heureDebut,heureFin,dureeDeTravail from modeHoraire inner join horaireEntreprise on horaireEntreprise.modeHoraire = modeHoraire.id where jour = '$row[0]' and entreprise = $entreprise";
            $res0 = mysqli_query($con, $sql0);
            $row0 = mysqli_fetch_row($res0);

            $secs = strtotime($row[4]) - strtotime("00:00:00");
            $result = date("H:i:s", strtotime($row0[2]) - $secs);

            $pdf->Cell(20, 10, $time, 1, 0, 'C');
            $pdf->Cell(20, 10, $row[3], 1, 0, 'C');
            $pdf->Cell(25, 10, $row0[0], 1, 0, 'C');
            $pdf->Cell(30, 10, $row0[1], 1, 0, 'C');
            $pdf->Cell(30, 10, $row0[2], 1, 0, 'C');
            $pdf->Cell(25, 10, $row[1], 1, 0, 'C');
            $pdf->Cell(25, 10, $row[2], 1, 0, 'C');
            $pdf->Cell(30, 10, $row[4], 1, 0, 'C');
            $pdf->Cell(35, 10, $result, 1, 0, 'C');
            $pdf->Cell(35, 10, $row[5], 1, 0, 'C');
            $pdf->ln();
        }
    }
}

$pdf->Output();
