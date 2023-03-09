<?php
    include_once('CCommunication.php');
    class Professeur extends Communication{
        
        private static $id;
        private static $password;

        function __construct($id,$password){
            parent::__construct();
            if($this->userExist($id)==false)
                throw new Exception("Le Login n'existe pas");
            if($this->userCheckPass($id,$password)==false)
                throw new Exception("Le mot de passe n'est pas bon");
            self::$id = $id;
            self::$password = $password;
        }
    }