<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Details</title>
    <?php
    @session_start();
    $id = $_GET["id"];
    $entreprise = $_SESSION["entreprise"];
    $con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');


        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style-type: none;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        header {
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 100;
            background-color: #ffffff;
            height: 60px;
            padding: 0rem 1rem;
            border-bottom: solid 1px #ccc;
        }

        main {
            margin-top: 60px;
            background-color: #f1f5f9;
            min-height: 90vh;
            padding: 1rem 3rem;
        }

        .dash-title {
            color: var(--color-dark);
            margin-bottom: 1rem;
        }

        .dash-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-column-gap: 3rem;
        }

        .card-single {
            background-color: #ffffff;
            border-radius: 7px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 1.3rem 1rem;
            display: flex;
            align-items: center;
        }

        .card-body span {
            font-size: 1.5rem;
            color: #777;
            padding-right: 1.4rem;
        }

        .card-body h5 {
            color: var(--text-gray);
            font-size: 1rem;
        }

        .card-body h4 {
            color: var(--color-dark);
            font-size: 1.1rem;
            margin-top: 0.2rem;
        }

        .card-footer {
            padding: 0.2rem 1rem;
            background: #f9fcfc;
        }

        .card-footer a {
            color: var(--main-color);
        }

        .recent {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: 100% 25%;
            grid-column-gap: 1.5rem;
        }

        .activity-card,
        .summery-card,
        .bday-card {
            background-color: #ffffff;
            border-radius: 7px;
        }

        .activity-card h3 {
            color: var(--text-gray);
            margin: 1rem;
        }

        .activity-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .activity-card thead {
            background: #efefef;
            text-align: left;
        }

        th,
        td {
            font-size: 0.9rem;
            padding: 1rem 1rem;
            color: var(--color-dark);
            text-align: center;
        }

        td {
            font-size: 0.8rem;
        }

        tbody tr:nth-child(even) {
            background: #f9fafc;
        }

        .td-team {
            display: flex;
            align-items: center;
        }

        #other {
            height: 10vh;
            width: 100%;
            display: flex;
            align-items: end;
            justify-content: space-between;
        }

        #title {
            margin-left: 20px;
        }

        #generer {
            width: 100%;
            border: none;
            background: #075ac1;
            margin-top: -20px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            padding: 10px;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <header>

        </header>

        <main>
            <div class="dash-cards">
                <?php
                $sql3 = "select nom, prenom from Utulisateur where id = $id";
                $res3 = mysqli_query($con, $sql3);
                $row3 = mysqli_fetch_row($res3);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/name.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Nom Complet</p><br>
                            <h3 style="text-transform:capitalize;"><?php echo "$row3[0] $row3[1]"; ?></h3>
                        </div>
                    </div>
                </div>

                <?php
                $sql6 = "select sec_to_time(sum(time_to_sec(dureeDeTravail))) from modeHoraire inner join horaireEntreprise on horaireEntreprise.modeHoraire = modeHoraire.id and entreprise = $entreprise and jour <= date(now())";
                $res6 = mysqli_query($con, $sql6);
                $row6 = mysqli_fetch_row($res6);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                        <img src="../images/icons8-société-64.png" width="45" height="45">
                        </span>
                        <div>
                            <p>Durée Total De Travail </p><br>
                            <h3><?php echo $row6[0]; ?></h3>
                        </div>
                    </div>
                </div>

                <?php
                $sql5 = "select sec_to_time(sum(time_to_sec(dureeTravailé))) from horaireEmploye where employe = $id";
                $res5 = mysqli_query($con, $sql5);
                $row5 = mysqli_fetch_row($res5);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/portfolio.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Durée Total Travaillée</p><br>
                            <h3><?php echo $row5[0]; ?></h3>
                        </div>
                    </div>
                </div>

                <?php
                $secs = strtotime($row5[0]) - strtotime("00:00:00");
                $result = date("H:i:s", strtotime($row6[0]) - $secs);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/moon.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Durée Total Non Travaillée</p><br>
                            <h3><?php echo $result; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div id="other">
                <h3 id="title">Activité du mois</h3>
                <form method="POST" action="../pdf/index.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="generer" value="Generer Rapport" id="generer">
                </form>
            </div>


            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">

                        <?php
                        $sql = "select datejour,heureDebut,heureFin,statut,dureeTravailé,credibilite from horaireEmploye where employe = $id and dateJour <= date(now())";
                        $res = mysqli_query($con, $sql);
                        if (mysqli_num_rows($res) > 0) {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Jour</th>
                                        <th>Statut</th>
                                        <th>Heure Debut</th>
                                        <th>Heure Fin</th>
                                        <th>Durée De Travail</th>
                                        <th>Heure D'Arrivée</th>
                                        <th>Heure De Départ</th>
                                        <th>Durée Travaillé</th>
                                        <th>Durée Non Travaillé</th>
                                        <th>Indice de Credibilité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_row($res)) {
                                        if ($row[3] == "ferie" or $row[3] == "congé" or $row[3] == "weekend") {
                                            echo ("<tr><td>$row[0]</td><td>$row[3]</td></tr>");
                                        } else {
                                            if ($row[1] != null) {
                                                $row[1] = date("H:i:s", strtotime($row[1]));
                                            }
                                            if ($row[2] != null) {
                                                $row[2] = date("H:i:s", strtotime($row[2]));
                                            }

                                            $sql0 = "select heureDebut,heureFin,dureeDeTravail from modeHoraire inner join horaireEntreprise on horaireEntreprise.modeHoraire = modeHoraire.id where jour = '$row[0]' and entreprise = $entreprise";
                                            $res0 = mysqli_query($con, $sql0);
                                            $row0 = mysqli_fetch_row($res0);

                                            $secs = strtotime($row[4]) - strtotime("00:00:00");
                                            $result = date("H:i:s", strtotime($row0[2]) - $secs);
                                            $time = date("d-m-Y", strtotime($row[0]));

                                            echo ("<tr><td>$time</td><td style='text-transform: capitalize';>$row[3]</td><td>$row0[0]</td><td>$row0[1]</td><td>$row0[2]</td><td>$row[1]</td><td>$row[2]</td><td>$row[4]</td><td>$result</td><td>$row[5]</td></tr>");
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>