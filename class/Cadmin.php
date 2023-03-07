<?php
    include_once('CCommunication.php');
    class Admin extends CommBdd{

        private $IdAdmin;
        private $passwordAdmin;

         public function __construct($admin,$password){
            if($this->userExist($admin)==false)
                throw new Exception("L'admin n'existe pas");
            if(strcmp($this->userRole($admin),"Admin")!=0)
                throw new Exception("L'Admin n'est pas un admin");
            if($this->user($admin)==false)
                throw new Exception("Le mot de passe de L'admin ne correspond pas");
            $this.$IdAdmin = $admin ;
            $this.$passwordAdmin = password_hash($password,PASSWORD_DEFAULT);
        }

        public function creer_user($nom,$prenom,$email,$role,$password)
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
            $idBase = $id;
            $indice = 0;
            while($this->userExist($id)== true){
                $indice = $indice + 1;
                $id = $idBase.$indice;
            }   
            $password = password_hash($password,PASSWORD_DEFAULT);
            $this->InsertUser($id,$nom,$prenom,$email,$role,$password);
        }

        public function creer_classe($nom)
        {
            if($nom == NULL)
                throw new Exception('Le nom est Null');
            $nomBase = $nom;
            $indice = 0;
            while($this->classeExist($nom)==true){
                $indice = $indice +1;
                $nom = $nomBase.$indice;
            }
            $this->InsertClasse($nom);
        }

        public function creer_cours($nom,$classe,$date,$prof)
        {
            if($nom == NULL)
                throw new Exception('Le nom du cours est Null');
            if($classe == NULL)
                throw new Exception('Le nom de la classe est Null');
            if($date == NULL)
                throw new Exception('La date est Null');
            if($prof == NULL)
                throw new Exception('Le nom du professeur est Null');
            //check name
            $nomBase = $nom;
            $indice = 0;
            while($this->coursExist($nom)==true){
                $indice = $indice +1;
                $nom = $nomBase.$indice;
            }
            if(!$this->classeExist($classe)==true)
                throw new Exception('La classe n\'éxiste pas');
            if(!$this->userExist($prof)==true)
                throw new Exception('Le professeur n\'éxiste pas');
            if(!strcmp($this->userRole($prof),"Professeur"))
                throw new Exception('Le professeur désigné n\'est pas professeur');
            $this->InsertCours($nom,$classe,$date,$prof);
        }

        public function insertStudentClasse($student,$classe){
            if($student == NULL)
                throw new Exception('L\'édudiant est Null');
            if($this->userExist($student)==false)
                throw new Exception('L\'étudiant n\'éxiste pas');
            if($this->classeExist($classe)==false)
                throw new Exception('La classe n\'éxiste pas');
            if(!strcmp($this->userRole($student),'Eleve'))
                throw new Exception('L\'étudiant n\est pas un étudiant');
            $this->InsertStudentInClasse($student,$classe);
        }

        public function getUser(){
            return $this->adminGetUser();
        }

        public function getClasse(){
            return $this->adminGetClasse();
        }

        public function getCours(){
            return $this->adminGetCours();
        }
    }