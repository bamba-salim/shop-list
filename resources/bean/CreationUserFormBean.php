<?php
  
  
  class CreationUserFormBean
  {
    private $username;
    private $password;
    private $token;
    private $created_at;
  
  
    ########## GETTERS & SETTERS ##########
    /**
     * CreationUserFormBean constructor.
     * @param $username
     * @param $password
     */
  
    /**
     * @return mixed
     */
    public function getUsername()
    {
      return $this->username;
    }
  
    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
      $this->username = $username;
    }
  
    /**
     * @return mixed
     */
    public function getPassword()
    {
      return $this->password;
    }
  
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
      $this->password = $password;
    }
  
    /**
     * @return mixed
     */
    public function getToken()
    {
      return $this->token;
    }
  
    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
      $this->token = $token;
    }
  
    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
      return $this->created_at;
    }
  
    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
      $this->created_at = $created_at;
    }
    
    
    
  }
