<?php
    include_once('Communication.php');
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
            $Bdd = new CommBdd();
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
            $Bdd = new CommBdd();
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
            $Bdd = new CommBdd();
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
            $Bdd = new CommBdd();
            if($Bdd->userExist($student)==false)
                return 2;
            if($Bdd->classeExist($classe)==false)
                return 2;
            if(!strcmp($Bdd->userRole($student),'Eleve'))
                return 2;
            $Bdd->InsertStudentInClasse($student,$classe);
        }
    }