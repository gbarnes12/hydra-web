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
            $files = array();
            
            // open the current directory
            $handle = opendir($path);
            
            if ($handle) 
            {
               // loop through all of the files
               while (false !== ($fname = readdir($handle))) 
               {
                  // if the file is not this file, and does not start with a '.' or '..',
                  // then store it for later display
                  if (($fname != '.') && ($fname != '..') &&
                      ($fname != basename($_SERVER['PHP_SELF']))) 
                      {
                        if(is_file($path . $fname))
                        {
                            // store the filename
                            if(file_exists($path . $fname )) 
                            { 
                                $files[] = $fname;
                            }
                        }
                  }
               }
               
               if(count($files) > 0)
                return array("type" => "return", "value" => $files);
               
               // close the directory
               closedir($handle);
            }
            
            return array("type" => "error", "message" => "Something went wrong while retrieving the images.");
        }
    }