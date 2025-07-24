<?php

// on verifie si le formulaire a été envoyer
//var_dump($_POST);
if (!empty($_POST)) {
    //verification l'evoie des champs du formulaire et tous remplies: isset : verifier que chaque champ existe meme il est vide.!empty : non vide
    if (isset($_POST['nickname'], $_POST['tel'], $_POST['email'], $_POST['pass']) && !empty($_POST['nickname']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
        //on protege les valeurs du formulaire contre les injections SQL. strip_tags() supprime les balises HTML et PHP
        $pseudo = strip_tags($_POST['nickname']);
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = strip_tags($_POST['email']);
        } else {
            echo "L'email n'est pas valide.";
            exit;
        }
        //hashage le mot de passe
        $pass = password_hash(strip_tags($_POST['pass']), PASSWORD_ARGON2ID);

        // ajoute tous les autres controles de validation si necessaire
        // pseudo unique, email unique, etc.

        // enregistrement a la base de donnee

        require_once 'includes/database.php';

        $sql = "INSERT INTO `users` (`username`, `tel`, `pass` , `email`) VALUES (:pseudo, :tel, '$pass', :email)";
        $query = $conn->prepare($sql);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':tel', strip_tags($_POST['tel']), PDO::PARAM_STR);
        $query->bindValue(':email', $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        // connexion utilisateur

    }
}






// header

include "includes/header.php";


//navbar

include "includes/navbar.php";

//contenue de la page
?>

<h1>Inscription</h1>
<form action="inscription.php" method="post">
    <div>
        <label for="pseudo">Nom d'utilisateur:</label>
        <input type="text" id="pseudo" name="nickname" required>
    </div>
    <div>
        <label for="tel">Téléphone:</label>
        <input type="text" id="tel" name="tel" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="pass">Mot de passe:</label>
        <input type="password" id="pass" name="pass" required>
    </div>
    <button type="submit">S'inscrire</button>
</form>

<?php

// footer
include "includes/footer.php";
