<?php
    class Admin{
        public function creer_user($nom,$prenom,$email,$role,$password)
        {
            if($nom == NULL)
                return 2;
            if($prenom == NULL)
                return 2;
            if($email == NULL)
                return 2;
            if(strcmp($role,"Eleve") || strcmp($role,"Admin") || strcmp($role,"Professeur")){}
            else{
                return 2;
            }
            if($password == NULL)
                return 2;
            $id = $nom . $prenom[0];
            $idBase = $id;
            $Bdd = new ConnexionBdd();
            while($Bdd->userExist($id)){
                $indice = $indice + 1;
                $id = $idBase.$indice;
            }        
            $Bdd->InsertUser($id,$nom,$prenom,$email,$role,$password);
        }

        public function creer_classe($nom)
        {
            $Bdd = new ConnexionBdd();
            $tableID = $Bdd->SelectClasseID();
            $indice = 0;
            foreach($tableID as $uneLigne)
            {
                if($val = strstr($uneLigne['idClasse'],$nom)){
                    if($indice <= substr($uneLigne['idClasse'], strlen($nom)))
                    {
                        $indice = $indice + 1;
                    }
                }
            }
            if($indice > 0)
            {   
                $indice = $indice + 1 ;
                $nom = $nom.$indice;
            }
            $Bdd->InsertClasse($nom);
        }

        public function creer_cours($nom,$classe,$date,$prof)
        {
            $Bdd = new ConnexionBdd();
            //nom
            $tableCoursID = $Bdd->SelectCoursID();
            $indice = 0;
            foreach($tableID as $uneLigne)
            {
                if($val = strstr($uneLigne['idClasse'],$nom)){
                    if($indice <= substr($uneLigne['idClasse'], strlen($nom)))
                    {
                        $indice = $indice + 1;
                    }
                }
            }
            if($indice > 0)
            {   
                $indice = $indice + 1 ;
                $nom = $nom.$indice;
            }
            $Bdd->InsertCours($nom,$classe,$date,$prof);
        }
    }

    class ConnexionBdd{
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

        function SelectLoginID(){
            $Conn = $this->ConnectBDD();
            $texteRequete = "select identifiantLogin from Login";	
            $requete = $Conn->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
	        return $tabRes;
        } 
        
        function SelectClasseID(){
            $Conn = $this->ConnectBDD();
            $texteRequete = "select idClasse from Classe";	
            $requete = $Conn->prepare($texteRequete);
            $requete->execute();
            // récupération du résultat dans un tableau associatif
            $tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
	        return $tabRes;
        } 

        function InsertUser($id,$nom,$prenom,$email,$role,$password){
            $sql ="INSERT INTO Login (identifiantLogin, nom, prenom, email, role, password)
            VALUES ('".$id."', '".$nom."', '".$prenom."', '".$email."', '".$role."', '".$password."')";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }           
        }

        function InsertClasse($nom){
            $sql ="INSERT INTO Classe (idClasse)
            VALUES ('".$nom."'')";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }  
        }

        function InsertCours($nom,$classe,$date,$prof){
            $sql ="INSERT INTO Classe (idClasse)
            VALUES ('".$nom."'')";
            $Conn = $this->ConnectBDD();
            if ($Conn->query($sql) == TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $Conn->error;
            }  
        }

        function userExist($id)
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
                if(strcmp($uneLigne['identifiantLogin'],$id)){
                    $bool = true;
                }
            }
            return $bool;
        }

        function userCheckPass($id,$pass)
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
                if(strcmp($uneLigne['identifiantLogin'],$id)){
                    if(strcmp($uneLigne['password'],$pass)){
                        $bool = true;
                    }
                }
            }
            return $bool;
        }

        function userRole($id){
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