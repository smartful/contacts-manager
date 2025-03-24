<?php
define('ROOT', dirname(__DIR__, 2));
require(ROOT."/layout/layoutFunctions.php");
session_start();
echo htmlHead("Formulaire de modification", "../style");
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
            
            <!-- On charge le produit -->
            <?php
            // On se connecte au la SGBD Mysql
            include(ROOT."/utils/connexion_db.php");

            $contact = $bdd->prepare("
                SELECT contacts.*, cities.id AS cities_id, cities.city_name, cities.postal_code
                FROM contacts
                LEFT JOIN cities ON cities.id = contacts.city_id
                INNER JOIN users ON users.id = contacts.user_id
                WHERE users.id = :user_id
                AND contacts.id = :contact_id;
            ");
            
            $contact->execute([
                "contact_id"=> $contactId,
                "user_id"=> $_SESSION["user_id"],
            ]);
            $data = $contact->fetch(PDO::FETCH_ASSOC);
            ?>

            <div id="corps">
                <h1>Modification d'un contact</h1>
                <?php if ($data == false): ?>
                    <?= "Vous n'êtes pas autorisé à accéder à ce contact ! <br/><br/>"; ?>
                    <?= "Retournez sur la <a href='contactList.php'>page des contacts</a>.<br/>"; ?>
                <?php else: ?>
                    <form method="post" action="updateContactProcess.php">
                        <input type="hidden" name="id_contact" value="<?= $data["id"]; ?>"/>
                        <fieldset>
                            <legend>Information du produit</legend>
                            <p>Champs sont obligatoires : *</p>
                            <div class="group-form">
                                <div class="form-row">
                                    <label for="firstname">Prénom*</label> 
                                    <input
                                        type="text"
                                        name="firstname"
                                        id="firstname"
                                        size=10
                                        value="<?= $data["firstname"]; ?>"
                                    />
                                </div>
                                <div class="form-row">
                                    <label for="lastname">Nom*</label> 
                                    <input
                                        type="text"
                                        name="lastname"
                                        id="lastname"
                                        size=10
                                        value="<?= $data["lastname"]; ?>"
                                    />
                                </div>
                                <div class="form-row">
                                    <label for="address_1">adresse 1*</label> 
                                    <input
                                        type="text"
                                        name="address_1"
                                        id="address_1"
                                        value="<?= $data["address_1"]; ?>"
                                    />
                                </div>
                                <div class="form-row">
                                    <label for="address_2">adresse 2</label> 
                                    <input
                                        type="text"
                                        name="address_2"
                                        id="address_2"
                                        value="<?= $data["address_2"]; ?>"
                                    />
                                </div>
                                <div class="form-row">
                                    <label for="rate">Ville*</label> 
                                    <input
                                        type="text"
                                        name="city_display"
                                        id="city_display"
                                        value="<?= "[".$data['postal_code']."] ".$data['city_name']; ?>"
                                        autocomplete="off"
                                    />
                                    <input type="hidden" name="city_id" id="city_id" value=<?= $data["city_id"]; ?>/>
                                    <div id="suggestions" class="suggestions"></div>
                                </div>
                                <div class="form-row">
                                    <label for="email">E-mail*</label> 
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="<?= $data["email"]; ?>"
                                    />
                                </div>
                                <div class="form-row">
                                    <label for="phone">Téléphone*</label> 
                                    <input
                                        type="phone"
                                        name="phone"
                                        id="phone"
                                        value="<?= $data["phone"]; ?>"
                                    />
                                </div>
                            </div>
                        </fieldset>
                        <p>
                            <button class="cta_button"><a href="contactsList.php">Annuler</a></button>
                            <input type="submit" value="Envoyer" class="cta_button validationButton"/>
                        </p>
                    </form>
                <?php endif; ?>
            </div>
            <script src="../js/ajax/citiesAutocomplete.js"></script>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>