<?php

require_once('database.php');
require_once('validator.php');


class user
{
    private $id_user;
    private $login;
    private $password;
    private $status;
    private $pdo;

    function __construct()
    {
        $this->pdo = new database();
    }


    //S'ENREGISTRER
    function register($login, $password, $status)
    {
        $this->pdo->Insert('Insert into user (login, password, status) values ( :login , :password, :status)',
            ['login' => $login,
                'password' => password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]),
                'status' => $status,
            ]);
        return $login;
    }

    //SE CONNECTER ET RECUPERER LES DONNEES
    function connect($login)
    {
        $requser = $this->pdo->Select('Select * FROM user WHERE login = :login',
            ['login' => $login,]);
        $this->id_user = $requser[0]['id_user'];
        $this->login = $requser[0]['login'];
        $this->status = $requser[0]['status'];
        return $requser;
    }

    //UPDATE
    function update($login, $password)
    {
        $this->pdo = new database();
        $update = $this->pdo->Update("Update user SET login = :login, password = :password WHERE id_user = $this->id_user ",
            ['login' => $login,
                'password' => password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]),
    
            ]);
        $this->login = $login;

        return $update;
    }




    //GETID
    public function getId()
    {
        return $this->id_member;
    }

    //GETLOGIN
    public function getLogin()
    {
        return $this->login;
    }

    //GET STATUS

    public function getStatus()
    {

        return $this->status;

    }

    
}
