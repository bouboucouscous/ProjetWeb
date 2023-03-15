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
            if(strcmp($this->userRole($id),"Professeur")!=0)
                throw new Exception("Le professeur n'est pas un professeur");  
            self::$id = $id;
            self::$password = $password;
        }

        public function getListCours()
        {
            return $this->getListCoursById(self::$id);
        }

        public function getListAppelProfByCours($cours){
            if($this->checkCoursExistAndProf($cours,self::$id)==false)
                throw new Exception("Le cours n'existe pas ou n'appartient pas au professeur");
            return $this->getListAppelByCours($cours);
        }

        public function setElevePresent($cours,$eleve){
            if($this->checkCoursExistAndProf($cours,self::$id)==false)
                throw new Exception("Le cours n'existe pas ou n'appartient pas au professeur");
            if(strcmp($this->userRole($eleve),"Eleve")!=0)
                throw new Exception("L'eleve n'existe pas");
            return $this->setElevePresentByIds($cours,$eleve);
        }

        public function setEleveNonPresent($cours,$eleve){
            if($this->checkCoursExistAndProf($cours,self::$id)==false)
                throw new Exception("Le cours n'existe pas ou n'appartient pas au professeur");
            if(strcmp($this->userRole($eleve),"Eleve")!=0)
                throw new Exception("L'eleve n'existe pas");
            return $this->setEleveNonPresentByIds($cours,$eleve);
        }

        public function GetNomPrenom(){
            return $this->GetNames(self::$id);
        }
    }