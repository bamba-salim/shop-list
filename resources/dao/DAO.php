<?php
  require_once('./resources/ENV.php');
  
  abstract class DAO
  {
    private static $_db;
    
    public function __construct()
    {
      self::get_db();
    }
    
    private static function set_db()
    {
      $env = new ENV();
      try {
        var_dump($env->get_dsn());
        self::$_db = new PDO($env->get_dsn(), $env->getDBUSER(), $env->getDBPASSWORD(),
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            )
        );
      } catch (PDOException $e) {
        var_dump($e->getMessage());
        die('<h1>Impossible de se connecter à la base de donnée</h1>');
      }
      self::$_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    
    protected static function get_db()
    {
      if (self::$_db == null) {
        self::set_db();
      }
      return self::$_db;
    }
    
    
    // add
    public function add(Request $req)
    {
      $query = self::get_db()->prepare($req->create());
      $query->execute($req->getData());
    }
    
    //get
    public static function get(Request $req)
    {
      $query = self::get_db()->prepare($req->read());
      $query->execute($req->getData());
      return $query->fetchAll();
    }
    
    // Set
    
    public static function set(Request $req)
    {
      $query = self::get_db()->prepare($req->update());
      $query->execute;
    }
    
    // Del
    
    public function del(Request $req)
    {
      $query = self::get_db()->prepare($req->delete());
      $query->execute;
    }
    
    ########## GETTERS & SETTERS ##########
    
    
  }
