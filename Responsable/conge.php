<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Demandes Congés</title>
    <?php
    session_start();
    $con = mysqli_connect("localhost", "root", "ilyas-2002", "horaires");
    $id = $_SESSION["id"];
    $entreprise = $_SESSION["entreprise"];
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

        .btn{
            width: 100%;
            border: none;
            background: #075ac1;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            padding: 10px;
            margin-right: 4px;
        }

    </style>

</head>

<body>
    <div class="main-content">
        <header>

        </header>
        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">

                        <?php
                        $sql = "select * from Congé inner join utulisateur on utulisateur.id = congé.employe where congé.entreprise = $entreprise and reponse = 'en attente'";
                        $res = mysqli_query($con, $sql);
                        if (mysqli_num_rows($res) > 0) {
                        ?>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Profil</th>
                                        <th>Nom Complet</th>
                                        <th>Jour envoie Demande</th>
                                        <th>Jour Debut</th>
                                        <th>Nombre de Jours</th>
                                        <th>la Cause</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_row($res)) {
                                        $photo = "../users/user_$row[9]/$row[16]";
                                        $time1 = date("d-m-Y",strtotime($row[3]));
                                        $time2 = date("d-m-Y",strtotime($row[4]));
                                        echo "<tr><td><img src=$photo width='40' height='40'></td><td style='text-transform: capitalize';>$row[10] $row[11]</td><td>$time1</td><td>$time2</td><td>$row[5]</td><td style='text-transform: capitalize';>$row[6]</td><td><a class='btn' href='../actions/accepterDemande.php?id=$row[0]'>Accepter</a> <a class='btn' href='../actions/refuserDemande.php?id=$row[0]'>Refuser</a></td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>