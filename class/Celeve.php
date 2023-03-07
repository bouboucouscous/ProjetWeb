<?php
    include_once('CCommunication.php');
    class Eleve extends CommBdd{
        private $IDEleve;
        private $passwordEleve;

         public function __construct($eleve,$password){
            if($this->userExist($eleve)==false)
                throw new Exception("L'élève n'existe pas");
            if(strcmp($this->userRole($eleve),"Admin")!=0)
                throw new Exception("L'élève n'est pas un élève");
            if($this->user($eleve)==false)
                throw new Exception("Le mot de passe de L'élève ne correspond pas");
            $this.$IDEleve = $eleve ;
            $this.$passwordEleve = password_hash($password,PASSWORD_DEFAULT);
        }
    }