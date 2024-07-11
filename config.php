<?php


require_once('users.php');
require_once('post.php');


class bdd
{
    private $bdd;
    public function connect()
    {
        try {
            $this->bdd = new PDO("mysql:host=localhost;dbname=bddtestblog", 'root', '');
            return $this->bdd;
        } catch (PDOException $e) {
            print $e;
        }
    }

    public function addUser($username, $password)
    {

        $requete = 'INSERT INTO utilisateur (username, password) VALUES(:username, :password)';
        $requetexe = $this->bdd->prepare($requete);
        $requetexe->execute(['username' => $username, 'password' => $password]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM utilisateur";

        $done = $this->bdd->query($sql);

        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    public function authentification($param = [])
    {

        $users = $this->getAll();

        foreach ($users as $user) {
            if ($param["usern"] == $user["username"] && password_verify($param["password"], $user["password"])) {
                return $user;
            }
        }
    }
    public function addPost(post $post)
    {
        $contenu=$post->getContenu();
        $titre=$post->getTitre();
        $auteur=$post->getAuteur();
        $requete = 'INSERT INTO posts (titre,contenu,auteur) VALUES(:titre, :contenu, :auteur)';
        $requetexe = $this->bdd->prepare($requete);
        $requetexe->bindParam(":titre",$titre);
        $requetexe->bindParam(":contenu",$contenu);
        $requetexe->bindParam(":auteur",$auteur);
        $requetexe->execute();
    }
}
