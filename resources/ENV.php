<?php
  
  
  class ENV
  {
    private $DB_NAME;
    private $DB_HOST;
    private $DB_PASSWORD;
    private $DB_USER;
    
    public function __construct()
    {
      $this->setDBHOST($this->get_env_json()->DB_HOST);
      $this->setDBNAME($this->get_env_json()->DB_NAME);
      $this->setDBUSER($this->get_env_json()->DB_USER);
      $this->setDBPASSWORD($this->get_env_json()->DB_PASSWORD);
    }
    
    public function get_dsn()
    {
      return "mysql:dbname={$this->getDBNAME()};host={$this->getDBHOST()}";
    }
    
    public function get_env_json()
    {
      $json = $_SERVER['HTTP_HOST'] === 'test-mvc.alkebulabz.com' ? 'resources/ENV.json' : 'resources/ENV_LOCAL.json';
      return json_decode(file_get_contents("./" . $json));
    }
    
    ########## GETTERS & SETTERS ##########
    
    public function getDBNAME()
    {
      return $this->DB_NAME;
    }
    
    public function setDBNAME($DB_NAME)
    {
      $this->DB_NAME = $DB_NAME;
    }
    
    public function getDBHOST()
    {
      return $this->DB_HOST;
    }
    
    public function setDBHOST($DB_HOST)
    {
      $this->DB_HOST = $DB_HOST;
    }
    
    public function getDBPASSWORD()
    {
      return $this->DB_PASSWORD;
    }
    
    public function setDBPASSWORD($DB_PASSWORD)
    {
      $this->DB_PASSWORD = $DB_PASSWORD;
    }
    
    public function getDBUSER()
    {
      return $this->DB_USER;
    }
    
    public function setDBUSER($DB_USER)
    {
      $this->DB_USER = $DB_USER;
    }
    
    
  }
