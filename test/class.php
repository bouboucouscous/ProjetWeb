<?php
    class Admin{
        public function creer_user($nom,$prenom,$email,$role,$password)
        {
            $id = $nom . $prenom[0];
            $Bdd = new ConnexionBdd();
            $tableID = $Bdd->SelectLoginID();
            $indice = 0;
            foreach($tableID as $uneLigne)
            {
                if($val = strstr($uneLigne['identifiantLogin'],$id)){
                    if($indice <= substr($uneLigne['identifiantLogin'], strlen($id)))
                    {
                        $indice = $indice + 1;
                    }
                }
            }
            if($indice > 0)
            {   
                $indice = $indice + 1 ;
                $id = $id.$indice;
            }
            
            $Bdd->InsertUser($id,$nom,$prenom,$email,$role,$password);
        }

        public function creer_groupe($nom)
        {
            
        }

        public function creer_cours($nom)
        {
            
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
    }