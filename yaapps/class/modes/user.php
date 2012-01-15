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
            $mysql = yaapps::$mysql;
            
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
        
        public function getUserImages()
        {
            $mysql = yaapps::$mysql;
            
            if($_POST["email"])
            {
                $sql = "SELECT image_id, AES_DECRYPT(password, '".SALT."') AS Pass FROM awe_users WHERE email='".$mysql->SecureVariable($_POST["email"])."'";
                $user = $mysql->Command($sql, true);
                
                if(count($user) > 0) 
                {
                    $points = $user[0]->Pass;
                    $points = explode(",", $points);
                    
                    $img = yaapps::$classes["images"]->getUserImage($user[0]->image_id);
                    if($img != false)
                    {
                        return array("type" => "return", "value" => array($img[0], count($points)));
                    }
                    
                    return array("type" => "error", "message" => "There is no image with the given id: " . $user[0]->image_id);
                }
                
                return array("type" => "error", "message" => "Email address isn't within the scope of the database relation.");
            }
            
            return array("type" => "error", "message" => "Couldn't retrieve any image file!");
        }
        
        private function extractPoints($points)
        {
            $points = explode(";", $points);
            $x = explode("X:", $points[0]);
            $y = explode("Y:", $points[1]);
            
            $pointsArray = array("X" => $x[1], "Y" => $y[1]);
            
            return $pointsArray;
        }
        
        public function checkPoint()
        {
            $mysql = yaapps::$mysql;
            
            if(isset($_POST["email"]) && isset($_POST["pointX"]) && isset($_POST["pointY"]))
            {
                $sql = "SELECT email, AES_DECRYPT(password, '".SALT."') AS Pass FROM awe_users WHERE email='" . $mysql->SecureVariable($_POST["email"]) . "'";
                $result = $mysql->Command($sql, true);
                                    
                if(count($result) > 0 ) 
                {
    
                    $points = $result[0]->Pass;
                    $points = explode(",", $points);
                    $points = $points[$_POST["numPoint"]-1];       
                    $points = $this->extractPoints($points);  
                    
                    $distance = sqrt(pow(($_POST["pointX"] - $points["X"]), 2) + pow(($_POST["pointY"] - $points["Y"]), 2));
                    
                    if($distance > MAX_DISTANCE)
                        return array("type" => "return", "value" => "false");
                    
                    return array("type" => "return", "value" => "true");
                }
                
                return array("type" => "error", "message" => "You haven't supplied any user id or any points to check");
            }
            
            return array("type" => "error", "message" => "You haven't supplied any user id or any points to check");
        }
        
        public function createUser()
        {
            $mysql = yaapps::$mysql;
            
            if($_POST["email"] && $_POST["password"])
            {
                $sql = "INSERT INTO 
                        awe_users 
                        (email, password, image_id) 
                        VALUES 
                        ('".$mysql->SecureVariable($_POST["email"])."', AES_ENCRYPT('".$mysql->SecureVariable($_POST["password"])."', '".SALT."'), '".$mysql->SecureVariable($_POST["image_id"])."')";
                        
                if($mysql->Command($sql)) 
                {
                    return array("type" => "return", "value" => "true");
                }
                
                return array("type" => "error", "message" => "Something went wrong while creating your user!");
            }
            
            return array("type" => "error", "message" => "You haven't supplied any email address or password to check");
        }
    }