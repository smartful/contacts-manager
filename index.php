<?php
require("./layout/layoutFunctions.php");
echo htmlHead("Contacts Manager", "style");
?>
    <body>
        <div class="container">
            <?php include("./layout/header.php"); ?>
            <?php include("menu.php"); ?>

            <main id="corps">
                <section class="login">
                    <h1>Bienvenue chez Contacts Manager</h1>
                    <p>
                        Si vous avez déjà un compte, vous pouvez saisir vos accès :
                    </p>

                    <form method="post" action="loginProcess.php">
                        <fieldset>
                            <legend>Vos accès</legend>
                            <div class="group-form">
                                <div class="form-row">
                                    <label for="email">Email</label>
                                    <input type=text name="email" id="email"/>
                                </div>

                                <div class="form-row">
                                    <label for="pass">Mot de passe</label>
                                    <input type=password name="pass" id="pass"/>
                                </div>
                            </div>
                        </fieldset>
                        <p>
                            <input type="submit" value="Envoyer" class="cta_button validationButton"/>
                        </p>
                    </form>

                    <p>
                        Sinon vous pouvez inscrire votre entreprise : <br/>
                        <button class="cta_button actionButton">
                            <a href="registerForm.php">Inscription</a>
                        </button>
                    </p>
                </section>
            </main>
            <?php include("./layout/footer.php"); ?>
        </div>
    </body>
</html>