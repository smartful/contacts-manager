<?php
define('ROOT', dirname(__DIR__, 2));
require(ROOT."/layout/layoutFunctions.php");
session_start();
echo htmlHead("Formulaire de suppression", "../style");
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
                <h1>Traitement de la suppression d'un contact</h1>
                <p>
                    <?php
                    $displayText = "";
                    if (empty($_POST['contact_id'])) {
                        $displayText .= "Vous n'êtes pas autorisé à accéder à ce contact !<br/>";
                        $displayText .= "Veillez, retournez sur la <a href='contactsList.php'>page des contacts</a>";
                    } else {
                        $contactId = intval($_POST['contact_id']);

                        // On se connecte au la SGBD Mysql
                        include(ROOT."/utils/connexion_db.php");

                        $product = $bdd->prepare("
                            UPDATE contacts
                            SET deleted = 1, delete_date = NOW()
                            WHERE id = :contact_id
                            AND user_id = :user_id;
                        ");
                        $product->execute([
                            "user_id"=> $_SESSION["user_id"],
                            "contact_id"=> $contactId
                        ]);

                        $displayText .= "Suppression du contact validé <br/><br/>";
                        $displayText .= "Vous pouvez constatez la suppression sur la <a href='contactsList.php'>page des contacts</a>.<br/><br/>";
                    }

                    echo $displayText;
                    ?>
                </p>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>