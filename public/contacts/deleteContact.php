<?php
define('ROOT', dirname(__DIR__, 2));
require(ROOT."/layout/layoutFunctions.php");
session_start();
echo htmlHead("Confirmation de suppression", "../style");
$contactId = intval($_GET["id"]);
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <!-- le menu principal -->
            <?= deconnexionMenu("../") ?>

            <!-- le menu des activités -->
            <div id="menu_right">
                <div class="element_menu element_to_left">
                    <h3>Activités</h3>
                    <a href="contactsList.php">Contacts</a>
                </div>
            </div>

            <!-- On charge le contact -->
            <?php
            //On se connecte au la SGBD Mysql
            include(ROOT."/utils/connexion_db.php");

            $contacts = $bdd->prepare("
                SELECT contacts.*, cities.city_name, cities.postal_code
                FROM contacts
                LEFT JOIN cities ON cities.id = contacts.city_id
                INNER JOIN users ON users.id = contacts.user_id
                WHERE users.id = :user_id
                AND contacts.id = :contact_id;
            ");
            $contacts->execute([
                "contact_id"=> $contactId,
                "user_id"=> $_SESSION["user_id"],
            ]);
            $data = $contacts->fetch();
            ?>

            <div id="corps">
                <h1>Suppression d'un contact</h1>
                <?php if ($data == false): ?>
                    <p>
                        <?= "Vous n'êtes pas autorisé à accéder à ce contact ! <br/><br/>"; ?>
                        <?= "Retournez sur la <a href='contactsList.php'>page des contacts</a>.<br/>"; ?>
                    </p>
                <?php else: ?>
                    <p>
                        Êtes vous sur de vouloir <strong>supprimer</strong> le contact suivant ?
                    </p>

                    <h2>Information du contact</h2>
                    <table>
                        <tr>
                            <td>Prénom</td>
                            <td><?= $data["firstname"]; ?></td>
                        </tr>
                        <tr>
                            <td>Nom</td>
                            <td><?= $data["lastname"]; ?></td>
                        </tr>
                        <tr>
                            <td>Addresse 1</td>
                            <td><?= $data["address_1"]; ?></td>
                        </tr>
                        <tr>
                            <td>Addresse 2</td>
                            <td><?= $data["address_2"]; ?></td>
                        </tr>
                        <tr>
                            <td>Ville</td>
                            <td><?= $data["city_name"]; ?></td>
                        </tr>
                        <tr>
                            <td>Code Postal</td>
                            <td><?= $data["postal_code"]; ?></td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td><?= $data["email"]; ?></td>
                        </tr>
                        <tr>
                            <td>Téléphone</td>
                            <td><?= $data["phone"]; ?></td>
                        </tr>
                    </table>

                    <form method="post" action="deleteContactProcess.php">
                        <input type="hidden" name="contact_id" value="<?= $data["id"]; ?>"/>
                        <button class="cta_button"><a href="contactsList.php">Annuler</a></button>
                        <input type="submit" value="Oui" class="cta_button actionButton"/>
                    </form>
                <?php endif; ?>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>