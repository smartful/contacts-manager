<?php
define('ROOT', dirname(__DIR__, 2));
require_once(ROOT."/layout/layoutFunctions.php");
require_once(ROOT."/utils/check_auth.php");
echo htmlHead("Formulaire de modification", "../style");
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
                <h1>Traitement de la modification d'un contact</h1>
                <p>
                    <?php
                    $displayText = "";
                    if (empty($_POST['id_contact'])) {
                        $displayText .= "Vous n'êtes pas autorisé à accéder à ce contact !<br/>";
                        $displayText .= "Veillez, retournez sur la <a href='contactsList.php'>liste des contact</a>";
                    } elseif (empty($_POST['firstname'])
                        OR empty($_POST['lastname'])
                        OR empty($_POST['address_1'])
                        OR empty($_POST['city_id'])
                        OR empty($_POST['email'])
                        OR empty($_POST['phone'])) {
                        $idContact = intval($_POST['id_contact']);
                        $displayText .= "Vous n'avez pas saisie toutes les informations nécessaires<br/>";
                        $displayText .= "Veillez, s'il vous plait, réessayer : ";
                        $displayText .= "<a href='updateContact.php?id=".$idContact."'>Formulaire de modification d'un contact</a>";
                    } else {
                        $idContact = intval($_POST['id_contact']);
                        $firstname = htmlspecialchars($_POST['firstname']);
                        $lastname = htmlspecialchars($_POST['lastname']);
                        $address1 = htmlspecialchars($_POST['address_1']);
                        $address2 = isset($_POST['address_2']) ? htmlspecialchars($_POST['address_2']) : "";
                        $cityId = intval($_POST['city_id']);
                        $email = htmlspecialchars($_POST['email']);
                        $phone = htmlspecialchars($_POST['phone']);

                        //On se connecte au la SGBD Mysql
                        include(ROOT."/utils/connexion_db.php");

                        $contact = $bdd->prepare("
                            UPDATE contacts
                            SET firstname = :firstname, lastname = :lastname, address_1 = :address_1, address_2 = :address_2, 
                                city_id = :city_id, email = :email, phone = :phone, update_date = NOW()
                            WHERE id = :id_contact
                            AND user_id = :user_id;
                        ");
                        $contact->execute([
                            "firstname"=> $firstname,
                            "lastname"=> $lastname,
                            "user_id"=> $_SESSION["user_id"],
                            "address_1"=> $address1,
                            "address_2"=> $address2,
                            "city_id"=> $cityId,
                            "email"=> $email,
                            "phone"=> $phone,
                            "id_contact"=> $idContact
                        ]);

                        $displayText .= "Modification du contact validée <br/><br/>";
                        $displayText .= "Vous pouvez voir la modification sur la <a href='detailContact.php?id=".$idContact."'>page du contact</a>.<br/><br/>";
                    }

                    echo $displayText;
                    ?>
                </p>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>