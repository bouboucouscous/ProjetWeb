<?php
    include_once('CCommunication.php');
    class LoginNoPass extends Communication{
        
        private static $id;

        function __construct($id){
            parent::__construct();
            if($this->userExist($id)==false)
                throw new Exception("Le Login n'existe pas");
            self::$id = $id;
        }

        public function LoginNoPassExist($email){          
            if($this->userExist(self::$id)==false)
                throw new Exception("Le Login n'existe pas");
            return $this->userCheckEmail(self::$id,$email);
        }
    }