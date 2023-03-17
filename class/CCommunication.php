<?php
    class Communication{
        private static $Connexion = null;

        function __construct(){
            try
            {
                self::$Connexion = new PDO("mysql:host=localhost;dbname=chabert0","chabert","h9IfJHFJ");               
            }
            catch (PDOException $e)
            {
                throw new Exception("Impossible de joindre la base de donnée");               
            }
        }

        private function requeteSelectSQL($select,$from,$where,$id){
            $sqlQuery =" Select ".$select;
            $sqlQuery .=" From ".$from;
            $sqlQuery .=" Where ".$where.' = :id';
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->bindParam(":id",$id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        private function requeteSelectInnerJoinSQL($select,$from,$inner,$where,$id){
            $sqlQuery =" Select ".$select;
            $sqlQuery .=" From ".$from;
            $sqlQuery .=" Inner Join ".$inner;
            $sqlQuery .=" Where ".$where.' = :id';
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->bindParam(":id",$id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function getListStudentByClasse($id){
            $sqlQuery =" Select identifiantLogin , nom , prenom";
            $sqlQuery .=" From Login";
            $sqlQuery .=" Where idClasse = :id";
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function getAdminListClasses(){
            $sqlQuery =" Select idCLasse";
            $sqlQuery .=" From Classe";
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function classExist($id){
            $bool = false;
            $resultat = $this->requeteSelectSQL("idClasse",
                                                "Login",
                                                "idClasse",
                                                $id);
            // récupération du résultat dans un tableau associatif       
            if(count($resultat)==1 && strcmp($resultat[0]["idClasse"],$id)==0){
                $bool = true;
            }
            return $bool;
        }

        protected function InsertClass($nom){
            $sqlQuery =" Insert into Classe (idClasse)";
            $sqlQuery .=" Values ( :id )";
            $statement = self::$Connexion->prepare($sqlQuery); 
            $statement->bindParam(":id",$nom);
            $statement->execute();
            return $this->classExit($id);
        }

        protected function updateUserWithoutPass($id,$nom,$prenom,$email,$role){
            $sqlQuery =" Update Login";
            $sqlQuery .=" SET nom = :nom , prenom= :prenom , email= :email ,role = :role";
            $sqlQuery .=" WHERE identifiantLogin = :id";
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->bindParam(":nom",$nom);
            $statement->bindParam(":prenom",$prenom);
            $statement->bindParam(":email",$email);
            $statement->bindParam(":role",$role);
            $statement->bindParam(":id",$id);
            $statement->execute();
        }

        protected function updateUserWithPass($id,$nom,$prenom,$email,$role,$password){
            $sqlQuery =" Update Login";
            $sqlQuery .=" SET nom = :nom , prenom= :prenom , email= :email ,role = :role , password = :pass";
            $sqlQuery .=" WHERE identifiantLogin = :id";
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->bindParam(":nom",$nom);
            $statement->bindParam(":prenom",$prenom);
            $statement->bindParam(":email",$email);
            $statement->bindParam(":role",$role);
            $statement->bindParam(":pass",$password);
            $statement->bindParam(":id",$id);
            $statement->execute();
        }

        protected function deleteUserByIdAdmin($id){
            $sqlQuery =" Delete From Login";
            $sqlQuery .=" Where identifiantLogin = :id";
            $statement = self::$Connexion->prepare($sqlQuery);  
            $statement->bindParam(":id",$id);        
            $statement->execute();
            if($this->userExist($id)){
                return false;
            }else{
                return true;
            } 
        }

        protected function getAdminUsersById($id){
            $sqlQuery =" Select nom, prenom, email, role";
            $sqlQuery .=" From Login";
            $sqlQuery .=" Where identifiantLogin= :id";
            $statement = self::$Connexion->prepare($sqlQuery);
            $statement->bindParam(":id",$id);      
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function GetNames($id){
            $resultat = $this->requeteSelectSQL("nom, prenom",
                                                "Login",
                                                "identifiantLogin",
                                                $id);
            return $resultat; 
        }

        protected function getAdminListUsers(){
            $sqlQuery =" Select identifiantLogin, nom, prenom, email, role";
            $sqlQuery .=" From Login";
            $statement = self::$Connexion->prepare($sqlQuery);          
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function InsertUser($id,$nom,$prenom,$email,$role,$password){
            $sqlQuery =" Insert into Login (identifiantLogin, nom, prenom, email, role, password)";
            $sqlQuery .=" Values ( :id , :nom , :prenom , :email , :role , :pass )";
            $statement = self::$Connexion->prepare($sqlQuery); 
            $statement->bindParam(":id",$id);
            $statement->bindParam(":nom",$nom);
            $statement->bindParam(":prenom",$prenom);
            $statement->bindParam(":email",$email);
            $statement->bindParam(":role",$role);
            $statement->bindParam(":pass",$password);
            $statement->execute();
            return $this->userExist($id);
        }

        protected function setElevePresentByIds($cours,$eleve){
            try {
                $sqlQuery =" Update Appel";
                $sqlQuery .=" Set presence = 1";
                $sqlQuery .=" Where idCours = :cours";
                $sqlQuery .=" And identifiantLogin = :eleve";
                $statement = self::$Connexion->prepare($sqlQuery);          
                $statement->bindParam(":cours",$cours);
                $statement->bindParam(":eleve",$eleve);
                $statement->execute();
            } catch (PDOException $e) {
                return false;
            }
            return true;
        }

        protected function setEleveNonPresentByIds($cours,$eleve){
            try {
                $sqlQuery =" Update Appel";
                $sqlQuery .=" Set presence = 0";
                $sqlQuery .=" Where idCours = :cours";
                $sqlQuery .=" And identifiantLogin = :eleve";
                $statement = self::$Connexion->prepare($sqlQuery);          
                $statement->bindParam(":cours",$cours);
                $statement->bindParam(":eleve",$eleve);
                $statement->execute();
            } catch (PDOException $e) {
                return false;
            }
            return true;
        }

        protected function getListAppelByCours($cours){
            $resultat = $this->requeteSelectSQL("presence, identifiantLogin",
                                                "Appel",
                                                "idCours",
                                                $cours);
            return $resultat;
        }

        protected function getListCoursById($id){
            $resultat = $this->requeteSelectSQL("idCours, NomCours, date",
                                                "Cours",
                                                "idProf",
                                                $id);
            return $resultat;
        }

        protected function getFicheAppelById($id){
            $resultat = $this->requeteSelectInnerJoinSQL("a.presence ,a.idCours ,c.date",
                                                "Appel a",
                                                "Cours c",
                                                "a.idCours = c.idCours AND a.identifiantLogin",
                                                $id);
            return $resultat;
        }

        protected function userExist($id)
        {
            $bool = false;
            $resultat = $this->requeteSelectSQL("identifiantLogin",
                                                "Login",
                                                "identifiantLogin",
                                                $id);
            // récupération du résultat dans un tableau associatif       
            if(count($resultat)==1 && strcmp($resultat[0]["identifiantLogin"],$id)==0){
                $bool = true;
            }
            return $bool;
        }

        protected function userCheckPass($id,$password)
        {
            $bool = false;
            $resultat = $this->requeteSelectSQL("password","Login","identifiantLogin",$id);
            // récupération du résultat dans un tableau associatif   
            //if(count($resultat)==1 && strcmp($resultat[0]["password"],password_hash($password,PASSWORD_DEFAULT))==0){
            if(count($resultat)==1 && password_verify($password,$resultat[0]["password"])){
                $bool = true;
            }
            return $bool;
        }

        protected function userRole($id){
            $role = NULL;
            $resultat = $this->requeteSelectSQL("role","Login","identifiantLogin",$id);
            // récupération du résultat dans un tableau associatif
            if(count($resultat)==1){
                return $resultat[0]["role"];
            }
            else{
                throw new Exception("La Bdd ne retourne aucunne donnée pour l'utilisateur demandé");
            }
        }

        protected function checkCoursExistAndProf($cours,$idProf)
        {
            $bool = false;
            $resultat = $this->requeteSelectSQL("idProf",
                                                "Cours",
                                                "idCours",
                                                $cours);                                               
            // récupération du résultat dans un tableau associatif       
            if(count($resultat)==1 && strcmp($resultat[0]["idProf"],$idProf)==0){
                $bool = true;
            }
            return $bool;
        }
    }