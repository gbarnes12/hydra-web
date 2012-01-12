<?php

    /**
     * images
     * 
     * @package awesome
     * @author Gavin Barnes
     * @copyright 2011
     * @version $Id$
     * @access public
     */
    class images
    {
        /**
         * images::getDefaultImages()
         * 
         * Retrieves all the default images we have!
         * 
         * @return array Either of type error or notify
         */
        public function getDefaultImages()
        {
           $path = IMAGE_PATH;
           $mysql = yaapps::$mysql;
            
           $sql = "SELECT * FROM awe_images WHERE isUpload = 0";
           $return = $mysql->Command($sql, true);
            
            if(count($return) > 0) 
            {
                return array("type" => "return", "value" => $return);
            }

            return array("type" => "error", "message" => "Something went wrong while retrieving the images.");
        }
        
        /**
         * images::getUserImage()
         * 
         * @param mixed $image_id
         * @return array or boolean
         */
        public function getUserImage($image_id)
        {
            $mysql = yaapps::$mysql;
            
            $sql = "SELECT * FROM awe_images WHERE id = '".$mysql->SecureVariable($image_id)."'";
            $return = $mysql->Command($sql, true);
            
            if(count($return) > 0) 
                return $return;
            
            return false;
        }
    }