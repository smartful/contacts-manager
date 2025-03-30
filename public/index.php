<?php
define('ROOT', dirname(__DIR__));
require ROOT."/layout/layoutFunctions.php";
echo htmlHead("Contacts Manager", "./style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <?= menu("") ?>

            <main id="corps">
                <section class="login">
                    <h1>Bienvenue chez Contacts Manager</h1>
                    <p>
                        Si vous avez déjà un compte, vous pouvez saisir vos accès :
                    </p>

                    <form method="post" action="./connexion/loginProcess.php">
                        <fieldset>
                            <legend>Vos accès</legend>
                            <div class="group-form">
                                <div class="form-row">
                                    <label for="email">Email</label>
                                    <input type=email name="email" id="email"/>
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
                        Sinon vous pouvez vous inscrire : <br/>
                        <button class="cta_button actionButton">
                            <a href="register/registerForm.php">Inscription</a>
                        </button>
                    </p>
                </section>
            </main>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>