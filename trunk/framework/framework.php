<?php
    
    include("class/mysql.php");
    include("config.php");
    
    /**
     * framework
     * 
     * @package Awesome
     * @author Gavin Barnes
     * @copyright 2011
     * @version $Id$
     * @access public
     */
    class framework 
    {
        public static $mysql;
        public static $classes;
        
        
        private $data;
        
        /**
         * API::__construct()
         * 
         * @return void
         */
        public function __construct()
        {
            self::$mysql = new Mysql(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
            self::$classes = array();
            
            // loads all the necessary classes!
            $this->LoadClasses();
            $this->data = array();
        }
    
        /**
         * framework::LoadClasses()
         * 
         * @return void
         */
        private function LoadClasses()
        {
            // open the current directory
            $handle = opendir('class/modes/');
            
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
                        // store the filename
                        if(is_dir( "class/modes/" )) 
                        { 
                            // split the file name so we only have the name of the class
                            $names = explode(".", $fname);
                            
                            if(file_exists("class/modes/" . $fname ))
                            { 
                                print_r($names);
                                include("class/modes/" . $fname);
                                //create new instance of the class we are currently processing
                                if(class_exists($names[0]))
                                {
                                    
                                    $instance = new $names[0]();
                                    self::$classes[$names[0]] = $instance;
                                }
                            }
                        }
                  }
               }
               // close the directory
               closedir($handle);
            }
        }
    
        /**
         * framework::ParseData()
         * 
         * @return void
         */
        public function ParseData()
        {
            // retrieve our instance
            if(isset($_POST["class"]) && isset($_POST["method"]))
            {
                $class = $_POST["class"];
                if(selft::classes != null)
                {
                    if(array_key_exists($class))
                    {
                        $instance = self::$classes[$class];
                        if(is_object($instance))
                        {
                            
                            $data = $instance->$_POST["method"]($_POST);
                        }
                    }
                }
            }
        }
        
        /**
         * framework::ReturnData()
         * 
         * @return the json encoded data!
         */
        public function ReturnData()
        {
            return json_encode($this->data);
        }
    
    }