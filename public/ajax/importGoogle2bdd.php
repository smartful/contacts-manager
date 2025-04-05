<?php
define('ROOT', dirname(__DIR__, 2));
// On se connecte au la SGBD Mysql
require_once(ROOT."/utils/connexion_db.php");
// On active la session
require_once(ROOT."/utils/check_auth.php");

// Récupération du JSON brut envoyé en POST
$json = file_get_contents("php://input");
$data = json_decode($json, true);

// On récupère les données du CSV
$contactsArray = $data['contacts'] ?? [];
$displayText = "";

foreach ($contactsArray as $index => $contactData) {
    $firstname = htmlspecialchars($contactData['firstname']) .' '. htmlspecialchars($contactData['middlename']);
    $lastname = htmlspecialchars($contactData['lastname']);
    $imageUrl = htmlspecialchars($contactData['imageUrl']);
    $email = htmlspecialchars($contactData['email']);
    $phone = htmlspecialchars($contactData['phone']);

    
    if (empty($firstname) OR empty($lastname)) {
        $displayText .= "Il n'y a pas toutes les informations nécessaires sur cette ligne<br/>";
    } else {
        $product = $bdd->prepare("
            INSERT INTO contacts(user_id, firstname, lastname, image_url, address_1, address_2, city_id, email, phone, add_date, update_date)
            VALUES(:user_id, :firstname, :lastname, :image_url, '', '', 0, :email, :phone, NOW(), NOW());
        ");
        $product->execute([
            "user_id"=> $_SESSION["user_id"],
            "firstname"=> $firstname,
            "lastname"=> $lastname,
            "image_url"=> $imageUrl,
            "email"=> $email,
            "phone"=> $phone,
        ]);


        $displayText .= "First Name : ".$contactData['firstname']." ".$contactData['middlename'].
         " | Last Name : ".$contactData['lastname'].
         " | Photo : ".$contactData['imageUrl'].
         " | E-mail : ".$contactData['email'].
         " | Telephone : ".$contactData['phone']."<br>";
    }
}

$displayText .= "Import des contacts terminé !<br/>";
$displayText .= "Vous pouvez voir les ajouts sur la <a href='contactsList.php'>page des contacts</a>.<br/><br/>";
echo $displayText;