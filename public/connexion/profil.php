<?php
define('ROOT', dirname(__DIR__, 2));
require(ROOT."/layout/layoutFunctions.php");
session_start();
echo htmlHead("Profil", "../style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <?= deconnexionMenu("../") ?>

            <!-- le menu des activités -->
            <?php include(ROOT."/layout/themesMenu.php"); ?>

            <div id="corps">
                <h1>Mes informations</h1>
                <table>
                    <tr>
                        <td class="description">Prénom </td>
                        <td><?= htmlspecialchars($_SESSION['firstname']); ?></td>
                    </tr>
                    <tr>
                        <td class="description">Nom </td>
                        <td><?= htmlspecialchars($_SESSION['lastname']); ?></td>
                    </tr>
                    <tr>
                        <td class="description">E-mail </td>
                        <td><?= htmlspecialchars($_SESSION['email']); ?></td>
                    </tr>
                </table>

                <br/><br/><br/><br/>

                <!-- <a href="change_password.php?id_user=<?php echo $_SESSION['user_id']?>">Changer de mot de passe</a> -->

                <br/><br/><br/><br/>

                <!-- <a href="erase.php?id=<?php echo $_SESSION['user_id']?>">Supprimer votre compte</a> -->
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>