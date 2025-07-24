<?php

// on verifie si le formulaire a été envoyer
//var_dump($_POST);
if (!empty($_POST)) {
    //verification l'evoie des champs du formulaire et tous remplies: isset : verifier que chaque champ existe meme il est vide.!empty : non vide
    if (
        isset($_POST["pseudo"], $_POST["pass"])
        && !empty($_POST["pseudo"]) && !empty($_POST["pass"])
    ) {
        // connexion a la base d donnee
        require_once 'includes/database.php';
        $sql = "SELECT * FROM `users` WHERE `username` = :pseudo";
        $query = $conn->prepare($sql);
        $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if (!$user) {
            echo "Utilisateur non trouvé.";
            exit;
        } else {
            // verification du mot de passe
            if (password_verify($_POST['pass'], $user['pass'])) {
                // connexion réussie
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php");
                exit;
            } else {
                echo "Mot de passe incorrect.";
                exit;
            }
        }
    } else {
        echo "champ vide.";
        exit;
    }
}
//}






// header

include "includes/header.php";


//navbar

include "includes/navbar.php";

//contenue de la page
?>

<h1>Connexion</h1>
<form action="inscription.php" method="post">
    <div>
        <label for="pseudo">Nom d'utilisateur:</label>
        <input type="text" id="pseudo" name="pseudo" required>
    </div>

    <div>
        <label for="pass">Mot de passe:</label>
        <input type="password" id="pass" name="pass" required>
    </div>
    <button type="submit">Se connexion</button>
</form>


<?php

// footer
include "includes/footer.php";
