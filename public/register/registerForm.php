<?php
define('ROOT', dirname(__DIR__, 2));
require ROOT."/layout/layoutFunctions.php";
echo htmlHead("Inscription", "../style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <?= menu("../") ?>

            <!-- le corps -->
            <div id="corps">
                <form method="post" action="registerFormProcess.php">
                    <h2>Inscription du gérant</h2>
                    <fieldset>
                        <legend>Description de l'utilisateur</legend>
                        <div class="group-form">
                            <div class="form-row">
                                <label for="firstname">Prénom</label>
                                <input type=text name="firstname" id="firstname"/>
                            </div>
                            <div class="form-row">
                                <label for="lastname">Nom</label>
                                <input type=text name="lastname" id="lastname"/>
                            </div>
                        </div>
                    </fieldset>

                    <p>
                        Votre mot de passe doit contenir au moins 8 caractères alphanumeriques. <br/>
                        Voici les caractères spéciaux possible : <strong>éèùà@&</strong>
                    </p>

                    <fieldset>
                        <legend>Vos accès</legend>
                        <div class="group-form">
                            <div class="form-row">
                                <label for="email">Adresse E-mail</label>
                                <input type=email name="email" id="email"/>
                            </div>
                            <div class="form-row">
                                <label for="pass">Mot de passe</label>
                                <input type=password name="pass" id="pass"/>
                            </div>
                            <div class="form-row">
                                <label for="confirm_pass">Confirmation mot de passe</label>
                                <input type=password name="confirm_pass" id="confirm_pass"/>
                            </div>
                        </div>
                    </fieldset>

                    <p>
                        <input type="submit" value="Envoyer" class="cta_button validationButton"/>
                    </p>
                </form>
            </div>

            <!-- le pied de page -->
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
        <script src="../js/form/isConfirmPass.js"></script>
    </body>
</html>