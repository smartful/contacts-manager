<?php
define('ROOT', dirname(__DIR__));
require ROOT."/layout/layoutFunctions.php";
session_start();
echo htmlHead("Home", "./style");
?>
    <body>
        <div class="container">
            <?php include(ROOT."/layout/header.php"); ?>
            <!-- le menu principal -->
            <?= deconnexionMenu() ?>

            <!-- le menu des activités -->
            <?php include(ROOT."/layout/themesMenu.php"); ?>

            <div id="corps">
                <p>
                    Bienvenue <strong><?= $_SESSION["firstname"]; ?> <?= $_SESSION["lastname"]; ?></strong>. <br/>
                    Vous pouvez ajouter des contacts en allant dans les activités.
                </p>
            </div>
            <?php include(ROOT."/layout/footer.php"); ?>
        </div>
    </body>
</html>