<?php
    include_once('CCommunication.php');
    class Login extends CommBdd{
        public function LoginUserGetRole($idLogin,$password){
            if($this->userExist($idLogin)==false)
                throw new Exception("Le Login n'existe pas");
            if($this->userCheckPass($idLogin,$password)==false)
                throw new Exception("Le mot de passe n'est pas bon");
            return $this->userRole($idLogin);
        }
    }