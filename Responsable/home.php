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
            font-size: 1rem;
        }

        .card-body h3 {
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
            height: 40vh;
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
            margin-right: 800px;
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

        .form #l1 {
            top: 0px;
        }

        .form .radio {
            position: absolute;
            top: 0px;
            height: 75%;
            width: 75%;
            font-size: 5px;
            left: 170px;
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
    // pour savoir le nombre des demandes recus
    $sql = "select count(*) from Congé where entreprise = $entreprise and reponse = 'en attente'";
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
            <h3><a id="modal-btn1" href="#">Mode Travail</a></h3>
            <h3><a id="modal-btn2" href="#">Jour Férie </a></h3>
            <h3><a href="../actions/logout.php">Se Déconnecter</a></h3>
            <a id="modal-btn3" href="#"><img src="<?php echo "../users/user_$id/$photo"; ?>" width="45" height="45"></a>
        </header>

        <?php
        $sql11 = "select modeHoraire from horaireEntreprise where entreprise = $entreprise and jour = date(now())";
        $res11 = mysqli_query($con, $sql11);
        $row11 = mysqli_fetch_row($res11);
        ?>

        <div class="modal-overlay" id="modal-overlay1">
            <div class="modal-container" id="modal3">
                <form method="POST" action="../actions/modifierMode.php" class="form">
                    <div class="field">
                        <div class="label" id="l1">Normal</div>
                        <input class="radio" type="radio" name="mode" value="1" <?php if ($row11[0] == 1) echo 'checked' ?>>
                    </div>
                    <div class="field">
                        <div class="label" id="l1">Ramadan</div>
                        <input class="radio" type="radio" name="mode" value="2" <?php if ($row11[0] == 2) echo 'checked' ?>>
                    </div>
                    <div class="field">
                        <input type="submit" value="Modifier" name="modifierMode" class="button-form">
                    </div>
                </form>
                <button class="close-btn" id="close-btn1"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="modal-overlay" id="modal-overlay2">
            <div class="modal-container" id="modal2">
                <form method="POST" action="../actions/ajouJourFerie.php" class="form">
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
                <button class="close-btn" id="close-btn2"><i class="fas fa-times"></i></button>
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
                <form method="POST" action="../actions/modifierCompte.php" class="form" enctype="multipart/form-data">
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

        <main>
            <div class="dash-cards">
                <?php
                // pour afficher invitation code de l'entreprise
                $sql5 = "select invitationCode from Entreprise where id = $entreprise";
                $res5 = mysqli_query($con, $sql5);
                $row5 = mysqli_fetch_row($res5);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/inviter.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Code d'Invitation</p><br>
                            <h3><?php echo "$row5[0]<br>"; ?></h3>
                        </div>
                    </div>
                </div>

                <?php
                $sql1 = "select modeHoraire,heureDebut,heureFin,type from horaireEntreprise inner join modeHoraire on horaireEntreprise.modeHoraire = modehoraire.id where entreprise = $entreprise and jour = date(now())";
                $res1 = mysqli_query($con, $sql1);
                $row1 = mysqli_fetch_row($res1);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/calendar.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Mode Du Jour</p><br>
                            <h3 style="text-transform: capitalize;"><?php echo $row1[3]; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/horloge.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Heure Debut / Heure Fin</p><br>
                            <h3><?php echo "$row1[1] / $row1[2]"; ?></h3>
                        </div>
                    </div>
                </div>

                <?php
                $sql3 = "select count(*) from Utulisateur where type = 'employe' and entreprise = $entreprise";
                $res3 = mysqli_query($con, $sql3);
                $row3 = mysqli_fetch_row($res3);

                $sql4 = "select count(*) from horaireEmploye inner join Utulisateur on Utulisateur.id = horaireEmploye.employe where datejour = date(now()) and heureDebut is not null and entreprise = $entreprise";
                $res4 = mysqli_query($con, $sql4);
                $row4 = mysqli_fetch_row($res4);
                ?>

                <div class="card-single">
                    <div class="card-body">
                        <span>
                            <img src="../images/businessman.png" width="40" height="40">
                        </span>
                        <div>
                            <p>Présents / Total Employés</p><br>
                            <h3><?php echo "$row4[0] / $row3[0]"; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">

                        <?php
                        $sql2 = "select nom,prenom,photo,heureDebut,heureFin,statut,Utulisateur.id from horaireEmploye inner join Utulisateur on horaireEmploye.employe = Utulisateur.id where entreprise = $entreprise and dateJour = date(now())";
                        $res2 = mysqli_query($con, $sql2);
                        if (mysqli_num_rows($res2) > 0) {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Profil</th>
                                        <th>Nom Complet</th>
                                        <th>Statut</th>
                                        <th>Heure d'Arrivée</th>
                                        <th>Heure de Départ</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_row($res2)) {
                                        if ($row[3] != null) {
                                            $row[3] = date("H:i:s", strtotime($row[3]));
                                        }
                                        if ($row[4] != null) {
                                            $row[4] = date("H:i:s", strtotime($row[4]));
                                        }
                                        $photo = "../users/user_$row[6]/$row[2]";
                                        echo ("<tr><td><img src=$photo width='40' height='40'></td><td style='text-transform: capitalize';>$row[0] $row[1]</td><td style='text-transform: capitalize';>$row[5]</td><td>$row[3]</td><td>$row[4]</td><td><a class='a1' href='detailsEmploye.php?id=$row[6]'><img src='../images/more.png' width='20' height='20'></a></td></tr>");
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
    <script src="app.js"></script>
</body>

</html>