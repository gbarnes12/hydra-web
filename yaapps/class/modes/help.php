<?php

    /**
     * help
     * 
     * @package awesome
     * @author Gavin Barnes
     * @copyright 2011
     * @version $Id$
     * @access public
     */
    class help
    {
        public $strings;
        
        public function __construct()
        {
            $file = simplexml_load_file("help.xml");
            $this->strings = array();
            foreach($file->string as $string)
            {
                $id = (string)$string->attributes()->id;
                $content = (string)$string;
                $this->strings[$id] = $content;
            }
        }
        
        /**
         * help::getHelpString()
         * 
         * @return
         */
        public function getHelpString()
        {
            if(isset($_POST["id"]))
            {
                if(isset($this->strings[$_POST["id"]]))
                {
                    return array("type" => "return", "value" => $this->strings[$_POST["id"]]);
                }
            }

            return array("type" => "error", "message" => "The help message is missing please contact some administrator.");
        }
    }