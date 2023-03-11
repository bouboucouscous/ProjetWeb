<?php
    include_once('CCommunication.php');
    class Eleve extends Communication{
    
        private static $id;
        private static $password;

        function __construct($id,$password){
            parent::__construct();
            if($this->userExist($id)==false)
                throw new Exception("L'élève n'existe pas");
            if($this->userCheckPass($id,$password)==false)
                throw new Exception("Le mot de passe de L'élève ne correspond pas");
            if(strcmp($this->userRole($id),"Eleve")!=0)
                throw new Exception("L'élève n'est pas un élève");           
            self::$id = $id;
            self::$password = $password;
        }

        public function getFicheAppel(){
            return $this->getFicheAppelById(self::$id);
        }
    }