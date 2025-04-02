<?php
define('ROOT', dirname(__DIR__, 2));
require_once(ROOT."/layout/layoutFunctions.php");
require_once(ROOT."/utils/check_auth.php");
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
                    <a href="contactsList.php">Contacts</a>
                </div>
            </div>

            <div id="corps">
                <h1>Ajout d'un contact</h1>
                <form method="post" action="addContactProcess.php">
                    <fieldset>
                        <legend>Information du contact</legend>
                        <p>Champs sont obligatoires : *</p>
                        <div class="group-form">
                            <div class="form-row">
                                <label for="firstname">Prénom*</label> 
                                <input type="text" name="firstname" id="firstname"/>
                            </div>
                            <div class="form-row">
                                <label for="lastname">Nom*</label> 
                                <input type="text" name="lastname" id="lastname"/>
                            </div>
                            <div class="form-row">
                                <label for="address_1">Adresse 1</label> 
                                <input type=text name="address_1" id="address_1"/>
                            </div>
                            <div class="form-row">
                                <label for="address_2">Adresse 2</label> 
                                <input type=text name="address_2" id="address_2"/>
                            </div>
                            <div class="form-row">
                                <label for="city">Ville</label> 
                                <input
                                    type="text"
                                    name="city_display"
                                    id="city_display"
                                    placeholder="Sélectionner une ville ou entrer le code postal..."
                                    autocomplete="off"
                                />
                                <input type="hidden" name="city_id" id="city_id" />
                                <div id="suggestions" class="suggestions"></div>
                            </div>
                            <div class="form-row">
                                <label for="email">E-mail</label> 
                                <input type=email name="email" id="email"/>
                            </div>
                            <div class="form-row">
                                <label for="phone">Téléphone</label> 
                                <input type=phone name="phone" id="phone"/>
                            </div>
                        </div>
                    </fieldset>
                    <p>
                        <input type="submit" value="Envoyer" class="cta_button validationButton"/>
                    </p>
                </form>
            </div>
            <script src="../js/ajax/citiesAutocomplete.js"></script>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>