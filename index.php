<?php
require_once('config.php');

session_start();
$bdd = new bdd();
$bdd->connect();

if (isset($_POST['ajouter'])) {

    $titre = ($_POST['titre']);
    $contenu = ($_POST['contenu']);
    $newpost = new post();
    $newpost->setTitre($titre);
    $newpost->setContenu($contenu);
    $bdd->addPost($newpost);
}

/* inscription */
if (isset($_POST['inscription'])) {
    $mdp = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $bdd->addUser($_POST["username"], $mdp);
}

/* connexion */

if (isset($_POST["connexion"])) {
    $userr = $_POST["usern"];
    $mdp = $_POST["motdp"];

    if (!empty($userr) && (!empty($mdp))) {
        $user = $bdd->authentification(["usern" => $userr, "password" => $mdp]);
        if ($user) {
            $_SESSION["user"] = $user;
            print("Vous êtes connecté");
        }
    } else {
        print("Un des champs est vide!");
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>Inscription connexion</title>
</head>

<body class="bg-blue-600 text-white">
    <header>
        <nav class="pb-[15%]">
            <ul>
                <li>Acceuil</li>
                <li></li>
                <li></li>
            </ul>
        </nav>
    </header>

    <form action="" method="post">
        <input type="text" name="titre" placeholder="titre du post">
        <input type="text" name="contenu" placeholder="post">
        <button type="submit" name="ajouter">Ajouter</button> 
    </form>


    <div class="form">
        <form action="" method="post">
            <input type="text" name="username" placeholder="identifiant">
            <input name="password" placeholder="mot de passe">
            <input type="submit" name="inscription" value="inscription">
        </form>


        <form class="boder-t-4" action="" method="post">
            <input type="text" name="usern" placeholder="mail ou identifiant">
            <input name="motdp" placeholder="mot de passe">
            <input type="submit" name="connexion" value="connexion">
        </form>
        <hr style="margin: 5% 5% 5% 5%;">
        <table border="1">
            <thead>
                <th>titre</th>
                <th>contenu</th>
                <th>auteur</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($bdd->getAllpost() as $article) { ?>
                    <tr>
                        <td><?php echo $article['titre']; ?></td>
                        <td><?php echo $article['contenu']; ?></td>
                        <td><?php echo $article['auteur']; ?></td>
                        <?php if (isset($_SESSION['user']))   ?>
                        <td>
                            <form action="" method="post">
                                <button type="submit" name="edit"> edit</button>
                            </form>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</body>

</html>