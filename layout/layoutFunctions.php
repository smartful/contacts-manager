<?php

function htmlHead(string $title, string $cssFileName): string {
  return <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title>$title</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="$cssFileName.css" />
  </head>
EOT;
}

function menu(string $filePosition = ""): string {
  return <<<EOT
<div id="menu">
    <div class="element_menu">
      <h3>Contacts Manager</h3>
      <a href="{$filePosition}index.php">Acceuil</a>
      <a href="{$filePosition}register/registerForm.php">Inscription</a>
    </div>
</div>
EOT;
}

function deconnexionMenu(string $filePosition = ""): string {
  return <<<EOT
<div id="menu">
    <div class="element_menu">
      <h3>Contacts Manager</h3>
      <a href="{$filePosition}home.php">Home</a>
      <a href="{$filePosition}connexion/profil.php">Profil</a>
      <a href="{$filePosition}connexion/deconnexion.php" class="deconnexion_btn">Deconnexion</a>
    </div>
</div>
EOT;
}