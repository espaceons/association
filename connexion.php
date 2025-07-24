<?php

//connexion a la base de donnee
try {
    require_once 'includes/database.php';
} catch (Exception $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}


if (isset($_POST['connexion'])) {
    // traitement du formulaire
    echo "Vous avez saisie le username :" . $_POST['username'] . " et le mot de passe : " . $_POST['pass'];
} else {
    echo "Veuiller vous identifier";
}
// header

include "includes/header.php";

//navbar

include "includes/navbar.php";
//contenue de la page
?>

<h1>Connexion</h1>
<form action="" method="post">
    <div>
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div>
        <label for="pass">Mot de passe:</label>
        <input type="password" id="pass" name="pass" required>
    </div>
    <button type="submit" name="connexion">Se connexion</button>
</form>


<?php

// footer
include "includes/footer.php";
