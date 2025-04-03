<?php
define('ROOT', dirname(__DIR__, 2));
require_once(ROOT."/layout/layoutFunctions.php");
require_once(ROOT."/utils/check_auth.php");
echo htmlHead("Contacts", "../style");
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

            <div id="corps">
                <h1>Contact</h1>
                
                <?php
                // On se connecte au la SGBD Mysql
                include(ROOT."/utils/connexion_db.php");

                $contacts = $bdd->prepare("
                    SELECT contacts.*, cities.city_name, cities.postal_code
                    FROM contacts
                    LEFT JOIN cities ON cities.id = contacts.city_id
                    INNER JOIN users ON users.id = contacts.user_id
                    WHERE contacts.id = :contact_id
                    AND contacts.deleted = 0
                    AND users.id = :user_id;
                ");
                $contacts->execute([
                    "contact_id" => $contactId,
                    "user_id"=> $_SESSION["user_id"],
                ]);
                $data = $contacts->fetch();
                $contacts->closeCursor();
                ?>

                <?php if ($data == false): ?>
                    <p>
                        <?= "Vous n'êtes pas autorisé à accéder à ce contact ! <br/><br/>"; ?>
                        <?= "Retournez sur la <a href='contactsList.php'>page des contacts</a>.<br/>"; ?>
                    </p>
                <?php else: ?>
                    <h2>Information sur le contact : <strong> <?= $data["firstname"]; ?> <?= $data["lastname"]; ?> </strong></h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Adresse 1</th>
                                <th>Adresse 2</th>
                                <th>Ville</th>
                                <th>Code postal</th>
                                <th>E-mail</th>
                                <th>Téléphone</th>
                                <th>Modifier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?= empty($data["image_url"]) ? "" : "<img src=".$data['image_url']." alt='image du contact' width='80' height='80' />" ?>
                                </td>
                                <td><?= $data["address_1"]; ?></td>
                                <td><?= $data["address_2"]; ?></td>
                                <td><?= $data["city_name"]; ?></td>
                                <td><?= $data["postal_code"]; ?></td>
                                <td><?= $data["email"]; ?></td>
                                <td><?= $data["phone"]; ?></td>
                                <td style="text-align:center;">
                                    <a href="updateContact.php?id=<?= $data["id"]; ?>">
                                        <img src="../images/modifier.png" />
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>