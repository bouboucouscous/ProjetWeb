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
            $resultat = $this->requeteSelectSQL("identifiantLogin","Login","identifiantLogin",$id);
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

        /*
        protected function InsertUser($id,$nom,$prenom,$email,$role,$password){
            $sql ="INSERT INTO Login (identifiantLogin, nom, prenom, email, role, password)
            VALUES ('".$id."', '".$nom."', '".$prenom."', '".$email."', '".$role."', '".$password."')";
            if ($Connexion->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Connexion->error;
            }           
        }

        protected function InsertClasse($nom){
            $sql ="INSERT INTO Classe (idClasse)
            VALUES ('".$nom."'')";
            if ($Connexion->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Connexion->error;
            }  
        }

        protected function InsertCours($nom,$classe,$date,$prof){
            $sql ="INSERT INTO Classe (idClasse)
            VALUES ('".$nom."'')";
            if ($Connexion->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Connexion->error;
            }  
        }

        protected function InsertStudentInClasse($student,$classe){
            $sql ="UPDATE login
            SET idClasse = '".$classe."'
            WHERE identifiantLogin = ".$student."";
            if ($Connexion->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Connexion->error;
            }  
        }

        protected function classeExist($id)
        {
            $bool = false;
            $texteRequete = "select idClasse from Classe";
            $requete = $Connexion->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($tabRes as $uneLigne)
            {
                if(strcmp($uneLigne['idClasse'],$id)==0){
                    $bool = true;
                }
            }
            return $bool;
        }

        protected function coursExist($id)
        {
            $bool = false;
            $texteRequete = "select idCours from Cours";
            $requete = $Connexion->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($tabRes as $uneLigne)
            {
                if(strcmp($uneLigne['idCours'],$id)==0){
                    $bool = true;
                }
            }
            return $bool;
        }       

        protected function adminGetUser(){
            $texteRequete = "select identifiantLogin, nom, prenom, role from Login";
            $requete = $Connexion->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $tabRes;
        }

        protected function adminGetCours(){
            $texteRequete = "select idCours, idClasse, date, idProf from Cours";
            $requete = $Connexion->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $tabRes;
        }
         
        protected function adminGetClasse(){
            $texteRequete = "select idClasse from Classe";
            $requete = $Connexion->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $tabRes;
        }
        */
    }