<?php

class posts

{
    private $bdd;
    public function __construct(){
        $this->bdd = new Bdd();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM posts";
        $result = $this->bdd->connect()->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
