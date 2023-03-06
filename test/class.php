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
            $indice = 0;
            $Bdd = new ConnexionBdd();
            while($Bdd->userExist($id)== true){
                $indice = $indice + 1;
                $id = $idBase.$indice;
            }        
            $Bdd->InsertUser($id,$nom,$prenom,$email,$role,$password);
        }

        public function creer_classe($nom)
        {
            if($nom == NULL)
                return 2;
            $Bdd = new ConnexionBdd();
            $nomBase = $nom;
            $indice = 0;
            while($Bdd->classeExist($nom)==true){
                $indice = $indice +1;
                $nom = $nomBase.$indice;
            }
            $Bdd->InsertClasse($nom);
        }

        public function creer_cours($nom,$classe,$date,$prof)
        {
            if($nom == NULL)
                return 2;
            if($classe == NULL)
                return 2;
            if($date == NULL)
                return 2;
            if($prof == NULL)
                return 2;
            $Bdd = new ConnexionBdd();
            //check name
            $nomBase = $nom;
            $indice = 0;
            while($Bdd->coursExist($nom)==true){
                $indice = $indice +1;
                $nom = $nomBase.$indice;
            }
            if(!$Bdd->classeExist($classe)==true)
                return 2;
            if(!$Bdd->userExist($prof)==true)
                return 2;
            if(!strcmp($Bdd->userRole($prof),"Professeur"))
                return 2;
            $Bdd->InsertCours($nom,$classe,$date,$prof);
        }

        public function insertStudentClasse($student,$classe){
            if($student == NULL)
                return 2;
            $Bdd = new ConnexionBdd();
            if($Bdd->userExist($student)==false)
                return 2;
            if($Bdd->classeExist($classe)==false)
                return 2;
            if(!strcmp($Bdd->userRole($student),'Eleve'))
                return 2;
            $Bdd->InsertStudentInClasse($student,$classe);
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

        function InsertStudentInClasse($student,$classe){
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

        function classeExist($id)
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

        function coursExist($id)
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
                if(strcmp($uneLigne['identifiantLogin'],$id)==0){
                    echo "Error: " . $id . "<br>";
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
                if(strcmp($uneLigne['identifiantLogin'],$id)==0){
                    if(strcmp($uneLigne['password'],$pass)==0){
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