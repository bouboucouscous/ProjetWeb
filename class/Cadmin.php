<?php
    include_once('CCommunication.php');
    class Admin extends Communication{

        private static $id;
        private static $password;

        function __construct($id,$password){
            parent::__construct();
            if($this->userExist($id)==false)
                throw new Exception("L'admin n'existe pas");
            if($this->userCheckPass($id,$password)==false)
                throw new Exception("Le mot de passe de L'admin ne correspond pas");
            if(strcmp($this->userRole($id),"Admin")!=0)
                throw new Exception("L'Admin n'est pas un admin");
            self::$id = $id ;
            self::$password = $password ;
        }

        
        public function createUser($nom,$prenom,$email,$role,$password)
        {
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            if($prenom == NULL)
                throw new Exception('Le prenom est Null');
            if($email == NULL)
                throw new Exception('L\'email est Null');
            if((strcmp($role,"Eleve")==0) || (strcmp($role,"Admin")==0) || (strcmp($role,"Professeur")==0)){}
            else{
                throw new Exception('Le role n\'est pas dans la liste accepté');
            }
            if($password == NULL)
                throw new Exception('Le mot de passe est Null');
            $id = $nom . $prenom[0];  
            $password = password_hash($password,PASSWORD_DEFAULT);
            $this->InsertUser($id,$nom,$prenom,$email,$role,$password);
        }

        public function getListUser(){
            //Renvoie l'identifiantLogin, nom, prenom, email, role de tous les utilisateurs
            return $this->getAdminListUsers();
        }

        public function getNomPrenom(){
            return $this->GetNames(self::$id);
        }

        public function getUserById($id){
            return $this->getAdminUsersById($id);
        }

        public function deleteUserById($id){
            return $this->deleteUserByIdAdmin($id);
        }

        public function updateUserWithPass($id,$nom,$prenom,$email,$role){
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            if($prenom == NULL)
                throw new Exception('Le prenom est Null');
            if($email == NULL)
                throw new Exception('L\'email est Null');
            if((strcmp($role,"Eleve")==0) || (strcmp($role,"Admin")==0) || (strcmp($role,"Professeur")==0)){}
            else{
                throw new Exception('Le role n\'est pas dans la liste accepté');
            }
            $this->updateUserWithPassAdmin($id,$nom,$prenom,$email,$role);
        }

        public function updateUserWithoutPass($id,$nom,$prenom,$email,$role,$password){
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            if($prenom == NULL)
                throw new Exception('Le prenom est Null');
            if($email == NULL)
                throw new Exception('L\'email est Null');
            if((strcmp($role,"Eleve")==0) || (strcmp($role,"Admin")==0) || (strcmp($role,"Professeur")==0)){}
            else{
                throw new Exception('Le role n\'est pas dans la liste accepté');
            }
            if($password == NULL)
                throw new Exception('Le mot de passe est Null');
            $password = password_hash($password,PASSWORD_DEFAULT);
            $this->updateUserWithoutPassAdmin($id,$nom,$prenom,$email,$role,$password);
        }
    }