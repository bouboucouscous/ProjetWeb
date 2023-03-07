<?php
    class CommBdd{
        private function ConnectBDD(){
            try
            {
                $Conn = new PDO("mysql:host=localhost;dbname=chabert0","chabert","h9IfJHFJ");
            }
            catch (PDOException $e)
            {
                echo "Erreur PDO : ".$e->getMessage()."<br/>";
                die();
                
            }
            return $Conn;
        }

        protected function InsertUser($id,$nom,$prenom,$email,$role,$password){
            $sql ="INSERT INTO Login (identifiantLogin, nom, prenom, email, role, password)
            VALUES ('".$id."', '".$nom."', '".$prenom."', '".$email."', '".$role."', '".$password."')";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }           
        }

        protected function InsertClasse($nom){
            $sql ="INSERT INTO Classe (idClasse)
            VALUES ('".$nom."'')";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }  
        }

        protected function InsertCours($nom,$classe,$date,$prof){
            $sql ="INSERT INTO Classe (idClasse)
            VALUES ('".$nom."'')";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }  
        }

        protected function InsertStudentInClasse($student,$classe){
            $sql ="UPDATE login
            SET idClasse = '".$classe."'
            WHERE identifiantLogin = ".$student."";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }  
        }

        protected function classeExist($id)
        {
            $bool = false;
            $Conn = $this->ConnectBDD();
            $texteRequete = "select idClasse from Classe";
            $requete = $Conn->prepare($texteRequete);
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
            $Conn = $this->ConnectBDD();
            $texteRequete = "select idCours from Cours";
            $requete = $Conn->prepare($texteRequete);
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

        protected function userExist($id)
        {
            $bool = false;
            $Conn = $this->ConnectBDD();
            $texteRequete = "select identifiantLogin from Login";
            $requete = $Conn->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($tabRes as $uneLigne)
            {
                if(strcmp($uneLigne['identifiantLogin'],$id)==0){
                    echo "Error: " . $id . "<br>";
                    $bool = true;
                }
            }
            return $bool;
        }

        protected function userCheckPass($id,$pass)
        {
            $bool = false;
            $Conn = $this->ConnectBDD();
            $texteRequete = "select identifiantLogin, password from Login";
            $requete = $Conn->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($tabRes as $uneLigne)
            {
                if(strcmp($uneLigne['identifiantLogin'],$id)==0){
                    if(strcmp($uneLigne['password'],$pass)==0){
                        $bool = true;
                    }
                }
            }
            return $bool;
        }

        protected function userRole($id){
            $role = NULL;
            $Conn = $this->ConnectBDD();
            $texteRequete = "select identifiantLogin, role from Login";
            $requete = $Conn->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($tabRes as $uneLigne)
            {
                if(strcmp($uneLigne['identifiantLogin'],$id)){
                    $role = $uneLigne['role'];
                }
            }
            return $role;
        }
    }