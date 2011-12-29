<?php

    /**
     * user
     * 
     * @package awesome
     * @author Gavin Barnes
     * @copyright 2011
     * @version $Id$
     * @access public
     */
    class user
    {
        /**
         * user::checkIfUserExists()
         * 
         * Is used to check if a given user
         * exists in the database.
         * 
         * @return array Either of type error or notify
         */
        public function checkIfUserExists()
        {
            $mysql = framework::$mysql;
            
            if($_POST["email"])
            {
                $sql = "SELECT email FROM awe_users WHERE email='".$mysql->SecureVariable($_POST["email"])."'";
                $return = $mysql->Command($sql, true);
                
                if(count($return) > 0) 
                {
                    return array("type" => "return", "value" => "true");
                }
                
                return array("type" => "return", "value" => "false");
            }
            
            return array("type" => "error", "message" => "You haven't supplied any email address to check");
        }
        
        public function getUser()
        {
            
        }
        
        public function createUser()
        {
            $mysql = framework::$mysql;
            
            if($_POST["email"] && $_POST["password"])
            {
                $sql = "INSERT INTO 
                        awe_users 
                        (email, password, image_id) 
                        VALUES 
                        ('".$mysql->SecureVariable($_POST["email"])."', AES_ENCRYPT('".$mysql->SecureVariable($_POST["password"])."', '".SALT."'), 1)";
                        
                if($mysql->Command($sql)) 
                {
                    return array("type" => "return", "value" => "true");
                }
                
                return array("type" => "error", "message" => "Something went wrong while creating your user!");
            }
            
            return array("type" => "error", "message" => "You haven't supplied any email address or password to check");
        }
    }