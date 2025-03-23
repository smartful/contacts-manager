<?php
define('ROOT', dirname(__DIR__, 2));
require(ROOT."/layout/layoutFunctions.php");
session_start();
echo htmlHead("Formulaire d'ajout", "../style");
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
                    <a href="contactList.php">Contacts</a>
                </div>
            </div>

            <div id="corps">
                <h1>Traitement de l'ajout d'un contact</h1>
                <p>
                    <?php
                    $displayText = "";
                    if (empty($_POST['firstname']) OR empty($_POST['lastname'])) {
                        $displayText .= "Vous n'avez pas saisie toutes les informations nécessaires<br/>";
                        $displayText .= "Veillez, s'il vous plait, réessayer : ";
                        $displayText .= "<a href='addContact.php'>Formulaire d'ajout d'un contact</a>";
                    } else {
                        $firstname = htmlspecialchars($_POST['firstname']);
                        $lastname = htmlspecialchars($_POST['lastname']);
                        $address1 = htmlspecialchars($_POST['address_1']);
                        $address2 = isset($_POST['address_2']) ? htmlspecialchars($_POST['address_2']) : "";
                        $cityId = intval($_POST['city_id']);
                        $email = htmlspecialchars($_POST['email']);
                        $phone = htmlspecialchars($_POST['phone']);

                        // On se connecte au la SGBD Mysql
                        include(ROOT."/utils/connexion_db.php");

                        $product = $bdd->prepare("
                            INSERT INTO contacts(user_id, firstname, lastname, address_1, address_2, city_id, email, 
                                                    phone, add_date, update_date)
                            VALUES(:user_id, :firstname, :lastname, :address_1, :address_2, :city_id, :email, 
                                    :phone, NOW(), NOW());
                        ");
                        $product->execute([
                            "user_id"=> $_SESSION["user_id"],
                            "firstname"=> $firstname,
                            "lastname"=> $lastname,
                            "address_1"=> $address1,
                            "address_2"=> $address2,
                            "city_id"=> $cityId,
                            "email"=> $email,
                            "phone"=> $phone,
                        ]);

                        $displayText .= "Ajout du contact validé <br/><br/>";
                        $displayText .= "Vous pouvez voir l'ajout sur la <a href='contactsList.php'>page des contacts</a>.<br/><br/>";
                    }

                    echo $displayText;
                    ?>
                </p>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>