<?php
define('ROOT', dirname(__DIR__, 2));
require_once(ROOT."/layout/layoutFunctions.php");
session_start();
echo htmlHead("Inscription", "../style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <?= deconnexionMenu() ?>

            <div id="corps">
                <?php
                // On se connecte au SGBD Mysql
                include(ROOT."/utils/connexion_db.php");

                // On vérifie que c'est le bon utilisateur
                if ($_POST['email']!='' AND $_POST['pass']!='') {
                    // On supprime le html qu'un utilisateur malveillant aurait pu introduire
                    $email = htmlspecialchars($_POST['email']);
                    $pass = htmlspecialchars($_POST['pass']);

                    $verif = $bdd->prepare("SELECT password 
                                            FROM users 
                                            WHERE email= ?;") or die (print_r($bdd->errorInfo()));
                    $verif->execute([$email]);
                    $userPass = $verif->fetch();

                    if (password_verify($pass, $userPass['password'])) {
                        $verif->closeCursor();
                        $correctPassword = true;
                    } else {
                        $verif->closeCursor();
                        header('Location: ../index.php');
                    }
                } else {
                    header('Location: ../index.php');
                }

                if ($correctPassword) {
                    // On récupère les infos de l'utilisateur
                    $user = $bdd->prepare("SELECT * 
                                           FROM users 
                                           WHERE email = :email AND password = :password;");
                    $user->execute([
                        "email" => $email,
                        "password" => $userPass['password']
                    ]);
                    $dataUser = $user->fetch();
                    $user->closeCursor();

                    $_SESSION["user_id"] = $dataUser["id"];
                    $_SESSION["email"] = $dataUser["email"];
                    $_SESSION["firstname"] = $dataUser["firstname"];
                    $_SESSION["lastname"] = $dataUser["lastname"];
                    header("Location: ../home.php");
                } else {
                    header("Location: ../index.php");
                }
                ?>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>