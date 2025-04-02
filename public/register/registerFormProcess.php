<?php
define('ROOT', dirname(__DIR__, 2));
require ROOT."/layout/layoutFunctions.php";
echo htmlHead("Product Order", "../style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <?= menu("../") ?>

            <div id="corps">
                <p>
                    <?php
                    $displayText = "";
                    if (empty($_POST['firstname'])
                            AND empty($_POST['lastname'])
                            AND empty($_POST['email'])
                            AND empty($_POST['pass'])
                            AND empty($_POST['confirm_pass'])) {
                        $displayText .= "Vous n'avez pas saisie toutes les informations nécessaires<br/>";
                        $displayText .= "Veillez, s'il vous plait, réessayer : <a href='./registerForm.php'>Inscription</a>";
                    } else {
                        $firstname = htmlspecialchars($_POST['firstname']);
                        $lastname = htmlspecialchars($_POST['lastname']);
                        $email = htmlspecialchars($_POST['email']);
                        $pass = htmlspecialchars($_POST['pass']);
                        $confirmPass = htmlspecialchars($_POST['confirm_pass']);

                        if ($pass == $confirmPass) {
                            $emailRegex = "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
                            $passwordRegex = "#^[a-zA-Z0-9éèùà@&]{8,15}$#";
                            if (preg_match($emailRegex, $email) AND preg_match($passwordRegex, $pass)) {
                                // On se connecte au la SGBD Mysql
                                include(ROOT."/utils/connexion_db.php");

                                // On enregistre le user
                                $user = $bdd->prepare("
                                    INSERT INTO users(firstname, lastname, email, password, register_date)
                                    VALUES(:prenom, :nom, :courriel, :pass, NOW());
                                ");
                                $user->execute([
                                    "prenom"=> $firstname,
                                    "nom"=> $lastname,
                                    "courriel"=> $email,
                                    "pass"=> password_hash($pass, PASSWORD_BCRYPT)
                                ]);
                                // On met un lien vers la page perso
                                $displayText .= "Inscription validé <br/><br/>";
                                $displayText .= "Pour continuer veuillez vous rendre sur la page <strong>home</strong>, et vous connecter.<br/><br/>";
                                $displayText .= "Merci !";
                            } else {
                                $displayText .= "Il y a un problème dans les données d'inscription que vous avez saisi ! <br/>";
                                $displayText .= "Il s'agit d'un email au format invalide, ou d'un mot de passe incorrecte. <br/>";
                                $displayText .= "Pour rappel, un mot de passe doit avoir au moins 8 caractères et être composé des caractères suivant : <br/>";
                                $displayText .= "Majuscules, minuscules, chiffres et des caractères spéciaux suivant : <strong>éèùà@&</strong>";
                                $displayText .= "Veillez, s'il vous plait, réessayer : <a href='./registerForm.php'>Inscription</a>";
                            }
                        } else {
                            $displayText .= 'Votre mot de passe de confirmation est différent de votre mot de passe. <br/>';
                            $displayText .= "Veillez, s'il vous plait, réessayer : <a href='./registerForm.php'>Inscription</a>";
                        }
                    }

                    echo $displayText;
                    ?>
                </p>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>