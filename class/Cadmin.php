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

        public function ajouterStudentClasse($idClasse,$idStudent){
            if($this->classExist($id)==false)
                throw new Exception("La classe n'exise pas");
            if($this->userExist($id)==false)
                throw new Exception("La personne n'exise pas");
            if(strcmp($this->userRole($id),"Eleve")!=0)
                throw new Exception("La personne n'est pas un étudiant");
            if($this->getEleveClasse($idStudent)!=Null)
                throw new Exception("L'étudiant est déjà dans une classe");
            $this->ajouterEleveClasse($idClasse,$idStudent);
            $listeCours = $this->getListCoursFromIdClasse($idClasse);
            foreach($listeCours as $row => $cours){
                $this->CreateAppel($cours['idCours'],$idStudent);
            }
        }

        public function getNbELeveFromClasse($idClasse){
            return $this->getNbStudentFromClasse($idClasse);
        }

        public function getListStudentByIdClasse($id){
            if($this->classExist($id)==false)
                throw new Exception("La classe n'exise pas");
            return $this->getListStudentByClasse($id);
        }

        public function createClasse($nom){
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            $nomBase = $nom;
            $i = 1;
            while($this->classExist($nom)){
                $nom = $nomBase.$i;
                $i++;
            }
            return $this->InsertClass($nom);
        }

        public function getListClasse(){
            return $this->getAdminListClasses();
        }
        
        public function createUser($nom,$prenom,$email,$role,$password)
        {
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            if($prenom == NULL)
                throw new Exception('Le prenom est Null');
            if($email == NULL)
                throw new Exception('L\'email est Null');
            if((strcmp($role,"Eleve")!=0) && (strcmp($role,"Admin")!=0) && (strcmp($role,"Professeur")!=0))
            { 
                throw new Exception('Le role n\'est pas dans la liste accepté');
            }
            if($password == NULL)
                throw new Exception('Le mot de passe est Null');
            $idBase = $id = $nom . $prenom[0];
            $i = 1;
            while($this->userExist($id)){
                $id = $idBase.$i;
                $i++;
            }
            $password = password_hash($password,PASSWORD_DEFAULT);
            return $this->InsertUser($id,$nom,$prenom,$email,$role,$password);
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

        public function updateUserAdmin($id,$nom,$prenom,$email,$role,$password){
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            if($prenom == NULL)
                throw new Exception('Le prenom est Null');
            if($email == NULL)
                throw new Exception('L\'email est Null');
            if((strcmp($role,"Eleve")!=0) && (strcmp($role,"Admin")!=0) && (strcmp($role,"Professeur")!=0)){
                throw new Exception('Le role n\'est pas dans la liste accepté');
            }
            if($password == NULL)
            {
                $this->updateUserWithoutPass($id,$nom,$prenom,$email,$role);
            }
            else
            {
                $password = password_hash($password,PASSWORD_DEFAULT);
                $this->updateUserWithPass($id,$nom,$prenom,$email,$role,$password);
            }
        }
    }