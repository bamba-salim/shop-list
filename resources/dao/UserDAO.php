<?php
  require_once('./resources/dao/DAO.php');
  require_once('./resources/dao/Request.php');
  
  
  
  class UserDAO extends DAO
  {
  
    private static $table = "users as u";
    private $req_user;
    private $query;
    
    public function __construct()
    {
      $this->req_user = new Request();
      $this->query = new Request();
      $this->req_user->setTable(self::$table);
      $this->query->setTable("users");
      $this->req_user->setColonnes(["u.*", "s.name as status_name"]);
      $this->req_user->setJoin(["left join status s on s.id = u.status_id"]);
    }
    
    public function find_all()
    {
      return self::get($this->req_user);
    }
    
    public  function find_by_id(int $id)
    {
      $this->req_user->setConditions("where u.id = :id");
      $this->req_user->setData(["id" => $id]);
      return self::get($this->req_user);
    }
    
    public  function find_by_token(String $token)
    {
      $this->req_user->setConditions("where u.token = :token");
      $this->req_user->setData(["token" => $token]);
      return self::get($this->req_user);
    }
    
    public function find_by_username(String $username)
    {
      $this->req_user->setConditions("where u.username = :usename");
      $this->req_user->setData(["usename" => $username]);
      return self::get($this->req_user);
    }
    
    public function create_new_user(CreationUserFormBean $formBean)
    {
      var_dump($formBean);
      $this->query->setColonnes(["`username`", "`password`","`token`","`created_at`"]);
      $this->query->setValues([":username",":password",":token",":date"]);
      $this->query->setData([
          ":username" => $formBean->getUsername(),
          ":password" => $formBean->getPassword(),
          ":token" => $formBean->getToken(),
          ":date" => $formBean->getCreatedAt(),
          ]);
      return $this->add($this->query);
      
    }
    
    ########## GETTERS & SETTERS ##########
    
  }
