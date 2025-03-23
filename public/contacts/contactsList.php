<?php
define('ROOT', dirname(__DIR__, 2));
require ROOT."/layout/layoutFunctions.php";
session_start();
echo htmlHead("Contacts", "../style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <!-- le menu principal -->
            <?= deconnexionMenu("../") ?>

            <div id="corps">
                <h1>Contacts</h1>
                <h2>Ajouter un contact</h2>
                <p>
                    <a href="addContact.php">Formulaire d'ajout</a>
                </p>
                <h2>Liste des contacts</h2>
                <?php
                // On se connecte au la SGBD Mysql
                include(ROOT."/utils/connexion_db.php");

                $contacts = $bdd->prepare("
                    SELECT contacts.id, contacts.firstname, contacts.lastname
                    FROM contacts
                    INNER JOIN users ON users.id = contacts.user_id
                    WHERE users.id = :user_id
                    AND contacts.deleted = 0;
                ");
                $contacts->execute([
                    "user_id"=> $_SESSION["user_id"],
                ]);
                $data = $contacts->fetchAll();
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Détails</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i < count($data); $i++) :?>
                            <tr>
                                <td><?= $data[$i]["firstname"]; ?></td>
                                <td><?= $data[$i]["lastname"]; ?></td>
                                <td style="text-align:center;">
                                    <a href="detailContact.php?id=<?= $data[$i]["id"]; ?>">
                                        <img src="../images/details.png" />
                                    </a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="deleteContact.php?id=<?= $data[$i]["id"]; ?>">
                                        <img src="../images/supprimer.png" />
                                    </a>
                                </td>
                            </tr>
                        <?php endfor;?>
                    </tbody>
                </table>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>