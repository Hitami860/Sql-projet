<?php

class Users
{
    private $username;

    private $password;

    public function setPseudo($username){
        $this->username = $username;
    }

    public function getPseudo(): string
    {
        return $this->username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    
}
