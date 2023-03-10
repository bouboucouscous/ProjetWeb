<?php
    include_once('CloginNoPass.php');
    class Login extends LoginNoPass{
        
        private static $id;
        private static $password;

        function __construct($password){
            parent::__construct();
            if($this->userCheckPass($id,$password)==false)
                throw new Exception("Le mot de passe n'est pas bon");
            self::$password = $password;
        }

        public function LoginUserGetRole(){          
            return $this->userRole(self::$id);
        }
    }