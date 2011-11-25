<?php
    /**
     * Mysql
     * 
     * This class can be used to handle any mysql
     * request and execute some querys on it. 
     * 
     * @package Awesome
     * @author Gavin Barnes
     * @copyright 2011
     * @version $Id$
     * @access public
     */
    class Mysql
    {
        protected $connection;
        
        /**
         * Mysql::__construct()
         * 
         * @param mixed $host
         * @param mixed $username
         * @param mixed $password
         * @param mixed $database
         * @return
         */
        public function __construct($host, $username, $password, $database)
        {
            //Verbindung mit der mysqli Klasse aufbauen!
            $this->connection = new mysqli($host, $username, $password, $database);
            mysqli_set_charset($this->connection, "utf8");
            
            if($this->connection->connect_error)
                die("MySQL couldn't establish connection.");
            
        }
        
        /**
         * Mysql::SecureVariable()
         * 
         *  Secures any string thus we can avoid 
         *  mysql injection.
         * 
         * @param mixed $var
         * @return secured string
         */
        public function SecureVariable($var)
        {
            return mysqli_real_escape_string($this->connection, $var);
        }
        
        /**
         * Mysql::Command()
         * 
         * @param mixed $string
         * @param obj $return
         * @return
         */
        public function Command($string, $return = false)
        {
            if($result = $this->connection->query($string))
            {
                if($return)
                {
                    $results = array();
                    $i = 0;
                    while($obj = $result->fetch_object())
                    {
                        $results[$i] = $obj;
                        $i++;
                    }
                    
                    return $results;
                }
                
                
                return true;
            }
            
            return false;
        }
        
        /**
         * Mysql::InsertId()
         * 
         * Returns the last inset id.
         * 
         * @return
         */
        public function InsertId()
        {
            return $this->connection->insert_id;
        }
        
        /**
         * Mysql::__destruct()
         * 
         * @return
         */
        public function __destruct()
        {
            $this->connection->close();
        }
    }