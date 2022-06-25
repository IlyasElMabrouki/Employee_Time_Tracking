<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>
    <?php
    @session_start();
    $id = $_SESSION["id"];
    $entreprise = $_SESSION["entreprise"];
    $con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
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
            display: flex;
            align-items: center;
            justify-content: end;
            border-bottom: solid 1px #ccc;
        }

        main {
            margin-top: 60px;
            background-color: #f1f5f9;
            min-height: 90vh;
            padding: 1rem 3rem;
        }

        .recent {
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

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(212, 215, 216, 0.5);
            display: grid;
            place-items: start;
            justify-content: center;
            visibility: hidden;
            z-index: -10;
        }

        #pointage {
            height: 15vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .p1 {
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
        }

        .modal-container {
            padding-top: 20px;
            margin-top: 70px;
            background: #fff;
            border-radius: 0.5rem;
            width: 90vw;
            height: 80vh;
            max-width: 450px;
            text-align: center;
            display: grid;
            place-items: center;
            position: relative;
        }

        #modal2 {
            height: 53vh;
        }

        #modal3 {
            height: 20vh;
        }

        .close-btn {
            position: absolute;
            top: 0.5rem;
            right: 1rem;
            font-size: 2rem;
            background: transparent;
            border-color: transparent;
            color: red;
            cursor: pointer;
        }

        .open-modal {
            visibility: visible;
            z-index: 10;
        }

        header {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }

        #logo {
            margin-right: 900px;
        }

        .a1 {
            margin-left: 10px;
        }

        .form {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }

        .form .field {
            width: 330px;
            height: 35px;
            margin: 30px 0;
            display: flex;
            position: relative;
        }

        .form .label {
            position: absolute;
            top: -30px;
            font-weight: 500;
        }

        .form input {
            height: 100%;
            width: 100%;
            border: 1px solid lightgrey;
            border-radius: 5px;
            padding-left: 15px;
            font-size: 18px;
        }

        .form .button-form {
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
        }

        #button-form1 {
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
        }

        .icon-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            color: #333333;
            background: transparent;
            border: none;
            outline: none;
            border-radius: 50%;
        }

        .icon-button:hover {
            cursor: pointer;
        }

        .icon-button__badge {
            position: absolute;
            top: 0px;
            right: -5px;
            width: 20px;
            height: 20px;
            background: red;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        a {
            color: black;
        }

        a:hover{
            color:black;
        }

    </style>
</head>

<body>

    <?php
    $sql = "select count(*) from Congé where employe = $id and statut = 'en attente' and reponse != 'en attente'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $nbr = $row[0];

    $sql8 = "select photo from Utulisateur where id = $id";
    $res8 = mysqli_query($con, $sql8);
    $row8 = mysqli_fetch_row($res8);
    $photo = $row8[0];

    $sql9 = "select logo from Entreprise where id = $entreprise";
    $res9 = mysqli_query($con, $sql9);
    $row9 = mysqli_fetch_row($res9);
    $logo = $row9[0];
    ?>

    <div class="main-content">
        <header>
            <img id="logo" src="<?php echo "../entreprises/entreprise_$entreprise/$logo"; ?>" width="50" height="30">
            <button type="button" class="icon-button">
                <a href="conge.php"><i class="fas fa-bell" class="material-icons" style="font-size:30px; color:black;"></i></a>
                <?php
                if ($nbr != 0) {
                    echo "<span class='icon-button__badge'>$nbr</span>";
                }
                ?>
            </button>
            <h3><a id="modal-btn1" href="#">Demande Congé</a></h3>
            <h3><a href="../actions/logout.php">Se Déconnecter</a></h3>
            <a id="modal-btn3" href="#"><img src="<?php echo "../users/user_$id/$photo"; ?>" width="45" height="45"></a>
        </header>

        <div class="modal-overlay" id="modal-overlay1">
            <div class="modal-container" id="modal2">
                <form method="POST" action="../actions/envoieDemande.php" class="form" autocomplete="off">
                    <div class="field">
                        <div class="label">Date Debut</div>
                        <input type="date" name="datedebut">
                    </div>
                    <div class="field">
                        <div class="label">Nombres De Jours</div>
                        <input type="text" name="nombrejours">
                    </div>
                    <div class="field">
                        <div class="label">Cause</div>
                        <input type="text" name="cause">
                    </div>
                    <div class="field">
                        <input type="submit" name="demande" value="Valider" class="button-form">
                    </div>
                </form>
                <button class="close-btn" id="close-btn1"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <?php
        $sql10 = "select * from Utulisateur where id = $id";
        $res10 = mysqli_query($con, $sql10);
        $row10 = mysqli_fetch_row($res10);
        ?>

        <div class="modal-overlay" id="modal-overlay3">
            <div class="modal-container">
                <button class="close-btn" id="close-btn3"><i class="fas fa-times"></i></button>
                <form method="POST" action="../actions/modifierCompte.php" class="form" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo $row10[0]; ?>">
                    <div class="field">
                        <div class="label">Nom</div>
                        <input type="text" name="nom" value="<?php echo $row10[1]; ?>">
                    </div>
                    <div class="field">
                        <div class="label">Prenom</div>
                        <input type="text" name="prenom" value="<?php echo $row10[2]; ?>">
                    </div>
                    <div class="field">
                        <div class="label">Email</div>
                        <input type="text" name="email" value="<?php echo $row10[4]; ?>">
                    </div>
                    <div class="field">
                        <div class="label">Mot De Passe</div>
                        <input type="password" name="mdp" value="<?php echo $row10[5]; ?>">
                    </div>
                    <div class="field">
                        <div class="label">Photo De Profil</div>
                        <input type="file" name="photo">
                    </div>
                    <div class="field">
                        <input type="submit" name="submit" value="Modifier" class="button-form">
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-overlay" id="modal-overlay4">
            <div class="modal-container" id="modal3">
                <div class="field">
                    <button onclick="add()" id="button-form1">Marquer Votre Présence</button>
                </div>
                <button class="close-btn" id="close-btn4"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <main>
            <div id="pointage">

                <?php
                $sql2 = "select * from horaireEmploye where employe = $id and dateJour = date(now())";
                $res2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_row($res2);

                if ($row2[5] == 'active') {
                    if ($row2[3] == null and $row2[4] == null) {
                ?>
                        <form method="POST" action="../actions/pointageEmploye.php">
                            <input type="submit" name="in" value="Marquer Votre Arrivée" class="p1">
                        </form>
                    <?php
                    } else if ($row2[3] != null and $row2[4] == null) {
                    ?>

                        <script>
                            function add() {
                                counter++;
                                modal4.classList.remove("open-modal");
                                document.getElementById("counter").value = counter;
                            }

                            var counter = 0;

                            const closeBtn4 = document.getElementById("close-btn4");
                            const modal4 = document.getElementById("modal-overlay4");

                            closeBtn4.addEventListener("click", function() {
                                modal4.classList.remove("open-modal");
                            });

                            function createTitle() {
                                modal4.classList.add("open-modal");
                                setTimeout(function() {
                                    modal4.classList.remove("open-modal");
                                }, 3000);
                            }

                            setTimeout(function() {
                                createTitle()
                            }, 5000);

                            setTimeout(function() {
                                createTitle()
                            }, 10000);

                            setTimeout(function() {
                                createTitle()
                            }, 15000);
                        </script>


                        <form method="POST" action="../actions/pointageEmploye.php">
                            <input type="hidden" name="counter" value="0" id="counter">
                            <input type="submit" name="out" value="Marquer Votre Départ" class="p1">
                        </form>

                <?php
                    } else if ($row2[3] != null and $row2[4] != null) {
                        echo "<h2>Bon Travail Pour Aujourd'hui</h2>";
                    }
                } else if ($row2[5] == 'congé') {
                    echo "<h2>Vous etes en congé</h2>";
                } else if ($row2[5] == 'ferie') {
                    echo "<h2>Ce Jour est un jour Férie</h2>";
                } else if ($row2[5] == 'weekend') {
                    echo "<h2>Vous etes en Week-End</h2>";
                }
                ?>
            </div>

            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <?php
                        $sql6 = "select * from horaireEmploye where employe = $id and dateJour > date(now()) order by dateJour";
                        $res6 = mysqli_query($con, $sql6);
                        if (mysqli_num_rows($res6) > 0) {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Jour</th>
                                        <th>Statut</th>
                                        <th>Heure De Debut</th>
                                        <th>Heure De Fin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                while ($row6 = mysqli_fetch_row($res6)) {
                                    $time = date("d-m-Y", strtotime($row6[2]));
                                    if ($row6[5] == "ferie" or $row6[5] == "congé" or $row6[5] == "weekend") {
                                        echo ("<tr><td>$time</td><td style='text-transform: capitalize';>$row6[5]</td><td></td><td></td></tr>");
                                    } else {
                                        $sql0 = "select heureDebut,heureFin from modeHoraire inner join horaireEntreprise on horaireEntreprise.modeHoraire = modeHoraire.id where jour = '$row6[2]' and entreprise = $entreprise";
                                        $res0 = mysqli_query($con, $sql0);
                                        $row0 = mysqli_fetch_row($res0);

                                        echo ("<tr><td>$time</td><td style='text-transform: capitalize';>$row6[5]</td><td>$row0[0]</td><td>$row0[1]</td></tr>");
                                    }
                                }
                            }
                                ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="app.js"></script>
</body>

</html>