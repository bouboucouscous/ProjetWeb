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

        public function deleteStudentFromClasse($idClasse,$idStudent){
            if($this->classExist($idClasse)==false)
                throw new Exception("La classe n'existe pas");
            if($this->userExist($idStudent)==false)
                throw new Exception("La personne n'existe pas");
            $listeCours = $this->getListCoursFromIdClasse($idClasse);
            foreach($listeCours as $row => $cours){
                $this->deleteAppelbyCoursAndStudent($cours['idCours'],$idStudent);    
            }
            $this->SetNullClasseWithId($idStudent);
        }

        /* FAUT SUPPRIMER LA CONTRAINTE FOREIGN KEY, PUIS METTRE A JOUR ET REMETTRE LA CONTRAINTE
        public function updateClasse($idClasse,$nom){
            if($this->classExist($idClasse)==false)
                throw new Exception("La classe n'existe pas");
            if($this->classExist($nom)==true)
                throw new Exception("Le nom de classe existe déja");
            $this->updateClasse($idClasse,$nom);
            $this->updateColloneClasseInCours($idClasse,$nom);
            $this->updateColloneClasseInLogin($idClasse,$nom);
            
        }*/

        public function getListCours(){
            return $this->getAdminListCours();
        }

        public function deleteCour($idCour){
            if($this->courExist($idCour)==false)
                throw new Exception("Le cours n'existe pas");
            $this->deleteCoursFromAppelbyId($idCour);
            $this->deleteCoursFromCourbyId($idCour);
        }

        public function createCour($cours,$classe,$date,$prof){
            if($this->classExist($classe)==false)
                throw new Exception("La classe n'existe pas");
            if($this->userExist($prof)==false)
                throw new Exception("Le prof n'existe pas");
            if(strcmp($this->userRole($prof),"Professeur")!=0)
                throw new Exception("Le professeur n'est pas un professeur");
            if($date == NULL)
                throw new Exception("La date est Null");
            if($cours==NULL)
                throw new Exception("Le cours est NuLL");
            $baseId = $idCours = $cours;
            $i = 1;
            while($this->courExist($idCours)==true){
                $idCours = $baseId.$i;
                $i=$i+1;
            }
            $this->createCours($idCours,$classe,$date,$prof,$cours);
            $listeEtudiant = $this->getListStudentFromIdClasse($classe);
            foreach($listeEtudiant as $row => $student){
                $this->CreateAppel($idCours,$student['identifiantLogin']);
            }

        }

        public function deleteClasse($idClasse){
            if($this->classExist($idClasse)==false)
                throw new Exception("La classe n'existe pas");
            $listeCours = $this->getListCoursFromIdClasse($idClasse);
            foreach($listeCours as $row => $cours){
                $this->DeleteAppelbyCours($cours['idCours']);
                $this->DeleteCoursbyId($cours['idCours']);
            }
            $this->SetNullIdsClasseOnLogin($idClasse);
            $this->deleteClassebyId($idClasse);
        }

        public function ajouterStudentClasse($idClasse,$idStudent){
            if($this->classExist($idClasse)==false)
                throw new Exception("La classe n'existe pas");
            if($this->userExist($idStudent)==false)
                throw new Exception("La personne n'existe pas");
            if(strcmp($this->userRole($idStudent),"Eleve")!=0)
                throw new Exception("La personne n'est pas un étudiant");
            if($classe = $this->getEleveClasse($idStudent) != null)
                throw new Exception("L'étudiant est déjà dans une classe ".$classe);
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
                throw new Exception("La classe n'existe pas");
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